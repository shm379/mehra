@extends('admin.layouts/contentLayoutMaster')

@section('title', 'کاربران')

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
                        <h4 class="card-title">لیست کاربران</h4>
                    </div>
                    <div class="card-datatable">
                        <livewire:user-datatables
                            searchable="first_name, mobile"
                            exportable
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Ajax Sourced Server-side -->
@endsection


@section('vendor-script')
{{--   {{$dataTable->scripts()}}--}}
@endsection

{{--@php(--}}
{{--    $table_config = "--}}
{{--        ajax: {--}}
{{--            url: assetPath+dt_ajax_id,--}}
{{--            data: function (d){--}}
{{--                d.first_name = $('input[id=first_name]').val()--}}
{{--                d.search = $('input[type=search]').val()--}}
{{--                }--}}
{{--        },--}}
{{--        columns: [--}}
{{--            {data: 'id', name: 'شناسه'},--}}
{{--            {data: 'first_name', name: 'نام'},--}}
{{--            {data: 'last_name', name: 'نام خانوادگی'},--}}
{{--        ]")--}}
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset('admin/js/scripts/pages/app-user-list.js') }}"></script>
@endsection
