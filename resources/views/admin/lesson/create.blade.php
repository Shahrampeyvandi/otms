@extends('layouts.master')

@section('title') {{$page_title}} @endsection

@section('content')

@component('common-components.breadcrumb')
@slot('title') {{$page_title}} @endslot
@slot('li_1') جدید @endslot
@endcomponent

@section('css')
<link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="text-right">
                    <a class="btn btn-primary mr-auto mb-3" href="{{URL::route('lessons.index')}}">لیست {{$page_title}}
                        ها</a>
                </div>
                @component('common-components.admin-errors')
                @endcomponent
                <form action="{{URL::route('lessons.store')}}{{isset($lesson) ? '?action=edit' : ''}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @isset($lesson)
                    <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                    @endisset
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="example-text-input" class=" col-form-label">نام {{$page_title}}</label>
                            <input class="form-control" type="text" name="title" value="{{$lesson->title ?? ''}}"
                                required id="example-text-input">
                        </div>
                         <div class="col-md-4">
                            <label for="example-text-input" class=" col-form-label">شماره قسمت</label>
                            <input class="form-control" type="text" name="number" value="{{$lesson->number ?? ''}}"
                                required id="example-text-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="col-form-label">دوره مربوطه </label>
                                <select class="form-control select2" name="course" >
                                    @foreach (\App\Post::where('post_type','course')->orderBy('title')->get() as $item)
                                    <option value="{{$item->id}}"
                                        {{isset($course) && $course->course->contains($item->id) ? 'selected' : ''}}>
                                        {{Str::limit($item->title,30,'...')}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-2 col-form-label">انتخاب تصویر</label>
                        <div class="custom-file row col-md-6">
                            <input type="file" class="custom-file-input" name="picture" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <br><br>

                    <h5>فایل درس را به یکی از دو روش زیر وارد نمایید:</h5>
                    <div class="form-group row">
                        <label for="" class="col-md-2 col-form-label">انتخاب فایل </label>
                        <div class="custom-file row col-md-6">
                            <input type="file" class="custom-file-input" name="file" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-2 col-form-label">آدرس فایل </label>
                        <div class="custom-file row col-md-6">
                            <input type="url" name="url" id="url" placeholder="https://example.com"
                            class="form-control"
                                pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?"
                                required>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="">توضیحات: </label>
                            <textarea id="elm1" name="description">{!! $lesson->description ?? '' !!}</textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="col-form-label">رایگان یا غیررایگان</label>
                            <select class="form-control" name="cash_type" id="cash_type">
                                <option value="free" {{isset($lesson) && $lesson->cach == 'free' ? 'selected' : ''}}>
                                    رایگان</option>
                                <option value="cash" {{isset($lesson) && $lesson->cach == 'money' ? 'selected' : ''}}>
                                    غیررایگان</option>
                            </select>
                            <input type="number" id="cash" name="cash" class="form-control mt-1 hidden"
                                placeholder="قیمت به تومان">
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">آزمون اتمام درس</label>
                            <select class="form-control" name="quiz" id="quiz">
                                <option value="#">بدون آزمون</option>
                                @foreach (\App\Quiz::orderBy('title')->get() as $item)
                                <option value="{{$item->id}}"
                                    {{isset($lesson) && $lesson->quiz->id == $item->id ? 'selected' : ''}}>
                                    {{$item->title}}</option>
                                @endforeach
                            </select>
                            <input type="number" id="cash" class="form-control mt-1 hidden" placeholder="قیمت به تومان">
                        </div>
                        <div class="col-md-4">
                            <label for="example-text-input" class=" col-form-label">مدت زمان درس</label>
                            <div class="">
                                <input id="input-date1" name="duration" class="form-control input-mask"
                                    data-inputmask="'mask': '99:99'" required value="{{$lesson->duration ?? ''}}">
                                <span class="text-muted">e.g "HH:MM"</span>
                            </div>
                        </div>

                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            @isset($lesson)
                            ویرایش
                            @else
                            ثبت
                            @endisset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{URL::asset('/libs/select2/select2.min.js')}}"></script>
<!--tinymce js-->
<script src="{{URL::asset('/libs/tinymce/tinymce.min.js')}}"></script>
<!-- Summernote js -->
<script src="{{URL::asset('/libs/summernote/summernote.min.js')}}"></script>
<!-- init js -->
<script src="{{URL::asset('/js/pages/form-editor.init.js')}}"></script>
<!-- form mask -->
<script src="{{URL::asset('/libs/inputmask/inputmask.min.js')}}"></script>
<!-- form mask init -->
<script>
    $(".select2").select2({
        tags:false
    });
    $(".select2.enable-tag").select2({
    tags:true
    });
   $(".input-mask").inputmask();
   $('#cash_type').change(function(e){
       if($(this).val()== 'cash'){
           $('#cash').removeClass('hidden').addClass('show')
       }else{
           $('#cash').removeClass('show').addClass('hidden')
       }
   })
</script>

@endsection