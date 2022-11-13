@extends('admin.layouts/contentLayoutMaster')

@section('title', 'محصولات')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
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
                        <h4 class="card-title">لیست محصولات گروهی</h4>
                    </div>
                    <div class="card-datatable">
                        <table class="datatables-ajax table table-responsive" id="product-groups">
                            <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>عنوان</th>
                                <th>قیمت</th>
                                <th>محصولات</th>
                                <th>وضعیت</th>
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
            {data: 'id', name: 'شناسه'},
            {data: 'name', name: 'عنوان'},
            {data: 'price', name: 'قیمت'},
            {data: 'products', name: 'محصولات'},
            {data: 'is_active', name: 'وضعیت'},
        ],
         dom: 'lBfrtip',")
{{--    <script src="{{ asset('admin/js/scripts/tables/table-datatables-advanced.js') }}"></script>--}}
@endsection
