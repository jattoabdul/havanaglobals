@extends('front.base')
@section('content')
    <!--Breadcrumb Section Start-->
    <section class="breadcrumb-bg">
        <div class="theme-container container ">
            <div class="site-breadcumb white-clr">
                <ol class="breadcrumb breadcrumb-menubar">
                    <li> <a href="{{ route('home') }} "> Home </a> Order Confirmation  </li>
                </ol>
            </div>
        </div>
    </section>
    <!--Breadcrumb Section End-->

    <!-- Cart Starts-->
    <section class="shop-wrap sec-space">
        <div class="container">
            <!-- Shopping Cart Starts -->
            <div class="cart-table">

                <h3 class="clr-txt">{{ session('msg') }}</h3>

                <div class="shp-btn col-sm-12">
                    <a href="/" class="theme-btn-2 btn"> <b> CONTINUE SHOPPING </b> </a>
                </div>

            </div>
            <!-- / Shopping Cart Ends -->
        </div>
    </section>
    <!-- / Cart Ends -->

    <!-- / CONTENT AREA -->
@endsection