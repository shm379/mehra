@extends('admin.layouts.master')
@section('content')
    <section id="validation">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">ویرایش کاربر </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{route('admin.users.update',$user->id)}}" class="form form-horizontal" method="Post"
                                  id="form_step" class="steps-validation wizard-circle ">
                                @method('PUT')
                                {{ csrf_field() }}

                                <div class="form-body">
                                    @include('admin.admin_partails.x_panel',['success_message'=>'success_message','fail_message'=>'fail_message',])

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2 ">
                                                    <span>نام</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" id="first_name" required class="form-control"
                                                           name="first_name"   value="{{$user->first_name}}">
                                                </div>
{{--                                                @if ($errors->has('first_name')) <p--}}
{{--                                                    class="error_form">{{ $errors->first('first_name') }}</p>--}}
{{--                                                @endif--}}
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2 ">
                                                    <span>نام خانوادگی</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" id="last_name" required class="form-control"
                                                           name="last_name"  value="{{$user->last_name}}">
                                                </div>
{{--                                                @if ($errors->has('last_name')) <p--}}
{{--                                                    class="error_form">{{ $errors->first('last_name') }}</p>--}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2 ">
                                                    <span>نوع کاربر</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="custom-select form-control" id="language"
                                                            name="user_type">
                                                        <option value="">انتخاب کنید</option>
                                                        @foreach($users_types as $key=> $user_type)
                                                            <option value="{{$key}}" {{$user->user_type ==$key? 'selected': ''}}>{{$user_type}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
{{--                                                @if ($errors->has('user_type')) <p--}}
{{--                                                    class="error_form">{{ $errors->first('user_type') }}</p>--}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2 ">
                                                    <span>شماره تماس</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" id="mobile" required class="form-control"
                                                           name="mobile" value="{{$user->mobile}}">
                                                </div>
{{--                                                @if ($errors->has('mobile')) <p--}}
{{--                                                    class="error_form">{{ $errors->first('mobile') }}</p>--}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2 ">
                                                    <span>نوع کاربر</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="custom-select form-control" id="language"
                                                            name="active">
                                                        <option value="">انتخاب کنید</option>
                                                        @foreach($actives as $key=> $active)
                                                            <option  value="{{$key}}" {{$user->active==$key? 'selected': ''}}>{{$active}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
{{--                                                @if ($errors->has('active')) <p--}}
{{--                                                    class="error_form">{{ $errors->first('active') }}</p>--}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2 ">
                                                    <span>نام کاربری</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" id="username" value="{{$user->username}}" required class="form-control"
                                                           name="username">
                                                </div>
{{--                                                @if ($errors->has('username')) <p--}}
{{--                                                    class="error_form">{{ $errors->first('username') }}</p>--}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2 ">
                                                    <span>ایمیل</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" id="email" value="{{$user->email}}" required class="form-control"
                                                           name="email">
                                                </div>
{{--                                                @if ($errors->has('email')) <p--}}
{{--                                                    class="error_form">{{ $errors->first('email') }}</p>--}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-2 ">
                                                    <span>پسورد</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" id="password"  class="form-control"
                                                           name="password">
                                                </div>
{{--                                                @if ($errors->has('password')) <p--}}
{{--                                                    class="error_form">{{ $errors->first('password') }}</p>--}}
{{--                                                @endif--}}
                                            </div>
                                        </div>


                                        <div class="col-md-8 offset-md-2">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">ذخیره</button>
                                            <a type="reset" href="{{route('admin.users.index')}}" class="btn btn-outline-warning mr-1 mb-1">کنسل
                                            </a>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection


@push('scripts')


@endpush
