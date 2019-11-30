@extends('frontend.layouts.master')
@section('title')
    Đăng ký tài khoản
    @endsection
@section('banner')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Login/Register</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{route('login')}}">Login/Register</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="">
                        <h3>Đăng ký tài khoản</h3>
                        <form class="row login_form" action="{{ route('register') }}" method="post" id="registerForm" novalidate="novalidate">
                            {{ csrf_field() }}
                            <div class="col-md-12 form-group">
                                <h4>Họ và tên</h4>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập họ và tên'">
                            </div>
                            <div class="col-md-12 form-group">
                                <h4>Email</h4>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập email'">
                            </div>
                            <div class="col-md-12 form-group">
                                <h4>Mật khẩu</h4>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập mật khẩu'">
                            </div>
                            <div class="col-md-12 form-group">
                                <h4>Nhập lại mật khẩu</h4>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập lại mật khẩu'">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">Đăng ký</button>
                                <a href="{{route('login')}}">Bạn đã có tài khoản??</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
