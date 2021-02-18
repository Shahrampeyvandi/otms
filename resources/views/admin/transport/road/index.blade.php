@extends('layouts.master')

@section('title') {{$title}} @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

@component('common-components.breadcrumb')
@slot('title')بارهای زمینی @endslot
@slot('li_1') لیست @endslot
@endcomponent



<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

             <div class="table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Truck </th>
                        <th>File No</th>
                        <th>Invoice Client</th>
                        <th>HBL</th>
                        <th>H.BL Issue Date</th>
                        <th>HS Code</th>
                        <th>Package</th>
                        <th>Package Type</th>
                        <th>BL G.W</th>
                        <th>POR Text</th>
                        <th>POL Text</th>
                        <th>POD Text</th>
                        <th>Final Des Text</th>
                        <th>Shipper</th>
                        <th>Consignee</th>
                        <th>Notify</th>
                        <th>Dispatch Date</th>
                        <th>ETA</th>
                        <th>Border Cross Date</th>
                        <th>Discharge Date</th>
                        <th>Goods Description</th>
                        <th></th>


                    </tr>
                </thead>
                <tbody></tbody>

            </table>
             </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection

@section('script')

<!-- Required datatable js -->
<script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('/libs/jszip/jszip.min.js')}}"></script>
<script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ URL::asset('/libs/datatables/defaultConfig.js')}}"></script>
<script>
    $(document).ready(function () {
        let users_table = $('#datatable-buttons').DataTable({
            "pageLength": 15,
            'ajax': {
                'url': '',
                'type': 'GET',
                "data": function (d, settings) {
                    var api = new $.fn.dataTable.Api(settings);
                    d.page = Math.min(
                        Math.max(0, Math.round(d.start / api.page.len())),
                        api.page.info().pages
                    ) + 1;
                }
            },
            'columns': [
                dataTableRowNumber(),
                {
                    
                    "data": "truck",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    
                    "data": "file_no",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    
                    "data": "invoice_client",
                    'orderable': true,
                    'searchable': true,
                },
                
                {
                    
                    "data": "hbl",
                    'orderable': true,
                    'searchable': true,
                },

                {
                    
                    "data": "issue_date",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "hs_code",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "package",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "package_type",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "bl_g_w",
                    'orderable': true,
                    'searchable': true,
                },
               
                {
                    "data": "por_text",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "pol_text",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "pod_text",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "final_dest_text",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "shipper",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "consignee",
                    'orderable': true,
                    'searchable': true,
                },

                {
                    "data": "notify",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "goods_description",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "dispatch_date",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "eta",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "border_cross_date",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "discharge_date",
                    'orderable': true,
                    'searchable': true,
                },
               
               
                {
                    'orderable': false,
                    'searchable': false,
                    'data': null,
                    'render': function (data, type, row, meta) {
                        let play_360 = `<a  class="btn btn-sm btn-danger mt-1" href="{{ route('road.remove') }}?id=${data.id}"
                        onclick="return confirm('Are you sure you want to Remove Report?')"
                        title="پخش"><i class="fa fa-trash"></i> Delete </a>`;
                        let play_480 = `<a target="_blank" class="btn btn-sm btn-info mt-1" href="{{ route('road.edit') }}?id=${data.id}" title="پخش"><i class="fa fa-edit"></i> Edit</a>`;
                        return `${play_360} ${play_480}`;
                    }
                }
            ],
        });
        users_table.column(2).visible(true);
    });
</script>
<!-- Datatable init js -->
{{-- <script src="{{ URL::asset('/js/pages/datatables.init.js')}}"></script> --}}



@endsection