<?php

namespace App\Http\Controllers\Admin;

use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class LessonController extends Controller
{
    public $page_title = 'درس';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'lessons' => Lesson::latest()->get(),
            'title' => $this->page_title
        ];
        return view('admin.lesson.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['page_title'] = $this->page_title;
        return view('admin.lesson.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'url'=>'required_without:file',
            'title'=>'required',
            // 'course'=>'required',
            
            ]);
            // dd($request->all());

        $slug = SlugService::createSlug(Lesson::class, 'slug', $request->title);
        if (isset($request->action)) {
            $lesson = Lesson::find($request->group_id);
        } else {
            $lesson = new Lesson;
        }

        if ($request->has('picture')) {
            if (isset($request->action)) {
                File::delete(public_path($lesson->image));
            }
            $fileName = $this->upload_picture($request, 'lesson', $slug);
            $lesson->image = $fileName;
        }

        if ($request->has('file')) {
            if (isset($request->action)) {
                File::delete(public_path($lesson->url));
            }
            $fileName = $this->upload($request, 'lesson', $slug, "required|mimes:mp4,3gp");
            // dd($fileName);
            $lesson->url = $fileName;
        } else {
            $lesson->url = $request->url;
        }

        $lesson->title = $request->title;
        $lesson->post_id = 1;
        $lesson->duration = $request->duration;
        $lesson->description = $request->description;
        $lesson->cash = $request->cash_type;
        $lesson->price = $request->cash;
        // $lesson->media = File::mimeType(public_path($fileName));

        // $lesson->type = $request->type;
        $lesson->save();


        return Redirect::route('lessons.index');
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
    public function edit($id)
    {

        $data['page_title'] = $this->page_title;
        $data['group'] = Lesson::find($id);
        return view('admin.lesson.create', $data);
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
    public function destroy($id)
    {
        Lesson::find($id)->delete();
        return Redirect::route('lessons.index');
    }

    public function upload_picture(Request $request, $type, $name)
    {
        $date = date('Y');
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $imageName = $name . '.' . $request->picture->extension();

        $request->picture->move(public_path('uploads/' . $date . '/' . $type), $imageName);
        return 'uploads/' . $date . '/' . $type . '/' . $imageName;
    }
}
