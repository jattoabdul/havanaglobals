@extends('front.base')
@section('content')

    <!--Breadcrumb Section Start-->
    <section class="breadcrumb-bg">
        <div class="theme-container container ">
            <div class="site-breadcumb white-clr">
                <ol class="breadcrumb breadcrumb-menubar">
                    <li> <a href="{{ route('home') }}"> Home </a> Checkout  </li>
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
                            <span class="light-font">checkout </span> <strong>method </strong>
                        </a>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="chk-body pt-15 block-inline">
                            <div class="col-md-6">
                                <form class="chk-form" >
                                    <h2 class="title-1">check as a guest or register</h2>
                                    <p>Register with us for future convenience:</p>
                                    <div class="form-group block-inline ">
                                        <label class="radio-inline title-1"> <input type="radio" name="checkout-radio" id="chk-register" value="1" checked> <span> register </span>  </label>
                                        <label class="radio-inline title-1"> <input type="radio" name="checkout-radio" id="chk-guest" value="1"> <span> checkout as guest </span>  </label>
                                    </div>
                                    <h2 class="title-1"> register and save time ! </h2>
                                    <p>Register with us for future convenience:</p>
                                    <ul>
                                        <li> <span class="fa fa-arrow-circle-o-right"></span> Fast and easy check out </li>
                                        <li> <span class="fa fa-arrow-circle-o-right"></span> Easy access to your order history and status </li>
                                    </ul>
                                    <div class="form-group block-inline text-right">
                                        <button class="theme-btn-sm-2 btn submit-btn checkout-continue" type="button"> <b> Continue </b> </button>
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
                                </form>

                                <form id="checkout-register-form" action="/register" class="register-form" style="display: none">
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
                                        <b class="black-color fpw"> Forgot Your Password ? </b>
                                        <button class="theme-btn-sm-3 btn submit-btn checkout-register" type="submit" id="ajax_register_feedback"> <b> Register </b> </button>
                                    </div>
                                </form>

                                <form id="checkout-guest-form" action="{{ route('guest_register') }}" class="guest-form" style="display: none">
                                    <h2 class="title-1"> Guest Checkout</h2>
                                    <p class=""> Please fill the form below : </p>
                                    <p class="text-danger" style="color: red !important;" id="guest-error-response"></p>
                                    <div class="form-group block-inline">
                                        <label> First Name <span class="red-clr"> * </span> </label>
                                        <input required="" type="text" title="" data-placement="bottom" data-toggle="tooltip" id="guest-firstname" name="first_name" class="form-control name input-your-name">
                                    </div>
                                    <div class="form-group block-inline">
                                        <label> Last Name <span class="red-clr"> * </span> </label>
                                        <input required="" type="text" title="" data-placement="bottom" data-toggle="tooltip" id="guest-lastname" name="last_name" class="form-control name input-your-name">
                                    </div>
                                    <div class="form-group block-inline">
                                        <label> Email Address <span class="red-clr"> * </span> </label>
                                        <input required="" type="email" title="" data-placement="bottom" data-toggle="tooltip" id="guest-email" name="email" class="form-control name input-your-name">
                                    </div>
                                    <div class="form-group block-inline">
                                        <label> Tel <span class="red-clr"> * </span> </label>
                                        <input required="" type="text" title="" data-placement="bottom" data-toggle="tooltip" id="guest-tel" name="tel" class="form-control name input-your-name">
                                    </div>
                                    <label class="red-clr">* Required Filelds</label>
                                    <div class="form-group block-inline text-right">
                                        <button class="theme-btn-sm-3 btn submit-btn checkout-guest" type="submit" id="ajax_guest_feedback"> <b> Submit </b> </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif


                <div class="panel">
                    <div class="chk-heading">
                        <a class="fsz-30" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <span class="light-font">billing </span> <strong>information </strong>
                        </a>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse{{ (Auth::check())?' in':'' }}">
                        <div class="chk-body pt-15 block-inline">
                            @foreach($addresses as $address)

                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="chk-heading">
                        <a class="fsz-30" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <span class="light-font">shipping </span> <strong>information </strong>
                        </a>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="chk-body pt-15 block-inline">
                            @foreach($addresses as $address)

                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="chk-heading">
                        <a class="fsz-30" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            <span class="light-font">shipping </span> <strong>method </strong>
                        </a>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="chk-body pt-15 block-inline">
                            <p> SHIPPING METHOD HERE </p>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="chk-heading">
                        <a class="fsz-30" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                            <span class="light-font">payment </span> <strong>information </strong>
                        </a>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                        <div class="chk-body pt-15 block-inline">
                            <p> PAYMENT INFORMATION HERE </p>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="chk-heading">
                        <a class="fsz-30" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                            <span class="light-font">order </span> <strong>review </strong>
                        </a>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse">
                        <div class="chk-body pt-15 block-inline">
                            <p> ORDER REVIEW HERE </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- / Checkout Ends -->

@endsection