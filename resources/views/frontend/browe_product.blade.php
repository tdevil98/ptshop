@extends('frontend.layouts.master')
@section('banner')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Sản phẩm</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/category/{{$cate->slug}}">{{$cate->name}}</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    @endsection
@section('content')
    <section style="padding-top: 100px;" class="browe_product_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="sidebar-categories">
                        <div class="head">Danh sách danh mục</div>
                        <ul class="main-categories">
                            @foreach($categories as $category)
                            <li class="main-nav-list"><a href="/category/{{$category->slug}}" ><span
                                        class="lnr lnr-arrow-right"></span>{{$category->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar-filter mt-50">
                        <div class="top-filter-head">Lọc sản phẩm</div>
{{--                        <div class="common-filter">--}}
{{--                            <div class="head">Brands</div>--}}
{{--                            <form action="#">--}}
{{--                                <ul>--}}
{{--                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">Apple<span>(29)</span></label></li>--}}
{{--                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="asus" name="brand"><label for="asus">Asus<span>(29)</span></label></li>--}}
{{--                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="gionee" name="brand"><label for="gionee">Gionee<span>(19)</span></label></li>--}}
{{--                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="micromax" name="brand"><label for="micromax">Micromax<span>(19)</span></label></li>--}}
{{--                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="samsung" name="brand"><label for="samsung">Samsung<span>(19)</span></label></li>--}}
{{--                                </ul>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                        <div class="common-filter">
                            <div class="head">Màu sắc</div>
                            <form action="#">
                                <ul>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather" name="color"><label for="balckleather">Black
                                            Leather<span>(29)</span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="blackred" name="color"><label for="blackred">Black
                                            with red<span>(19)</span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey" name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
                                </ul>
                            </form>
                        </div>
                        <div class="common-filter">
                            <div class="head">Giá</div>
                            <div class="price-range-area">
                                <div id="price-range"></div>
                                <div class="value-wrapper d-flex">
                                    <div class="price">Giá:</div>
                                    <span>$</span>
                                    <div id="lower-value"></div>
                                    <div class="to">đến</div>
                                    <span>$</span>
                                    <div id="upper-value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7">
                    <!-- Start Filter Bar -->
                    <div class="filter-bar d-flex flex-wrap align-items-center">
                        <div class="sorting">
                            <select>
                                <option value="1">Default sorting</option>
                                <option value="1">Default sorting</option>
                                <option value="1">Default sorting</option>
                            </select>
                        </div>
                        <div class="sorting mr-auto">
                            <select>
                                <option value="1">Show 12</option>
                                <option value="1">Show 12</option>
                                <option value="1">Show 12</option>
                            </select>
                        </div>
                        <div class="pagination">
                            <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                            <a href="#" class="active">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                            <a href="#">6</a>
                            <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <!-- End Filter Bar -->
                    <!-- Start Best Seller -->
                    <section class="lattest-product-area pb-40 category-list">
                        <div class="row">
                            <!-- single product -->
                            @foreach($products as $product)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-product">
                                    <img style="object-fit: cover; height: 255px!important;" class="img-fluid" src="{{asset('storage/'. $product->image->first()->image)}}" alt="">
                                    <div class="product-details">
                                        <h6>{{$product->name}}</h6>
                                        <div class="price">
                                            <h6>{{$product->sale_price}}</h6>
                                            <h6 class="l-through">{{$product->origin_price}}</h6>
                                        </div>
                                        <div class="prd-bottom">

                                            <a data-id="{{$product->id}}" href="javascript:;" class="social-info addToCart">
                                                <span class="ti-bag"></span>
                                                <p class="hover-text">Giỏ hàng</p>
                                            </a>
                                            <a href="/product/{{$product->slug}}" class="social-info">
                                                <span class="lnr lnr-move"></span>
                                                <p class="hover-text">Xem chi tiết</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                        </div>
                    </section>
                    <!-- End Best Seller -->
                    <!-- Start Filter Bar -->
                    <div class="filter-bar d-flex flex-wrap align-items-center">
                        <div class="sorting mr-auto">
                            <select>
                                <option value="1">Show 12</option>
                                <option value="1">Show 12</option>
                                <option value="1">Show 12</option>
                            </select>
                        </div>
                        <div class="pagination">
                            <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                            <a href="#" class="active">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                            <a href="#">6</a>
                            <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <!-- End Filter Bar -->
                </div>
            </div>
        </div>
    </section>
    @endsection
@section('script')
    @endsection
