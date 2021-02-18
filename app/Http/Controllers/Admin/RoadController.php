<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoadResource;
use App\Imports\RoadImport;
use App\Jobs\SendEmailJob;
use App\RoadData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
class RoadController extends Controller
{
    public $title = 'حمل و نقل زمینی';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dispatch(new SendEmailJob('yasfuny@gmail.com'));
        // $data = array('name'=>"Virat Gandhi");
        // Mail::send('admin.mails.mail', $data, function($message) {
        //     $message->to('yasfuny@gmail.com')->subject
        //        ('Change Transport Status');
        //     $message->from('otms@gmail.com','OTMS Support');
        //  });
         dd('s');
        if (!$request->ajax()) {
            $data = [
                'title' => 'لیست بارهای زمینی'
            ];
            return view('admin.transport.road.index', $data);
        }

        // parameters

        $length = $request->input('length');
        $search = $request->input('search');
        $columns = $request->input('columns');
        $order = $request->input('order', []);
        // customize parameters
        $orderBy = $columns[$order[0]['column']]['data'] ?? 'created_at';
        $order = $order[0]['dir'];
        $searchWords = explode(" ", $search['value']);
        // $query
        $items = RoadData::where(function ($query) use ($searchWords) {
            if (count($searchWords) > 0) {
                foreach ($searchWords as $key => $word) {
                    if ($word != '') {
                        $query->orWhere('invoice_client', 'like', '%' . $word . '%')
                       ->orWhere('client_fa_name', 'like', '%' . $word . '%')
                       ->orWhere('truck', 'like', '%' . $word . '%')
                       ->orWhere('file_no', 'like', '%' . $word . '%')
                       ->orWhere('hbl', 'like', '%' . $word . '%')
                       ->orWhere('issue_date', 'like', '%' . $word . '%')
                       ->orWhere('hs_code', 'like', '%' . $word . '%')
                       ->orWhere('package_type', 'like', '%' . $word . '%')
                       ->orWhere('bl_g_w', 'like', '%' . $word . '%')
                       ->orWhere('package', 'like', '%' . $word . '%')
                       ->orWhere('por_text', 'like', '%' . $word . '%')
                       ->orWhere('pol_text', 'like', '%' . $word . '%')
                       ->orWhere('pod_text', 'like', '%' . $word . '%')
                       ->orWhere('final_dest_text', 'like', '%' . $word . '%')
                       ->orWhere('shipper', 'like', '%' . $word . '%')
                       ->orWhere('consignee', 'like', '%' . $word . '%')
                       ->orWhere('notify', 'like', '%' . $word . '%')
                       ->orWhere('dispatch_date', 'like', '%' . $word . '%')
                       ->orWhere('eta', 'like', '%' . $word . '%')
                       ->orWhere('border_cross_date', 'like', '%' . $word . '%')
                       ->orWhere('discharge_date', 'like', '%' . $word . '%')
                       ->orWhere('goods_description', 'like', '%' . $word . '%');
                        //$query->orWhere('slug', 'like', '%' . $word . '%');
                    }
                };
            }
        })->orderBy($orderBy, $order)->paginate($length);
        //return response;
        return response()->json([
            'recordsTotal' => $items->total(),
            'recordsFiltered' => $items->total(),
            'draw' => $request->input('draw'),
            'data' => RoadResource::collection($items),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
        $data['title'] = $this->title;
        return view('admin.transport.road.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (isset($request->type) && $request->type == 'excel') {
            $request->validate([
                'file' => 'required'
            ]);
            Excel::import(new RoadImport, request()->file);
        } else {
            if ($data =RoadData::where(['invoice_client' => $request['invoice_client']])->first()) {
            } else {
                $data = new RoadData;
                $data->invoice_client = $request['invoice_client'];
            }

        
                $data->truck = $request['truck'];
                $data->file_no = $request['file_no'];
                $data->hbl = $request['hbl'];
                $data->issue_date = $request['issue_date'];
                $data->hs_code = $request['hs_code'];
                $data->package_type = $request['package_type'];
                $data->bl_g_w = $request['bl_g_w'];
                $data->package = $request['package'];
                $data->por_text = $request['por_text'];
                $data->pol_text = $request['pol_text'];
                $data->pod_text = $request['pod_text'];
                $data->final_dest_text = $request['final_dest_text'];
                $data->shipper = $request['shipper'];
                $data->consignee = $request['consignee'];
                $data->notify = $request['notify'];
                $data->goods_description = $request['goods_description'];
                $data->dispatch_date = $request['dispatch_date'];
                $data->eta = $request['eta'];
                $data->border_cross_date = $request['border_cross_date'];
                $data->discharge_date = $request['discharge_date'];
                $data->save();
        


        }

        return Redirect::route('road.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = request('id');
        $data['title'] = 'حمل و نقل زمینی';
        $data['road'] = RoadData::find($id);
        // dd($data);
        // dd($data['road']->set_date($data['road']->eta));
    //    dd($data);
        return view('admin.transport.road.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {


        $data = RoadData::find(request('id'));
        
        $data->delete();
        return Redirect::back();
    }
}
