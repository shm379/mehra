@extends('admin.layouts/contentLayoutMaster')

@section('title','برگه ها')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
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
                        <h4 class="card-title">ایجاد دسته بندی</h4>
                    </div>
                    <div class="card">
                        <form action="{{route('admin.pages.store')}}" class="form form-horizontal" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" aria-expanded="true">
                                                        <div class="card-body">
                                                            <div class="form-body">
                                                                <textarea id="editorberg" name="content" hidden></textarea>
                                                            </div>
                                                            <div class="col-md-10 offset-md-2">
                                                                <button type="submit" class="btn btn-primary white mr-1 mb-1">ذخیره
                                                                </button>
                                                                <a href=" {{route('admin.pages.index')}}"
                                                                   class="btn btn-outline-warning mr-1 mb-1">لغو</a>
                                                            </div>

                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Ajax Sourced Server-side -->
@endsection


@section('vendor-script')
    {{-- vendor files --}}

    <script src="{{ asset('vendor/laraberg/js/react.production.min.js') }}"></script>
    <script src="{{ asset('vendor/laraberg/js/react-dom.production.min.js') }}"></script>
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
{{--    @include('admin.partials.file_manager_scripts')--}}
    <script>
        // const options = {}
        Laraberg.init('editorberg')
    </script>
@endsection
