@extends('front.base')
@section('account-active', 'active')
@section('content')
    <!--Breadcrumb Section Start-->
    <section class="breadcrumb-bg">
        <div class="theme-container container ">
            <div class="site-breadcumb">
                <h2 class="section-title"> <span class="light-font">my </span> <strong class="clr-txt">account </strong> </h2>
                <ol class="breadcrumb breadcrumb-menubar">
                    <li> <a href="#"> Home </a> my account  </li>
                </ol>
            </div>
        </div>
    </section>
    <!--Breadcrumb Section End-->

    <!-- My Account Starts-->
    <section class="account-page ptb-50">
        <div class="container">
            <div class="row">
                <aside class="col-md-9 col-sm-8 ptb-15">

                    <div class="panel-group chk-panel">
                        <div class="panel">
                            <div class="chk-heading">
                                <a class="fsz-30" data-toggle="" data-parent="" href="">
                                    <span class="light-font">Address </span> <strong> Book </strong>
                                </a>
                            </div>
                            <div id="" class="panel">
                                <div class="chk-body pt-15 block-inline">
                                    <div>
										<?php $sn=1; ?>
                                        @foreach($addresses as $address)
                                            <div class="col-md-4">
                                                <div class="panel-body"  style="border-bottom: 0 !important; background: #eeeeee !important;">
                                                    <h5>Street Address: {{ $address->street_address }}</h5>
                                                    <h5>State: {{ $address->state }}</h5>
                                                    <h5>LGA: {{ $address->lga }}</h5>
                                                    <h5>Tel: {{ $address->tel }}</h5>
                                                    <br>
                                                    <a href="{{ route('edit_address', $address->id) }}"><i class="fa fa-edit"></i> edit</a>
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
                    </div>

                </aside>

                @include('front.fragments.account-sidebar')
            </div>
        </div>
    </section>
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
    <!-- / My Account Ends -->
@endsection