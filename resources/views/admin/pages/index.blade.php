@extends('admin.layouts/contentLayoutMaster')

@section('title', 'محصولات')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/extensions/searchPanes.dataTables.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/fixedHeader.bootstrap5.min.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/searchBuilder.bootstrap5.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/searchBuilder.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection


@section('content')
    <!-- Ajax Sourced Server-side -->
    <section id="ajax-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">لیست محصولات</h4>
                        <div class="datatable-actions" style="margin-bottom: 1em;
        padding: 1em;
        background-color: #f6f6f6;
        border: 1px solid #999;
        border-radius: 3px;
        height: 100px;
        overflow: auto;">

                        </div>
                    </div>
                    <div class="card-datatable">
                        <table class="datatables-ajax table table-responsive" id="products">
                            <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>عنوان</th>
                                <th>زیر عنوان</th>
                                <th>قیمت</th>
                                <th>تولید کننده</th>
                                <th>نوع تولید کننده</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Ajax Sourced Server-side -->
@endsection


@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset('admin/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.searchPanes.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.searchBuilder.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/searchBuilder.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
    @php(
    $table_config = "
        ajax: {
            url: assetPath+dt_ajax_id,
        },
        columns: [
            {responsivePriority: 1,data: 'id', title: 'شناسه'},
            {responsivePriority: 1000,data: 'title', title: 'عنوان'},
            {responsivePriority: 2,data: 'sub_title', title: 'عنوان جایگزین'},
            {responsivePriority: 2,data: 'price', title: 'قیمت'},
            {responsivePriority: 2,data: 'producer.title', title: 'تولید کننده', name:'producer.title', searchable:false},
            {responsivePriority: 1,data: 'producer.producer_type', title: 'نوع تولید کننده', name:'producer.producer_type', searchable:false},
        ],
         dom: 'Bfrtip',")
{{--    <script src="{{ asset('admin/js/scripts/tables/table-datatables-advanced.js') }}"></script>--}}
@endsection
