@extends('frontend.layouts.master')
@section('title')
    Giỏ hàng
    @endsection
@section('banner')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Giỏ hàng</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{route('frontend.cart')}}">Giỏ hàng</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    @endsection
@section('content')
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach (Cart::content() as $product)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img width="100" height="100" src="{{asset('storage/'. $product->options->image)}}" alt="">
                                    </div>
                                    <div class="media-body">
                                        <p><a href="{{route('frontend.product', $product->options->slug)}}">{{$product->name}}</a></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>{{number_format($product->price)}}đ</h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input type="number" name="qty" id="sst{{$product->id}}" maxlength="12" value="{{$product->qty}}" min="0" title="Quantity:"
                                           class="input-text qty">
                                </div>
                            </td>
                            <td>
                                <h5>{{number_format($product->total)}}đ</h5>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bottom_button">
                            <td>
                                <a id="update" class="gray_btn" href="javascript:;">Cập nhật giỏ hàng</a>
                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Tổng cộng</h5>
                            </td>
                            <td>
                                <h5>{{Cart::subtotal()}}đ</h5>
                            </td>
                        </tr>
{{--                        <tr class="shipping_area">--}}
{{--                            <td>--}}

{{--                            </td>--}}
{{--                            <td>--}}

{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <h5>Shipping</h5>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div class="shipping_box">--}}
{{--                                    <ul class="list">--}}
{{--                                        <li><a href="#">Flat Rate: $5.00</a></li>--}}
{{--                                        <li><a href="#">Free Shipping</a></li>--}}
{{--                                        <li><a href="#">Flat Rate: $10.00</a></li>--}}
{{--                                        <li class="active"><a href="#">Local Delivery: $2.00</a></li>--}}
{{--                                    </ul>--}}
{{--                                    <h6>Calculate Shipping <i class="fa fa-caret-down" aria-hidden="true"></i></h6>--}}
{{--                                    <select class="shipping_select">--}}
{{--                                        <option value="1">Bangladesh</option>--}}
{{--                                        <option value="2">India</option>--}}
{{--                                        <option value="4">Pakistan</option>--}}
{{--                                    </select>--}}
{{--                                    <select class="shipping_select">--}}
{{--                                        <option value="1">Select a State</option>--}}
{{--                                        <option value="2">Select a State</option>--}}
{{--                                        <option value="4">Select a State</option>--}}
{{--                                    </select>--}}
{{--                                    <input type="text" placeholder="Postcode/Zipcode">--}}
{{--                                    <a class="gray_btn" href="#">Update Details</a>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        <tr class="out_button_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn" href="/">Trang chủ</a>
                                    <a class="primary-btn" href="{{route('frontend.get-bill')}}">Tiến hành thanh toán</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
        });
        $(document).on('click', "#update", function () {
            var quantity = [];
            $(".qty").each(function(){
                quantity.push($(this).val())
            })
            $.ajax({
                type: 'post',
                data: {quantity: quantity},
                url: '/update-cart',
                success: function () {
                    toastr.success( 'Cập nhật giỏ hàng thành công!')
                }
            })
        })
    </script>
    @endsection
