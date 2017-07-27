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
                                        <b class="black-color fpw"> Forgot Your Password ? </b>
                                        <button class="theme-btn-sm-3 btn submit-btn checkout-register" type="submit" id="ajax_register_feedback"> <b> Register </b> </button>
                                    </div>
                                    {{ csrf_field() }}
                                </form>

                                <form id="checkout-guest-form" action="{{ route('guest_register') }}" method="post" class="guest-form" style="display: none">
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
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if(Auth::check())
                    <form class="form form-horizontal" action="{{ route('add_order') }}" method="post" id="make_order" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="panel">
                            <div class="chk-heading">
                                <a class="fsz-30" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    <span class="light-font">billing </span> <strong>information </strong>
                                </a>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse{{ (Auth::check())?' in':'' }}">
                                <div class="chk-body pt-15 block-inline">
                                    <div>
                                        <?php $sn=1; ?>
                                        @foreach($addresses as $address)
                                            <div class="col-md-3">
                                                <div class="panel-body" style="border-bottom: 0 !important; background: #eeeeee !important;">
                                                    <h5>Street Address: {{ $address->street_address }}</h5>
                                                    <h5>State: {{ $address->state }}</h5>
                                                    <h5>LGA: {{ $address->lga }}</h5>
                                                    <h5>Tel: {{ $address->tel }}</h5>
                                                    <br>
                                                    <input type="radio" value="{{ $address->id }}" id="billing_info" name="billing_info"{{ ($sn==1)?' checked':'' }}>
                                                </div>
                                            </div>
                                            <?php $sn++; ?>
                                        @endforeach

                                        <div class="col-md-3 panel">
                                            <div class="panel-body text-center"  style="background: #eeeeee !important;">
                                                <a href="#address-form" data-toggle="modal" ><i class="fa fa-plus fa-5x"></i></a>
                                                <br />
                                                <h5>Add New</h5>
                                            </div>
                                        </div>
                                    </div>

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
                                    <div>
										<?php $sn=1; ?>
                                        @foreach($addresses as $address)
                                            <div class="col-md-3">
                                                <div class="panel-body"  style="border-bottom: 0 !important; background: #eeeeee !important;">
                                                    <h5>Street Address: {{ $address->street_address }}</h5>
                                                    <h5>State: {{ $address->state }}</h5>
                                                    <h5>LGA: {{ $address->lga }}</h5>
                                                    <h5>Tel: {{ $address->tel }}</h5>
                                                    <br>
                                                    <input type="radio" value="{{ $address->id }}" id="shipping_info" name="shipping_info"{{ ($sn==1)?' checked':'' }}>
                                                </div>
                                            </div>
                                            <?php $sn++; ?>
                                        @endforeach

                                            <div class="col-md-3 panel">
                                                <div class="panel-body text-center"  style="background: #eeeeee !important;">
                                                    <a href="#address-form" data-toggle="modal" ><i class="fa fa-plus fa-5x"></i></a>
                                                    <br />
                                                    <h5>Add New</h5>
                                                </div>
                                            </div>
                                    </div>

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
                                    <input type="radio" value="paystack" name="payment_method" checked> Flat Rate (N1,000)
                                    <input type="hidden" name="shipping_amount" value="1000">
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
                                    <input type="radio" value="paystack" name="payment_method" checked> Online Payment <br />
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
                                    <table class="product-table">
                                        <thead>
                                        <th>product Image</th>
                                        <th>Name</th>
                                        <th>Unit price</th>
                                        <th>Quantity</th>
                                        <th>Total price</th>
                                        </thead>
                                        <tbody>
                                            @foreach($cart_items as $item)
                                                <tr>

                                                    <td class="" style="height: 60px !important;">
                                                        <div class="white-bg"> <a class="media-link"><img src="{{\App\ProductImage::getSingleProductImage($item->id)}}" alt="" style="height: 100px !important;"></a> </div>
                                                    </td>

                                                    <td>
                                                        {{ $item->name }}
                                                    </td>
                                                    <td>
                                                        N{{ number_format($item->price) }}
                                                    </td>
                                                    <td>
                                                        {{ $item->qty }}
                                                    </td>
                                                    <td>
                                                        N{{ number_format((int) $item->qty* (int) $item->price) }}
                                                    </td>
                                                </tr>

                                            @endforeach
                                            <tr>

                                                <td>

                                                </td>

                                                <td>

                                                </td>
                                                <td>

                                                </td>
                                                <td>
                                                    <strong>Shipping:</strong>
                                                </td>
                                                <td>
                                                    N{{ number_format(1000) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Total</th>
                                        <th>N{{ number_format(1000+ (int) str_replace(',','',$cart_total)) }}</th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </form>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-lg pull-right" form="make_order" style="color: #ffffff;" type="submit"> Proceed <i class="fa fa-angle-right"></i></button>
            </div>
        </div>
    </section>
    <!-- / Checkout Ends -->

    @if(Auth::check())
    <section class="modal fade" id="address-form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg product-modal">
            <div class="modal-content">
                <a aria-hidden="true" data-dismiss="modal" class="sb-close-btn close" href="#"> <i class=" fa fa-close"></i> </a>

                <div class="form-single ptb-50 clearfix" style="padding: 50px !important;">
                    <form action="{{ route('add_address') }}" method="post" class="address-form">
                        <h2 class="title-1"> New Address</h2>
                        <p class=""> Please fill the form below : </p>
                        @if(count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <p class="text-danger" style="color: red !important;" >{{ $error }}</p>
                            @endforeach
                        @endif
                        <div class="form-group block-inline">
                            <label> Street Address <span class="red-clr"> * </span> </label>
                            <input type="text" value="{{ old('street') }}" data-placement="bottom" data-toggle="tooltip" name="street" class="form-control name input-your-name" required>
                        </div>
                        <div class="form-group block-inline">
                            <label> State <span class="red-clr"> * </span> </label>
                            <input required="" type="text" value="{{ old('state') }}" data-placement="bottom" data-toggle="tooltip" name="state" class="form-control name input-your-name" required>
                        </div>
                        <div class="form-group block-inline">
                            <label> L.G.A. <span class="red-clr"> * </span> </label>
                            <input required="" type="text" value="{{ old('lga') }}" data-placement="bottom" data-toggle="tooltip" name="lga" class="form-control name input-your-name" required>
                        </div>
                        <div class="form-group block-inline">
                            <label> Area <span class="red-clr"> * </span> </label>
                            <input type="text" value="{{ old('area') }}" data-placement="bottom" data-toggle="tooltip" name="area" class="form-control name input-your-name" required>
                        </div>
                        <div class="form-group block-inline">
                            <label> Nearest Landmark</label>
                            <input type="text" value="{{ old('landmark') }}" data-placement="bottom" data-toggle="tooltip" name="landmark" class="form-control name input-your-name">
                        </div>
                        <div class="form-group block-inline">
                            <label> Tel <span class="red-clr"> * </span> </label>
                            <input type="text" value="{{ old('tel') }}" data-placement="bottom" data-toggle="tooltip" name="tel" class="form-control name input-your-name" required>
                        </div>
                        <label class="red-clr">* Required Filelds</label>
                        <div class="form-group block-inline text-right">
                            <button class="theme-btn-sm-3 btn submit-btn" type="submit"> <b> Add Address </b> </button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>

            </div>
        </div>
    </section>
    @endif
@endsection