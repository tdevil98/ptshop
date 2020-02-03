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
            @if(Cart::count()>0)
                <div class="cart_inner">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col"></th>
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
                                        <input type="number" name="qty" maxlength="12" value="{{$product->qty}}" min="0" title="Quantity:"
                                            class="input-text qty">
                                    </div>
                                </td>
                                <td>
                                    <h5 class="price">{{number_format($product->total)}}đ</h5>
                                </td>
                                <td>
                                    <button title="Xóa" type="button" class="close remove" aria-label="Close" data-id="{{$product->rowId}}">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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
                                    <h5>{{Cart::total()}}đ</h5>
                                </td>
                            </tr>

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
            @else
                <div class="alert alert-warning">
                    Giỏ hàng của bạn hiện chưa có sản phẩm nào. Quay về<a href="/"> trang chủ</a>
                </div>
            @endif
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
        $(document).on('click', ".remove", function () {
            var rowId = $(this).data('id');
            var product = $(this);
            $.ajax({
                type: 'post',
                data: {rowId : rowId},
                url: '/remove-cart',
                success: function () {
                    product.parent().parent().remove();
                }
            })
        })
        $(document).on('click', "#update", function () {
            var quantity = [];
            $(".qty").each(function(){
                quantity.push($(this).val())
            })
            $.ajax({
                type: 'post',
                data: {quantity: quantity},
                url: '/update-cart',
                success: function (res) {
                    $(".price").each(function(i){
                        $(this).html(res.price[i]+"đ");
                    })
                    toastr.success( 'Cập nhật giỏ hàng thành công!')
                }
            })
        })
    </script>
    @endsection
