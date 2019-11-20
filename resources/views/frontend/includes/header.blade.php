<div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light main_box">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="/">Trang chủ</a></li>
                    <li class="nav-item submenu dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true"
                           aria-expanded="false">Danh mục sản phẩm</a>
                        <ul class="dropdown-menu">
                            @foreach($categories as $category)
                                @if($category->parent_id == null)
                                    <li class="nav-item submenu dropdown"><a data-id="{{$category->id}}" class="nav-link" href="/category/{{$category->slug}}">{{$category->name}}</a></li>
                                @endif
                            @endforeach
{{--                                <li class="nav-item submenu dropdown"><a class="nav-link" href="/category" >Tất cả sản phẩm</a></li>--}}
                        </ul>
                    </li>
                    @if(Auth::check())
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false"><img class="avatar avatar-xs" width="25" height="25"
                                                          src="{{asset('storage/images/default_avatar.png')}}"></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="single-product.html">Cài đặt tài
                                        khoản</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">Đăng xuất</a>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Đăng nhâp/Đăng ký</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="contact.html">Liên hệ</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a href="{{route('frontend.cart')}}" class="cart"><span class="ti-bag"></span></a></li>
                    <li class="nav-item">
                        <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="search_input" id="search_input_box">
    <div class="container">
        <form class="d-flex justify-content-between">
            <input type="text" class="form-control" id="search_input" placeholder="Search Here">
            <button type="submit" class="btn"></button>
            <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
        </form>
    </div>
</div>
