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
                        <a href="/">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{route('login')}}">Đăng ký tài khoản</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div style="margin: 10px auto" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Đăng ký tài khoản</div>

                    <div class="card-body">
                        <form class="row login_form" method="POST" action="{{ route('register') }}"
                              novalidate="novalidate">
                            @csrf

                            <div class="col-md-12 row form-group">
                                <label for="name" class="col-md-12 col-form-label">Họ và tên</label>

                                <div class="col-md-12">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 row form-group row">
                                <label for="email" class="col-md-12 col-form-label">Email</label>

                                <div class="col-md-12">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 row form-group row">
                                <label for="password" class="col-md-12 col-form-label">Mật khẩu</label>

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 row form-group row">
                                <label for="password-confirm"
                                       class="col-md-12 col-form-label">Xác nhận mật khẩu</label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="col-md-12 row form-group row">
                                <button type="submit" class="primary-btn">
                                    Đăng ký
                                </button>
                                <a href="{{route('login')}}">Bạn đã có tài khoản??</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
