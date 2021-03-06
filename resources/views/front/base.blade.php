<!DOCTYPE html>
<!--[if IE 7]><html class="no-js ie7 oldie" lang="en-US"> <![endif]-->
<!--[if IE 8]><html class="no-js ie8 oldie" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>{{env('APP_NAME')}}</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('front/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="shortcut icon" href="{{ asset('front/ico/favicon.ico') }}">

    <!-- Font Icon -->
    <link href="{{ asset('front/css/plugin/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- CSS Global -->
    <link href="{{ asset('front/css/plugin/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('front/css/plugin/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('front/css/plugin/owl.carousel.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('front/css/plugin/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('front/css/plugin/subscribe-better.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet" />

    <!-- Color CSS -->

    <!--[if lt IE 9]>
    <script src="{{ asset('front/js/plugin/html5shiv.js') }}"></script>
    <script src="{{ asset('front/js/plugin/respond.js') }}"></script>
    <![endif]-->
</head>

<body id="home" class="wide">
<style>
    .preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #000;
        filter:alpha(opacity=50);
        -moz-opacity:0.5;
        -khtml-opacity: 1.0;
        opacity: 1.0;
        z-index: 1000;
        background: url('/front/img/ajax-loader.gif') no-repeat center;min-height: 200px;
        background-color: #ffffff;
    }
</style>

<!-- WRAPPER -->
<main class="wrapper home-wrap">
    <!-- CONTENT AREA -->

    <!-- Main Header Start -->
    <header class="main-header is-sticky">
        <div class="container-fluid rel-div">
            <div class="col-lg-4 col-sm-8">
                <div class="main-logo">
                    <a href="{{ route('home') }}"> <strong>{{ env('APP_NAME') }}<img src="{{ asset('front/img/icons/logo-icon.png') }}" alt="" /> </strong>  </a>
                    <span class="medium-font">ORGANIC STORE</span>
                </div>
            </div>

            <div class="col-lg-6 responsive-menu">
                <div class="responsive-toggle fa fa-bars"> </div>
                <nav class="fix-navbar" id="primary-navigation">
                    <form action="/logout" method="post" id="logout-form">{{ csrf_field() }}</form>
                    <ul class="primary-navbar">
                        <li class="@yield('home-active')"> <a href="{{ route('home') }}">Home</a> </li>
                        <li class="@yield('shop-active')"><a href="{{ route('shop') }}">Shop</a></li>
                        <li class="@yield('about-active')"><a href="{{ route('about') }}">About</a></li>
                        {{--
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" >Categories</a>
                            <ul class="dropdown-menu">
                                <li><a href="shop-1.html"> shop </a></li>
                                <li><a href="shop-2.html"> shop 2 </a></li>
                                <li><a href="shop-single.html"> shop single </a></li>
                                <li><a href="my-account.html"> my account </a></li>
                            </ul>
                        </li>
                        --}}
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        @if(Auth::check())
                        <li class="@yield('account-active')"><a href="{{ route('user_account') }}">My Account</a></li>
                        <li><a href="javascript:;" onclick="document.getElementById('logout-form').submit();">Logout</a></li>
                        @else
                        <li class="@yield('login-active')"><a href="{{ route('login') }}">Login / Register</a></li>
                        @endif
                    </ul>
                </nav>
            </div>

            <div class="col-lg-2 col-sm-4 cart-megamenu">
                <!-- Cart -->
                @include('front.fragments.cart')

                <div class="mega-submenu">
                    <span class="nav-trigger">
                        <a class="menu-toggle" href="#"> <img src="{{ asset('front/img/icons/menu.png') }}" alt="" /> </a>
                    </span>
                    <div class="mega-dropdown-menu">
                        <a class="menu-toggle fa fa-close" href="#">  </a>
                        <div class="slider-mega-menu">
                            @foreach(\App\Category::all() as $category)
                                <div class="menu-block">
                                <div class="menu-caption">
                                    <h2 class="menu-title"> <a href="{{ route('shop', ['cat'=>urlencode($category->name)]) }}"><span class="light-font">  </span>  <strong> {{ $category->name }}</strong> </a></h2>
                                    {{--
                                    <ul class="sub-list">
                                        <li> <a href="#">Banana</a> </li>
                                    </ul>
                                    --}}
                                    <h2 class="title"> <a href="{{ route('shop', ['cat'=>urlencode($category->name)]) }}" class="clr-txt"> All Fruits </a> </h2>
                                </div>
                                <div class="menu-img">
                                    <img alt="" src="{{ $category->img }}" />
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="responsive-toggle fa fa-bars"> </div>
            </div>

        </div>
    </header>
    <!-- / Main Header Ends -->

    @yield('content')


<!-- FOOTER -->
    <footer class="page-footer">
        <section class="sec-space light-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12 footer-widget">
                        <div class="main-logo">
                            <a href="{{ route('home') }}"> <strong>{{ env('APP_NAME') }} <img src="{{ asset('front/img/icons/logo-icon.png') }}" alt="" /> </strong>  </a>
                            <span class="medium-font">ORGANIC STORE</span>
                        </div>
                        <span class="divider-2"></span>
                        <div class="text-widget">
                            <ul>
                                <li> <i class="fa fa-map-marker"></i> <span> <strong>Suite 24, Odu'a Shopping Centre,</strong> Idi-Ape, Iwo-Road, Ibadan </span> </li>
                                <li> <i class="fa fa-envelope-square"></i> <span><a href="mailto:customercare@havanaglobals.com">customercare@havanaglobals.com</a> </span> </li>
                                <li> <i class="fa fa-envelope-square"></i> <span><a href="mailto:oyinloye.ayo@havanaglobals.com">oyinloye.ayo@havanaglobals.com</a> </span> </li>
                                <li> <i class="fa fa-envelope-square"></i> <span><a href="mailto:sunkanmi.oyedola@havanaglobals.com">sunkanmi.oyedola@havanaglobals.com</a> </span> </li>
                                <li> <i class="fa fa-phone-square"></i> <span><a href="tel:+2349061173187">+234 (803) 391 4305</a> </span> </li>
                                <li> <i class="fa fa-phone-square"></i> <span><a href="tel:+2349061173187">+234 (906) 117 3187</a> </span> </li>
                                <li> <i class="fa fa-phone-square"></i> <span><a href="tel:+17735432705">+1 (773) 543 2705</a> </span> </li>
                                <li> <i class="fa fa-globe"></i> <span><a href="www.havanaglobals.com">www.havanaglobals.com</a> </span> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 footer-widget">
                        <h2 class="title-1">  <span class="light-font">havana  </span> <strong>information </strong> </h2>
                        <span class="divider-2"></span>
                        <ul class="list">
                            <li> <a href="{{ route('about') }}"> about our shop </a> </li>
                            <li> <a href="{{ route('shop') }}"> our shop </a> </li>
                            <li> <a href="#"> top sellers </a> </li>
                            <li> <a href="#"> new products </a> </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-4 footer-widget">
                        <h2 class="title-1">  <span class="light-font">my  </span> <strong>account </strong> </h2>
                        <span class="divider-2"></span>
                        <ul class="list">
                            <li> <a href="{{ route('user_account') }}"> my account </a> </li>
                            <li><a href="{{ route('edit_account') }}"> Account Information </a></li>
                            <li><a href="{{ route('show_address') }}"> Address Books</a></li>
                            <li><a href="{{ route('show_orders') }}"> Order History</a></li>
                            <li><a href="{{ route('show_wishlist') }}"> Wishlist</a></li>
                            <li><a href="#"> Reviews and Ratings</a></li>
                            <li><a href="#"> Newsletter</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-4 footer-widget">
                        <h2 class="title-1">  <span class="light-font">photo  </span> <strong>instagram </strong> </h2>
                        <span class="divider-2"></span>
                        <ul class="instagram-widget">
                            <li> <a href="#"> <img src="{{ asset('front/img/extra/80x80-1.jpg') }}" alt="" /> </a> </li>
                            <li> <a href="#"> <img src="{{ asset('front/img/extra/80x80-2.jpg') }}" alt="" /> </a> </li>
                            <li> <a href="#"> <img src="{{ asset('front/img/extra/80x80-3.jpg') }}" alt="" /> </a> </li>
                            <li> <a href="#"> <img src="{{ asset('front/img/extra/80x80-4.jpg') }}" alt="" /> </a> </li>
                            <li> <a href="#"> <img src="{{ asset('front/img/extra/80x80-5.jpg') }}" alt="" /> </a> </li>
                            <li> <a href="#"> <img src="{{ asset('front/img/extra/80x80-6.jpg') }}" alt="" /> </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="footer-bottom">
            <div class="pattern">
                <img alt="" src="{{ asset('front/img/icons/white-pattern.png') }}">
            </div>
            <div id="to-top" class="to-top"> <i class="fa fa-arrow-circle-o-up"></i> </div>
            <div class="container ptb-50">
                <div class="row">
                    <div class="col-md-6 col-sm-5">
                        <p>©2016 <a href="#"> <strong> www.havanaglobals.com</strong> </a>, made with <i class="fa fa-heart red-clr"></i> by <a target="_blank" href="https://squaresoftng.com">SquareSoft Nigeria</a>, all right reserved</p>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <ul class="primary-navbar footer-menu">
                            <li> <a href="{{ route('contact') }}">contact us </a> </li>
                            <li> <a href="#">term of use  </a> </li>
                            <li> <a href="#">site map  </a> </li>
                            <li> <a href="#">privacy policy</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    <!-- /FOOTER -->
    <div id="to-top-mb" class="to-top mb"> <i class="fa fa-arrow-circle-o-up"></i> </div>
</main>
<!-- /WRAPPER -->

<!-- Product Preview Popup -->
<section class="modal fade in" id="product-preview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg product-modal">
        <div class="modal-content">
            <div class="preview-overlay"></div>
            <a aria-hidden="true" data-dismiss="modal" style="z-index: 1000;" class="sb-close-btn close" href="#"> <i class=" fa fa-close"></i> </a>

            <div class="product-single pb-50 clearfix" id="product-popup-canvas">
                <!-- Single Products Slider Starts -->
                <div class="col-lg-6 col-sm-8 col-sm-offset-2 col-lg-offset-0 pt-50" id="popup-img-holder">
                    <div class="prod-slider sync1" id="sync1">
                        <div class="item">
                            <img src="{{ asset('front/img/products/prod-single-1.png') }}" alt="">
                            <a href="{{ asset('front/img/products/prod-big-1.png') }}" data-gal="prettyPhoto[prettyPhoto]" title="Product" class="caption-link"><i class="arrow_expand"></i></a>
                        </div>
                        <div class="item">
                            <img src="{{ asset('front/img/products/prod-single-2.png') }}" alt="">
                            <a href="{{ asset('front/img/products/prod-big-2.png') }}" data-gal="prettyPhoto[prettyPhoto]" title="Product" class="caption-link"><i class="arrow_expand"></i></a>
                        </div>
                        <div class="item">
                            <img src="{{ asset('front/img/products/prod-single-3.png') }}" alt="">
                            <a href="{{ asset('front/img/products/prod-big-3.png') }}" data-gal="prettyPhoto[prettyPhoto]" title="Product" class="caption-link"><i class="arrow_expand"></i></a>
                        </div>
                        <div class="item">
                            <img src="{{ asset('front/img/products/prod-single-1.png') }}" alt="">
                            <a href="{{ asset('front/img/products/prod-big-1.png') }}" data-gal="prettyPhoto[prettyPhoto]" title="Product" class="caption-link"><i class="arrow_expand"></i></a>
                        </div>
                    </div>

                    <div  class="sync2" id="sync2">
                        <div class="item"> <a href="#"> <img src="{{ asset('front/img/products/thumb-1.png') }}" alt=""> </a> </div>
                        <div class="item"> <a href="#"> <img src="{{ asset('front/img/products/thumb-2.png') }}" alt=""> </a> </div>
                        <div class="item"> <a href="#"> <img src="{{ asset('front/img/products/thumb-3.png') }}" alt=""> </a> </div>
                        <div class="item"> <a href="#"> <img src="{{ asset('front/img/products/thumb-1.png') }}" alt=""> </a> </div>
                    </div>
                </div>
                <!-- Single Products Slider Ends -->

                <div class="col-lg-6 pt-50">
                    <div class="product-content block-inline">
                        {{--
                        <div class="tag-rate">
                            <span class="prod-tag tag-1">new</span> <span class="prod-tag tag-2">sale</span>
                            <div class="rating">
                                <span class="star active"></span>
                                <span class="star active"></span>
                                <span class="star active"></span>
                                <span class="star active"></span>
                                <span class="star active"></span>
                                <span class="fsz-12"> Based on 25 reviews</span>
                            </div>
                        </div>
                        --}}


                        <div class="single-caption">
                            <h3 class="section-title">
                                <a href="#"> <span class="light-font"> organic </span>  <strong>pinapple</strong></a>
                            </h3>
                            <span class="divider-2"></span>
                            <p class="price">
                                <strong class="clr-txt fsz-20">$50.00 </strong> <del class="light-font">$65.00 </del>
                            </p>

                            <div class="fsz-16 description">
                                <p>Lorem ipsum dolor sit amet, consectetuer adiping elit food sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
                            </div>

                            <div class="prod-btns">
                                <div class="quantity">
                                    <button class="btn minus"><i class="fa fa-minus-circle"></i></button>
                                    <input title="Qty" placeholder="03" value="1" id="single-product-qty" class="form-control qty" type="text">
                                    <button class="btn plus"><i class="fa fa-plus-circle"></i></button>
                                </div>

                                <div class="form-group qty"></div>
                            </div>
                            <ul class="meta">
                                {{--
                                <li> <strong> SKU </strong> <span>:  AB2922-B</span> </li>
                                <li class="tags-widget"> <strong> TAGS </strong> <span>:  <a href="#">fruits</a> <a href="#">vegetables</a> <a href="#">juices</a></span> </li>
                                --}}
                                <li> <strong> CATEGORY </strong>: <span class="categories">  Fruits</span> </li>
                            </ul>
                            <div class="divider-full-1"></div>
                            <div class="add-cart pt-15">
                                <a href="#" class="theme-btn btn"> <strong> ADD TO CART </strong> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- / Product Preview Popup -->

<div id="product-popup-content" style="z-index: -10000; position: fixed; display: block">
    <!-- Single Products Slider Starts -->
    <div class="col-lg-6 col-sm-8 col-sm-offset-2 col-lg-offset-0 pt-50" id="popup-img-holder">
        <div class="prod-slider sync-1">
            <div class="item">
                <img src="{{ asset('front/img/products/prod-single-1.png') }}" alt="">
                <a href="{{ asset('front/img/products/prod-big-1.png') }}" data-gal="prettyPhoto[prettyPhoto]" title="Product" class="caption-link"><i class="arrow_expand"></i></a>
            </div>
            <div class="item">
                <img src="{{ asset('front/img/products/prod-single-2.png') }}" alt="">
                <a href="{{ asset('front/img/products/prod-big-2.png') }}" data-gal="prettyPhoto[prettyPhoto]" title="Product" class="caption-link"><i class="arrow_expand"></i></a>
            </div>
            <div class="item">
                <img src="{{ asset('front/img/products/prod-single-3.png') }}" alt="">
                <a href="{{ asset('front/img/products/prod-big-3.png') }}" data-gal="prettyPhoto[prettyPhoto]" title="Product" class="caption-link"><i class="arrow_expand"></i></a>
            </div>
            <div class="item">
                <img src="{{ asset('front/img/products/prod-single-1.png') }}" alt="">
                <a href="{{ asset('front/img/products/prod-big-1.png') }}" data-gal="prettyPhoto[prettyPhoto]" title="Product" class="caption-link"><i class="arrow_expand"></i></a>
            </div>
        </div>

        <div  class="sync-2">
            <div class="item"> <a href="#"> <img src="{{ asset('front/img/products/thumb-1.png') }}" alt=""> </a> </div>
            <div class="item"> <a href="#"> <img src="{{ asset('front/img/products/thumb-2.png') }}" alt=""> </a> </div>
            <div class="item"> <a href="#"> <img src="{{ asset('front/img/products/thumb-3.png') }}" alt=""> </a> </div>
            <div class="item"> <a href="#"> <img src="{{ asset('front/img/products/thumb-1.png') }}" alt=""> </a> </div>
        </div>
    </div>
    <!-- Single Products Slider Ends -->

    <div class="col-lg-6 pt-50">
        <div class="product-content block-inline">

            <div class="tag-rate">
                <span class="prod-tag tag-1">new</span> <span class="prod-tag tag-2">sale</span>
                <div class="rating">
                    <span class="star active"></span>
                    <span class="star active"></span>
                    <span class="star active"></span>
                    <span class="star active"></span>
                    <span class="star active"></span>
                    <span class="fsz-12"> Based on 25 reviews</span>
                </div>
            </div>

            <div class="single-caption">
                <h3 class="section-title">
                    <a href="#"> <span class="light-font"> organic </span>  <strong>pinapple</strong></a>
                </h3>
                <span class="divider-2"></span>
                <p class="price">
                    <strong class="clr-txt fsz-20">$50.00 </strong> <del class="light-font">$65.00 </del>
                </p>

                <div class="fsz-16">
                    <p>Lorem ipsum dolor sit amet, consectetuer adiping elit food sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
                </div>

                <div class="prod-btns">
                    <div class="quantity">
                        <button class="btn minus"><i class="fa fa-minus-circle"></i></button>
                        <input title="Qty" placeholder="03" class="form-control qty" type="text">
                        <button class="btn plus"><i class="fa fa-plus-circle"></i></button>
                    </div>
                    <div class="sort-dropdown">
                        <div class="search-selectpicker selectpicker-wrapper">
                            <select class="selectpicker input-price"  data-width="100%"
                                    data-toggle="tooltip">
                                <option>Kilo</option>
                                <option>2 Kilo</option>
                                <option>3 Kilo</option>
                                <option>4 Kilo</option>
                                <option>5 Kilo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="checkbox-inline"><input value="" type="checkbox"> <span>Ready in stock</span></label> </div>
                </div>
                <ul class="meta">
                    <li> <strong> SKU </strong> <span>:  AB2922-B</span> </li>
                    <li> <strong> CATEGORY </strong> <span>:  Fruits</span> </li>
                    <li class="tags-widget"> <strong> TAGS </strong> <span>:  <a href="#">fruits</a> <a href="#">vegetables</a> <a href="#">juices</a></span> </li>
                </ul>
                <div class="divider-full-1"></div>
                <div class="add-cart pt-15">
                    <a href="#" class="theme-btn btn"> <strong> ADD TO CART </strong> </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{--
<!-- Subscribe Popup-Dark -->
<section id="subscribe-popups" class="subscribe-me popups-wrap">
    <div class="modal-content">
        <button type="button" class="sb-close-btn close popup-cls"> <i class="fa-times fa clr-txt"></i> </button>
        <div class="subscribe-wrap">
            <div class="main-logo">
                <a href="index-2.html"> <strong>naturix <img src="{{ asset('front/img/icons/logo-icon.png') }}" alt="" /> </strong> <span class="light-font">farmfood</span>  </a>
            </div>

            <div class="title-wrap">
                <h2 class="section-title"> <strong>Subscribe Newsletter</strong> </h2>
                <h4 class="fsz-12"> Join our newsletter for free & get latest news weekly </h4>
            </div>

            <form class="newsletter-form">
                <div class="form-group">
                    <input class="form-control" placeholder="enter your email address" required="" type="text">
                </div>
                <div class="form-group">
                    <button class="theme-btn upper-text" type="submit"> <strong> subscribe </strong> </button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- / Subscribe Popup-Dark -->
--}}


<!-- JS Global -->
<script src="{{ asset('front/js/plugin/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('front/js/plugin/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/js/plugin/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('front/js/plugin/owl.carousel.min.js') }}"></script>
<script src="{{ asset('front/js/plugin/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('front/js/plugin/jquery.countdown.js') }}"></script>
<script src="{{ asset('front/js/plugin/jquery.subscribe-better.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('front/js/havana.js') }}"></script>
<script src="{{ asset('front/js/theme.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script>

    @if(session('flash_success'))
    swal("Success","{{session('flash_success')}}","success");
    @endif
    @if(session('flash_info'))
    swal("Note","{{session('flash_info')}}","info");
    @endif
    @if(session('flash_error'))
    swal("Error","{{session('flash_error')}}","error");
    @endif

</script>


</body>

</html>