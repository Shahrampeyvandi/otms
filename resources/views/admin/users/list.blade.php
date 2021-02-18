@extends('layouts.master')

@section('title') {{$title}} @endsection
@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

@component('common-components.breadcrumb')
@slot('title')کاربران @endslot
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
                        <th>En Name</th>
                        <th>Fa Name</th>
                        <th>Tel</th>
                        <th>Mob</th>
                        <th>Fax</th>
                        <th>Email</th>
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
                    
                    "data": "client_en_name",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "client_fa_name",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "tel",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "mob",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "fax",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    "data": "email",
                    'orderable': true,
                    'searchable': true,
                },
                {
                    'orderable': false,
                    'searchable': false,
                    'data': null,
                    'render': function (data, type, row, meta) {
                        let play_360 = `<a  class="btn btn-sm btn-danger mt-1" href="{{ route('user.remove') }}?id=${data.id}"
                        onclick="return confirm('Are you sure you want to Remove User?')"
                        title="پخش"><i class="fa fa-trash"></i> Delete </a>`;
                        let play_480 = `<a target="_blank" class="btn btn-sm btn-info mt-1" href="{{ route('user.edit') }}?id=${data.id}" title="پخش"><i class="fa fa-edit"></i> Edit</a>`;
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