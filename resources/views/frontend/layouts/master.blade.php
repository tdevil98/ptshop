<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>@yield('title')</title>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="frontend/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- CSS============================================= -->
    <link rel="stylesheet" href="{{asset('frontend/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/ion.rangeSlider.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/ion.rangeSlider.skinFlat.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/main.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>

<!-- Start Header Area -->
<header class="header_area sticky-header">
    @include('frontend.includes.header')
</header>
<!-- End Header Area -->

<!-- start banner Area -->
@yield('banner')

<!-- End banner Area -->

<!-- start features Area -->
@yield('content')

<!-- Start related-product Area -->
{{--<section class="related-product-area section_gap_bottom">--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-lg-6 text-center">--}}
{{--                <div class="section-title">--}}
{{--                    <h1>Deals of the Week</h1>--}}
{{--                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore--}}
{{--                        magna aliqua.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-9">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">--}}
{{--                        <div class="single-related-product d-flex">--}}
{{--                            <a href="#"><img src="img/r1.jpg" alt=""></a>--}}
{{--                            <div class="desc">--}}
{{--                                <a href="#" class="title">Black lace Heels</a>--}}
{{--                                <div class="price">--}}
{{--                                    <h6>$189.00</h6>--}}
{{--                                    <h6 class="l-through">$210.00</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">--}}
{{--                        <div class="single-related-product d-flex">--}}
{{--                            <a href="#"><img src="img/r2.jpg" alt=""></a>--}}
{{--                            <div class="desc">--}}
{{--                                <a href="#" class="title">Black lace Heels</a>--}}
{{--                                <div class="price">--}}
{{--                                    <h6>$189.00</h6>--}}
{{--                                    <h6 class="l-through">$210.00</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">--}}
{{--                        <div class="single-related-product d-flex">--}}
{{--                            <a href="#"><img src="img/r3.jpg" alt=""></a>--}}
{{--                            <div class="desc">--}}
{{--                                <a href="#" class="title">Black lace Heels</a>--}}
{{--                                <div class="price">--}}
{{--                                    <h6>$189.00</h6>--}}
{{--                                    <h6 class="l-through">$210.00</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">--}}
{{--                        <div class="single-related-product d-flex">--}}
{{--                            <a href="#"><img src="img/r5.jpg" alt=""></a>--}}
{{--                            <div class="desc">--}}
{{--                                <a href="#" class="title">Black lace Heels</a>--}}
{{--                                <div class="price">--}}
{{--                                    <h6>$189.00</h6>--}}
{{--                                    <h6 class="l-through">$210.00</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">--}}
{{--                        <div class="single-related-product d-flex">--}}
{{--                            <a href="#"><img src="img/r6.jpg" alt=""></a>--}}
{{--                            <div class="desc">--}}
{{--                                <a href="#" class="title">Black lace Heels</a>--}}
{{--                                <div class="price">--}}
{{--                                    <h6>$189.00</h6>--}}
{{--                                    <h6 class="l-through">$210.00</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">--}}
{{--                        <div class="single-related-product d-flex">--}}
{{--                            <a href="#"><img src="img/r7.jpg" alt=""></a>--}}
{{--                            <div class="desc">--}}
{{--                                <a href="#" class="title">Black lace Heels</a>--}}
{{--                                <div class="price">--}}
{{--                                    <h6>$189.00</h6>--}}
{{--                                    <h6 class="l-through">$210.00</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-4 col-sm-6">--}}
{{--                        <div class="single-related-product d-flex">--}}
{{--                            <a href="#"><img src="img/r9.jpg" alt=""></a>--}}
{{--                            <div class="desc">--}}
{{--                                <a href="#" class="title">Black lace Heels</a>--}}
{{--                                <div class="price">--}}
{{--                                    <h6>$189.00</h6>--}}
{{--                                    <h6 class="l-through">$210.00</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-4 col-sm-6">--}}
{{--                        <div class="single-related-product d-flex">--}}
{{--                            <a href="#"><img src="img/r10.jpg" alt=""></a>--}}
{{--                            <div class="desc">--}}
{{--                                <a href="#" class="title">Black lace Heels</a>--}}
{{--                                <div class="price">--}}
{{--                                    <h6>$189.00</h6>--}}
{{--                                    <h6 class="l-through">$210.00</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-4 col-sm-6">--}}
{{--                        <div class="single-related-product d-flex">--}}
{{--                            <a href="#"><img src="img/r11.jpg" alt=""></a>--}}
{{--                            <div class="desc">--}}
{{--                                <a href="#" class="title">Black lace Heels</a>--}}
{{--                                <div class="price">--}}
{{--                                    <h6>$189.00</h6>--}}
{{--                                    <h6 class="l-through">$210.00</h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3">--}}
{{--                <div class="ctg-right">--}}
{{--                    <a href="#" target="_blank">--}}
{{--                        <img class="img-fluid d-block mx-auto" src="img/category/c5.jpg" alt="">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!-- End related-product Area -->

<!-- start footer Area -->
<footer class="footer-area section_gap">
   @include('frontend.includes.footer')
</footer>
<!-- End footer Area -->
<script src="{{asset('frontend/js/vendor/jquery-2.2.4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="{{asset('frontend/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.sticky.js')}}"></script>
<script src="{{asset('frontend/js/nouislider.min.js')}}"></script>
<script src="{{asset('frontend/js/countdown.js')}}"></script>
<script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<!--gmaps Js-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
<script src="{{asset('frontend/js/gmaps.min.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@yield('script')
<script>
    $('.addToCart').on('click', function () {
        let id = $(this).attr('data-id');
        $.ajax({
            url: '/addtocart/'+ id,
            dataType: "json",
            success : function (res) {
                if(res.message){
                    toastr.success('Thêm vào giỏ hàng thành công');
                }else{
                    window.location.replace("{{route('login')}}");
                }
            },
            error : function () {
                toastr.error('Thêm vào giỏ hàng không thành công');
            }
        })
    })
</script>
</body>

</html>
