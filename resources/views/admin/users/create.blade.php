@extends('layouts.master')

@section('title') {{$title}} @endsection

@section('content')

@component('common-components.breadcrumb')
@slot('title') {{$title}} @endslot
@slot('li_1') جدید @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        @component('common-components.admin-errors')
        @endcomponent
        <div class="card">
            <div class="card-body">
                <div class="text-right">
                    <a class="btn btn-primary mr-auto mb-3" href="{{URL::route('users.index')}}">لیست {{$title}} ها</a>
                </div>
                @if (!isset($user))
                <form action="{{URL::route('users.store')}}?type=excel" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-md-2 col-form-label">Enter Excel File</label>
                        <div class="custom-file row col-md-6">
                            <input type="file" class="custom-file-input" name="file" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            ثبت
                        </button>
                    </div>
                </form>
                <br><br>
                @endif
                <form action="{{URL::route('users.store')}}{{isset($user) ? '?action=edit' : ''}}" method="post">
                    @csrf
                    @isset($user)
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    @endisset
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">Fa Name</label>
                                <div class="">
                                    <input class="form-control" type="text" name="fa_name" value="{{$user->client_en_name ?? ''}}"
                                        required id="example-text-input">
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">En Name</label>
                                <div class="">
                                    <input class="form-control" type="text" name="en_name" value="{{$user->client_fa_name ?? ''}}"
                                        required id="example-text-input">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">Unique ClientID</label>
                                <div class="">
                                    <input class="form-control" type="number"  name="client_id"
                                        value="{{$user->client_id ?? ''}}" required id="example-text-input">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">Tel</label>
                                <div class="">
                                    <input class="form-control" type="number" name="tel"
                                        value="{{$user->tel ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">Mob</label>
                                <div class="">
                                    <input class="form-control" type="number" name="mob"
                                        value="{{$user->mob ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">Fax</label>
                                <div class="">
                                    <input class="form-control" type="number" name="fax"
                                        value="{{$user->fax ?? ''}}" id="example-text-input">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Email</label>
                                <div class="">
                                    <input class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                        title="ایمیل وارد شده صحیح نمیباشد"  type="email" name="email"
                                        value="{{$user->email ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Password</label>
                                <div class="">
                                    <input class="form-control" type="text" pattern=".{6,}"
                                        title="رمز عبور حداقل شامل 6 کاراکتر میباشد" name="password"
                                        value="{{$user->password ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class=" col-form-label">نقش</label>
                                <div class="">
                                    <select class="form-control" name="group">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Economic Code</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="economic_code"
                                        value="{{$user->economic_code ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">National ID / Code</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="national_id"
                                        value="{{$user->national_idcode ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Address Fa</label>
                                <div class="">
                                    <textarea class="form-control" name="addressfa" id=""  rows="3">{!!$user->addressfa ?? ''!!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Address En</label>
                                <div class="">
                                    <textarea class="form-control" name="addressen" id=""  rows="3">{!!$user->addressen ?? ''!!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            @isset($user)
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
    <!-- end col -->
</div>
<!-- end row -->

@endsection

@section('script')

@endsection