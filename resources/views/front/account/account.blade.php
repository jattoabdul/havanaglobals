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
                <div class="panel-group chk-panel" id="accordion">
                    <div class="panel">
                        <div class="accordion-heading">
                            <a class="title-2" data-toggle="collapse" data-parent="#accordion" href="#accordion-1" aria-expanded="true"> <span class="light-font">01. My </span> <strong> Account </strong> </a>
                        </div>
                        <div id="accordion-1" class="panel-collapse collapse in">
                            <div class="account-body">
                                <ul class="acnt-list">
                                    <li>
                                        <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                        <a href="{{ route('edit_account') }}"> Edit your account information</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                        <a href="{{ route('edit_password') }}"> Change your password</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                        <a href="{{ route('show_address') }}"> Modify your address book entries</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="accordion-heading">
                            <a class="title-2" data-toggle="collapse" data-parent="#accordion" href="#accordion-2"> <span class="light-font">02. Order and </span> <strong>  Review </strong>  </a>
                        </div>
                        <div id="accordion-2" class="panel-collapse collapse">
                            <div class="account-body">
                                <ul class="acnt-list">
                                    <li>
                                        <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                        <a href="{{ route('show_orders') }}"> View your order history</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                        <a href="#"> Your reviews and ratings</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                        <a href="{{ route('show_wishlist') }}"> View your wishlist</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="accordion-heading">
                            <a class="title-2" data-toggle="collapse" data-parent="#accordion" href="#accordion-3">  <span class="light-font">02. </span> <strong> Newsletter </strong> </a>
                        </div>
                        <div id="accordion-3" class="panel-collapse collapse">
                            <div class="account-body">
                                <ul class="acnt-list">
                                    <li>
                                        <a href="#"> Subscribe / unsubscribe to newsletter</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            @include('front.fragments.account-sidebar')
        </div>
    </div>
</section>
<!-- / My Account Ends -->
@endsection