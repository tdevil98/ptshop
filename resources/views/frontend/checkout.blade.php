@extends('frontend.layouts.master')
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
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="name" name="name">
                                <span class="placeholder" data-placeholder="Họ tên"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="number" name="number">
                                <span class="placeholder" data-placeholder="Số điện thoại"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email" name="compemailany">
                                <span class="placeholder" data-placeholder="Địa chỉ email"></span>
                            </div>
{{--                            <div class="col-md-12 form-group p_star">--}}
{{--                                <select class="country_select">--}}
{{--                                    <option value="1">Country</option>--}}
{{--                                    <option value="2">Country</option>--}}
{{--                                    <option value="4">Country</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="add1">
                                <span class="placeholder" data-placeholder="Xã/Phường"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add2" name="add2">
                                <span class="placeholder" data-placeholder="Quận/Huyện"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="city" name="city">
                                <span class="placeholder" data-placeholder="Thành phố"></span>
                            </div>
{{--                            <div class="col-md-12 form-group p_star">--}}
{{--                                <select class="country_select">--}}
{{--                                    <option value="1">District</option>--}}
{{--                                    <option value="2">District</option>--}}
{{--                                    <option value="4">District</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
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
                                <li><a href="#">Fresh Blackberry <span class="middle">x 02</span> <span class="last">$720.00</span></a></li>
                                <li><a href="#">Fresh Tomatoes <span class="middle">x 02</span> <span class="last">$720.00</span></a></li>
                                <li><a href="#">Fresh Brocoli <span class="middle">x 02</span> <span class="last">$720.00</span></a></li>
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Giá tạm thời <span>$2160.00</span></a></li>
                                <li><a href="#">Phí ship <span>Flat rate: $50.00</span></a></li>
                                <li><a href="#">Tổng tiền <span>$2210.00</span></a></li>
                            </ul>
                            <a class="primary-btn" href="#">Xác nhận đơn hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection