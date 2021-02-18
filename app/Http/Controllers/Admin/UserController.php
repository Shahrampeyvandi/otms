<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(auth()->user());

        // dd('d');
        // if($user->can('create user')){
        //     dd('true');
        // }else{
        //     dd('false');
        // }
        //         $role = Role::insert([['name' => 'admin','guard_name'=>'web'],['name' => 'teacher','guard_name'=>'web'],['name' => 'student','guard_name'=>'web']]);
        // $permission = Permission::insert([[
        //         'name' => 'create user','guard_name'=>'web'],[
        //         'name' => 'edit user','guard_name'=>'web'],[
        //         'name' => 'delete user','guard_name'=>'web'],[
        //         'name' => 'create group','guard_name'=>'web'],[
        //         'name' => 'edit group','guard_name'=>'web'],[
        //         'name' => 'delete group','guard_name'=>'web'],[
        //         'name' => 'add user to group','guard_name'=>'web'],[
        //         'name' => 'delete user from group','guard_name'=>'web'],[
        //         'name' => 'create course','guard_name'=>'web'],[
        //         'name' => 'delete course','guard_name'=>'web'],[
        //         'name' => 'edit course','guard_name'=>'web'],[
        //         'name' => 'create lesson','guard_name'=>'web'],[
        //         'name' => 'delete lesson','guard_name'=>'web'],[

        //         'name' => 'edit lesson','guard_name'=>'web'],[
        //         'name' => 'create quiz','guard_name'=>'web'],[
        //         'name' => 'delete quiz','guard_name'=>'web'],[
        //         'name' => 'edit quiz','guard_name'=>'web']]
        //         );
        //          $user = User::find(1);
        //         $user->assignRole('admin');
        //         dd('sd');
        if (!$request->ajax()) {
            $data = [
                'title' => 'لیست کاربران سایت'
            ];
            return view('admin.users.list', $data);
        }

        // parameters

        $length = $request->input('length');
        $search = $request->input('search');
        $columns = $request->input('columns');
        $order = $request->input('order', []);
        // customize parameters
        $orderBy = $columns[$order[0]['column']]['data'] ?? 'client_en_name';
        $order = $order[0]['dir'];
        $searchWords = explode(" ", $search['value']);
        // $query
        $items = User::where(function ($query) use ($searchWords) {
            if (count($searchWords) > 0) {
                foreach ($searchWords as $key => $word) {
                    if ($word != '') {
                        $query->orWhere('client_en_name', 'like', '%' . $word . '%')
                       ->orWhere('client_fa_name', 'like', '%' . $word . '%')
                       ->orWhere('tel', 'like', '%' . $word . '%')
                       ->orWhere('mob', 'like', '%' . $word . '%')
                       ->orWhere('fax', 'like', '%' . $word . '%')
                       ->orWhere('email', 'like', '%' . $word . '%');
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
            'data' => UserResource::collection($items),
        ]);
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'کاربر';
        return view('admin.users.create', $data);
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
            Excel::import(new UsersImport, request()->file);
        } else {
            $inputs = $request->validate([
                'client_id' => 'required',
            ]);

            if ($user = User::where(['client_id' => $request['client_id']])->first()) {
            } else {
                $user = new User;
                $user->client_id = $request['client_id'];
            }
            $user->client_en_name = $request['client_name_en'];
            $user->client_fa_name = $request['client_name_fa'];
            $user->economic_code = $request['economic_code'];
            $user->national_idcode = $request['national_idcode'];
            $user->email = $request['email'];
            $user->addressen = $request['addressen'];
            $user->addressfa = $request['addressfa'];
            $user->tel = $request['tel'];
            $user->fax = $request['fax'];
            $user->mob = $request['mob'];
            $user->save();
            if ($request['group'] == 'admin') $user->syncRoles([$request->group]);
        }
        return Redirect::route('users.index');
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
        $data['title'] = 'کاربر';
        $data['user'] = User::find($id);
        return view('admin.users.create', $data);
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


        $user = User::find(request('id'));
        
        $user->delete();
        return Redirect::back();
    }



    public function changegroup()
    {

        $user = User::find(request('id'));
        $g = $user->group;

        if ($g == 'student') {
            $user->group = 'teacher';
            $user->syncRoles(['teacher']);
        } else {
            $user->group = 'student';
            $user->syncRoles(['student']);
        }
        $user->save();
        return response()->json(['res' => $user->group], 200);
    }
}
