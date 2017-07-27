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
                                    <span class="light-font"> Edit  </span> <strong> Address </strong>
                                </a>
                            </div>
                            <div id="" class="panel">
                                <div class="chk-body pt-15 block-inline">
                                    <div class="form-single clearfix" style="padding: 20px !important;">
                                        <form action="{{ route('update_address', $add->id) }}" method="post" class="address-form">
                                            @if(count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <p class="text-danger" style="color: red !important;" >{{ $error }}</p>
                                                @endforeach
                                            @endif
                                            <div class="form-group block-inline">
                                                <label> Street Address <span class="red-clr"> * </span> </label>
                                                <input type="text" value="{{ $add->street_address }}" data-placement="bottom" data-toggle="tooltip" name="street" class="form-control name input-your-name" required>
                                            </div>
                                            <div class="form-group block-inline">
                                                <label> State <span class="red-clr"> * </span> </label>
                                                <input required="" type="text" value="{{ $add->state }}" data-placement="bottom" data-toggle="tooltip" name="state" class="form-control name input-your-name" required>
                                            </div>
                                            <div class="form-group block-inline">
                                                <label> L.G.A. <span class="red-clr"> * </span> </label>
                                                <input required="" type="text" value="{{ $add->lga }}" data-placement="bottom" data-toggle="tooltip" name="lga" class="form-control name input-your-name" required>
                                            </div>
                                            <div class="form-group block-inline">
                                                <label> Area <span class="red-clr"> * </span> </label>
                                                <input type="text" value="{{ $add->area }}" data-placement="bottom" data-toggle="tooltip" name="area" class="form-control name input-your-name" required>
                                            </div>
                                            <div class="form-group block-inline">
                                                <label> Nearest Landmark</label>
                                                <input type="text" value="{{ $add->landmark }}" data-placement="bottom" data-toggle="tooltip" name="landmark" class="form-control name input-your-name">
                                            </div>
                                            <div class="form-group block-inline">
                                                <label> Tel <span class="red-clr"> * </span> </label>
                                                <input type="text" value="{{ $add->tel }}" data-placement="bottom" data-toggle="tooltip" name="tel" class="form-control name input-your-name" required>
                                            </div>
                                            <label class="red-clr">* Required Filelds</label>
                                            <div class="form-group block-inline text-right">
                                                <button class="theme-btn-sm-3 btn submit-btn" type="submit"> <b> Update Address </b> </button>
                                            </div>
                                            {{ csrf_field() }}
                                        </form>
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
@endsection