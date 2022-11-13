@extends('admin.layouts/contentLayoutMaster')

@section('title', 'دسته بندی ها')

@section('vendor-style')
    {{-- vendor css files --}}

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
                        <form action="{{route('admin.categories.store')}}" class="form form-horizontal" method="POST">
                            @csrf
                            <div class="row">
                                <!-- left menu section -->
                                <div class="col-md-3 mb-2 " style="min-height: 500px">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                         <x-admin.input-select
                                                             id="category_template_id"
                                                             label="قالب دسته بندی"
                                                             :model="$categoryTemplates"
                                                             columnName="name">
                                                         </x-admin.input-select>
                                                    </div>
                                                    <div class="form-group">
                                                         <x-admin.input-select
                                                             id="parent_id"
                                                             label="دسته بندی والد"
                                                             :model="$parentCategories"
                                                             columnName="title">
                                                         </x-admin.input-select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- right content section -->
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" aria-expanded="true">
                                                        <div class="card-body">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-2 ">
                                                                                <span>عنوان</span>
                                                                            </div>
                                                                            <div class="col-md-10">
                                                                                <input type="text" id="title" required
                                                                                       class="form-control"
                                                                                       name="title"   value=" {{ old('title') }}">
                                                                            </div>
                                                                            @if ($errors->has('title')) <p
                                                                                class="error_form">{{ $errors->first('title') }}</p>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-md-2 ">
                                                                                <span>نامک</span>
                                                                            </div>
                                                                            <div class="col-md-10">
                                                                                <input type="text" id="slug" required
                                                                                       class="form-control"
                                                                                       name="slug"   value=" {{ old('slug') }}">
                                                                            </div>
                                                                            @if ($errors->has('slug')) <p
                                                                                class="error_form">{{ $errors->first('slug') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-2 ">
                                                                                <span>متن </span>
                                                                            </div>
                                                                            <div class="col-md-10">
                                                                <textarea id="description" name="description" class="form-control" rows="4">
                                                                    {{ old('description') }}</textarea>
                                                                            </div>
                                                                            @if ($errors->has('description')) <p
                                                                                class="danger">{{ $errors->first('description') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-2 ">
                                                                                <span>انتخاب تصویر</span>
                                                                            </div>
                                                                            <div class="col-md-10 ">
                                                                                <a id="lfm_img" data-input="image" data-preview="holder"
                                                                                   class="btn btn-primary white ">
                                                                                    <i class="fa fa-picture-o"></i> انتخاب
                                                                                </a>
                                                                                <input id="image" class="form-control mt-1" type="text"
                                                                                       name="image"
                                                                                       value="{{old('image')}}" style="direction: ltr">
                                                                                <div id="holder"
                                                                                     style="margin-top:15px;max-height:100px;"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-2 ">
                                                                                <span>توضیحات متا</span>
                                                                            </div>
                                                                            <div class="col-md-10">
                                                                    <textarea type="text" id="meta_description"
                                                                              class="form-control"
                                                                              name="meta_description"
                                                                              rows="2">{{old('meta_description')}}</textarea>
                                                                            </div>
                                                                            @if ($errors->has('meta_description')) <p
                                                                                class="danger">{{ $errors->first('meta_description') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-2 ">
                                                                                <span>کلمات کلیدی</span>
                                                                            </div>
                                                                            <div class="col-md-10">
                                                                    <textarea type="text" id="meta_keywords"
                                                                              class="form-control"
                                                                              name="meta_keywords" rows="2">{{old('meta_keywords')}}</textarea>
                                                                            </div>
                                                                            @if ($errors->has('meta_keywords')) <p
                                                                                class="danger">{{ $errors->first('meta_keywords') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-10 offset-md-2">
                                                                <button type="submit" class="btn btn-primary white mr-1 mb-1">ذخیره
                                                                </button>
                                                                <a href=" {{route('admin.categories.index')}}"
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

@endsection

@section('page-script')
    {{-- Page js files --}}
    @include('admin.partials.file_manager_scripts')

    <script>
        $('#title').on('keypress',function (){
            $('#slug').val($(this).val().replace(/[^a-zA-Z0-9]+/g,'-'))
        })
    </script>
@endsection
