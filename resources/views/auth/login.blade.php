@extends('front.base')
@section('content')

    <!--Breadcrumb Section Start-->
    <section class="breadcrumb-bg">
        <div class="theme-container container ">
            <div class="site-breadcumb white-clr">
                <ol class="breadcrumb breadcrumb-menubar">
                    <li> <a href="{{ route('home') }}"> Home </a> Login  </li>
                </ol>
            </div>
        </div>
    </section>
    <!--Breadcrumb Section End-->

    <!-- Checkout Starts-->
    <section class="checkout-wrap sec-space">
        <div class="container">
            <div class="panel-group chk-panel" id="accordion">
                @if(!Auth::check())
                    <div class="panel">
                        <div class="chk-heading">
                            <a class="fsz-30" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <span class="light-font">Account </span> <strong> Login </strong>
                            </a>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="chk-body pt-15 block-inline">
                                <div class="col-md-6">
                                    <form class="chk-form" >
                                        <h2 class="title-1">Create an account</h2>
                                        <p>Register with us for future convenience:</p>
                                        <div class="form-group block-inline ">
                                            <label class="radio-inline title-1"> <input type="radio" name="checkout-radio" id="chk-register" value="1" checked> <span> register </span>  </label>
                                        </div>
                                        <h2 class="title-1"> register and save time ! </h2>
                                        <p>Register with us for future convenience:</p>

                                        <div class="form-group block-inline text-right">
                                            <button class="theme-btn-sm-2 btn submit-btn checkout-continue" type="button"> <b> Register </b> </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <form id="checkout-login-form" method="post" action="/login">
                                        <h2 class="title-1"> already registed ? </h2>
                                        <p class=""> Please log in below : </p>
                                        <p class="text-danger" style="color: red !important;" id="login-error-response"></p>
                                        <div class="form-group block-inline">
                                            <label> Email Address <span class="red-clr"> * </span> </label>
                                            <input required="" type="text" title="" data-placement="bottom" data-toggle="tooltip" value="" name="login-email" id="login-email" class="form-control name input-your-name">
                                        </div>
                                        <div class="form-group block-inline">
                                            <label> Password <span class="red-clr"> * </span> </label>
                                            <input required="" type="password" title="" data-placement="bottom" data-toggle="tooltip" value="" name="login-password" id="login-password" class="form-control name input-your-name">
                                        </div>
                                        <label class="red-clr">* Required Filelds</label>
                                        <div class="form-group block-inline text-right">
                                            <b class="black-color fpw"> Forgot Your Password ? </b>
                                            <button class="theme-btn-sm-3 btn submit-btn checkout-login" type="submit" id="ajax_login_feedback"> <b> Log In </b> </button>
                                        </div>
                                        {{ csrf_field() }}
                                    </form>

                                    <form id="checkout-register-form" action="/register" method="post" class="register-form" style="display: none">
                                        <h2 class="title-1"> Register</h2>
                                        <p class=""> Please register below : </p>
                                        <p class="text-danger" style="color: red !important;" id="register-error-response"></p>
                                        <div class="form-group block-inline">
                                            <label> First Name <span class="red-clr"> * </span> </label>
                                            <input required="" type="text" title="First Name" data-placement="bottom" data-toggle="tooltip" id="reg-firstname" name="first_name" class="form-control name input-your-name">
                                        </div>
                                        <div class="form-group block-inline">
                                            <label> Last Name <span class="red-clr"> * </span> </label>
                                            <input required="" type="text" title="" data-placement="bottom" data-toggle="tooltip" id="reg-lastname" name="last_name" class="form-control name input-your-name">
                                        </div>
                                        <div class="form-group block-inline">
                                            <label> Email Address <span class="red-clr"> * </span> </label>
                                            <input required="" type="email" title="" data-placement="bottom" data-toggle="tooltip" id="reg-email" name="email" class="form-control name input-your-name">
                                        </div>
                                        <div class="form-group block-inline">
                                            <label> Password <span class="red-clr"> * </span> </label>
                                            <input required="" type="password" title="" data-placement="bottom" data-toggle="tooltip" id="reg-password" name="password" class="form-control name input-your-name">
                                        </div>
                                        <div class="form-group block-inline">
                                            <label> Tel <span class="red-clr"> * </span> </label>
                                            <input required="" type="text" title="" data-placement="bottom" data-toggle="tooltip" id="reg-tel" name="tel" class="form-control name input-your-name">
                                        </div>
                                        <label class="red-clr">* Required Filelds</label>
                                        <div class="form-group block-inline text-right">
                                            <button class="theme-btn-sm-2 btn submit-btn pull-left" type="button" id="switch-to-login"> <b> Login instead </b> </button>
                                            <button class="theme-btn-sm-3 btn submit-btn checkout-register" type="submit" id="ajax_register_feedback"> <b> Create account </b> </button>
                                        </div>
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- / Checkout Ends -->
@endsection