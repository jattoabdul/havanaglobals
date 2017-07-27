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
                                <a class="fsz-30" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    <span class="light-font">Account </span> <strong> Information </strong>
                                </a>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="chk-body pt-15 block-inline">

                                    <div class="col-md-12">
                                        <form action="{{ route('save_account') }}" method="post">
                                            @if(count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <p class="text-danger" style="color: red !important;">{{ $error }}</p>
                                                @endforeach
                                            @endif
                                            <div class="form-group block-inline">
                                                <label> First Name <span class="red-clr"> * </span> </label>
                                                <input required="" type="text" title="First Name" value="{{ Auth::user()->first_name }}" data-placement="bottom" data-toggle="tooltip" name="first_name" class="form-control name input-your-name">
                                            </div>
                                            <div class="form-group block-inline">
                                                <label> Last Name <span class="red-clr"> * </span> </label>
                                                <input required="" type="text" title="" value="{{ Auth::user()->last_name }}" data-placement="bottom" data-toggle="tooltip" name="last_name" class="form-control name input-your-name">
                                            </div>
                                            <div class="form-group block-inline">
                                                <label> Email Address <span class="red-clr"> * </span> </label>
                                                <input required="" type="email" title="" value="{{ Auth::user()->email }}" data-placement="bottom" data-toggle="tooltip" name="email" class="form-control name input-your-name">
                                            </div>
                                            <div class="form-group block-inline">
                                                <label> Tel <span class="red-clr"> * </span> </label>
                                                <input required="" type="text" title="" value="{{ Auth::user()->tel }}" data-placement="bottom" data-toggle="tooltip" name="tel" class="form-control name input-your-name">
                                            </div>
                                            <label class="red-clr">* Required Filelds</label>
                                            <div class="form-group block-inline text-right">
                                                <button class="theme-btn-sm-3 btn submit-btn" type="submit"> <b> Save Changes </b> </button>
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
    <!-- / My Account Ends -->
@endsection