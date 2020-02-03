@extends('frontend.layouts.master')
@section('title')
    Thanh toán
    @endsection
@section('banner')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    @endsection
@section('content')
    <section class="checkout_area section_gap">
        <div class="container">
{{--            <div class="returning_customer">--}}
{{--                <div class="check_title">--}}
{{--                    <h2>Returning Customer? <a href="#">Click here to login</a></h2>--}}
{{--                </div>--}}
{{--                <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new--}}
{{--                    customer, please proceed to the Billing & Shipping section.</p>--}}
{{--                <form class="row contact_form" action="#" method="post" novalidate="novalidate">--}}
{{--                    <div class="col-md-6 form-group p_star">--}}
{{--                        <input type="text" class="form-control" id="name" name="name">--}}
{{--                        <span class="placeholder" data-placeholder="Username or Email"></span>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6 form-group p_star">--}}
{{--                        <input type="password" class="form-control" id="password" name="password">--}}
{{--                        <span class="placeholder" data-placeholder="Password"></span>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 form-group">--}}
{{--                        <button type="submit" value="submit" class="primary-btn">login</button>--}}
{{--                        <div class="creat_account">--}}
{{--                            <input type="checkbox" id="f-option" name="selector">--}}
{{--                            <label for="f-option">Remember me</label>--}}
{{--                        </div>--}}
{{--                        <a class="lost_pass" href="#">Lost your password?</a>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <div class="cupon_area">--}}
{{--                <div class="check_title">--}}
{{--                    <h2>Have a coupon? <a href="#">Click here to enter your code</a></h2>--}}
{{--                </div>--}}
{{--                <input type="text" placeholder="Enter coupon code">--}}
{{--                <a class="tp_btn" href="#">Apply Coupon</a>--}}
{{--            </div>--}}
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Chi tiết hóa đơn</h3>
                        <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                            <div class="col-md-12 form-group p_star">
                                <input type="text" placeholder="Họ và tên" class="form-control" id="name" name="name" value="@if(isset(Auth::user()->name)){{Auth::user()->name}}@endif">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" placeholder="Số điện thoại" class="form-control" id="number" name="number" value="@if(isset(Auth::user()->phone_number)){{Auth::user()->phone_number}}@endif">
{{--                                <span class="placeholder" data-placeholder="Số điện thoại"></span>--}}
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" placeholder="Email" class="form-control" id="email" name="compemailany" value="@if(isset(Auth::user()->email)){{Auth::user()->email}}@endif">
{{--                                <span class="placeholder" data-placeholder="Địa chỉ email"></span>--}}
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" placeholder="Địa chỉ" class="form-control" id="address" name="address" value="@if(isset(Auth::user()->address)){{Auth::user()->address}}@endif">
{{--                                <span class="placeholder" data-placeholder="Địa chỉ"></span>--}}
                            </div>
                            <div class="col-md-12 form-group">
                                <h3>Ghi chú thêm</h3>
                                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Ghi chú"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Đơn hàng</h2>
                            <ul class="list">
                                <li><a href="#">Sản phẩm <span>Tổng tiền</span></a></li>
                                @foreach(Cart::content() as $product)
                                <li><a href="/product/{{$product->options->slug}}">{{$product->name}}<span class="middle">x {{$product->qty}}</span> <span class="">{{$product->price}} đ</span></a></li>
                                    @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Giá tạm thời <span>{{Cart::subtotal()}}đ</span></a></li>
                                <li><a href="#">Thuế <span>{{Cart::tax()}}đ</span></a></li>
                                <li><a href="#">Tổng tiền <span>{{Cart::total()}}đ</span></a></li>
                            </ul>
                            <a id="submit-bill" class="primary-btn" href="javascript:;">Xác nhận đơn hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $(document).on('click', "#submit-bill", function () {
            $.ajax({
                type : 'post',
                url: '/submit-bill',
                success:function () {
                    toastr.success('Thanh toán thành công!');
                    window.location.href = '/';
                }
            })
        })
    </script>
    @endsection
