@extends('layouts.master')

@section('title') {{$title}} @endsection

@section('content')

@component('common-components.breadcrumb')
@slot('title') {{$title}} @endslot
@slot('li_1') جدید @endslot
@endcomponent
@section('css')
<link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection


<div class="row">
    <div class="col-12">
        @component('common-components.admin-errors')
        @endcomponent
        <div class="card">
            <div class="card-body">
                <div class="text-right">
                    <a class="btn btn-primary mr-auto mb-3" href="{{URL::route('road.index')}}">لیست {{$title}} ها</a>
                </div>
                @if (!isset($road))
                <form action="{{URL::route('road.store')}}?type=excel" method="post" enctype="multipart/form-data">
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
                <form action="{{URL::route('road.store')}}{{isset($road) ? '?action=edit' : ''}}" method="post">
                    @csrf
                    @isset($road)
                    <input type="hidden" name="user_id" value="{{$road->id}}">
                    @endisset
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">Truck</label>
                                <div class="">
                                    <input class="form-control" type="text" name="truck" value="{{$road->truck ?? ''}}"
                                        required id="example-text-input">
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">File No</label>
                                <div class="">
                                    <input class="form-control" type="text" name="file_no" value="{{$road->file_no ?? ''}}"
                                        required id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Invoice Client</label>
                                <select class="form-control select2" name="invoice_client">
                                    <option value=""></option>
                                    @foreach (\App\User::orderBy('client_en_name')->get() as $item)
                                    <option value="{{$item->client_en_name}}"
                                     {{isset($road) && $road->invoice_client == $item->client_en_name ? 'selected' : ''}}   
                                        >{{$item->client_en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">HBL</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="hbl"
                                        value="{{$road->hbl ?? ''}}" required id="example-text-input">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">H.BL Issue Date</label>
                                <div class="">
                                    <input class="form-control" type="date" name="issue_date"
                                        value="{{set_date($road->issue_date ?? '')}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">HS Code</label>
                                <div class="">
                                    <input class="form-control" type="number" name="hs_code"
                                        value="{{$road->hs_code ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">Package Type</label>
                                <div class="">
                                    <input class="form-control" type="text" name="package_type"
                                        value="{{$road->package_type ?? ''}}" id="example-text-input">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">BL G.W</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="bl_g_w"
                                        value="{{$road->bl_g_w ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                      
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Package</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="package"
                                        value="{{$road->package ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">POR Text</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="por_text"
                                        value="{{$road->por_text ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">POL Text</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="pol_text"
                                        value="{{$road->pol_text ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">POD Text</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="pod_text"
                                        value="{{$road->pod_text ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Final Des Text</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="final_dest_text"
                                        value="{{$road->final_dest_text ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Shipper</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="shipper"
                                        value="{{$road->shipper ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Consignee</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="consignee"
                                        value="{{$road->consignee ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Notify</label>
                                <div class="">
                                    <input class="form-control" type="text"  name="notify"
                                        value="{{$road->notify ?? ''}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Dispatch Date</label>
                                <div class="">
                                    <input class="form-control" type="date"  name="dispatch_date"
                                        value="{{set_date($road->dispatch_date ?? '')}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">ETA</label>
                                <div class="">
                                    <input class="form-control" type="date"  name="eta"
                                        value="{{set_date($road->eta ?? '')}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Border Cross Date</label>
                                <div class="">
                                    <input class="form-control" type="date"  name="border_cross_date"
                                        value="{{set_date($road->border_cross_date ?? '')}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Discharge Date</label>
                                <div class="">
                                    <input class="form-control" type="date"  name="discharge_date"
                                        value="{{set_date($road->discharge_date ?? '')}}" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="example-text-input" class=" col-form-label">Goods Description</label>
                                <div class="">
                                    <textarea class="form-control" name="goods_description" id=""  rows="3">{!!$road->goods_description ?? ''!!}</textarea>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            @isset($road)
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
<script src="{{URL::asset('/libs/select2/select2.min.js')}}"></script>
<script>
    $(".select2").select2({
        tags:false
    });
 </script>   
@endsection