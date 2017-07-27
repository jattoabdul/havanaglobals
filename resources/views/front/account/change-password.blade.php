@extends('front.base')
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
                                    <span class="light-font">Change </span> <strong> Password </strong>
                                </a>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="chk-body pt-15 block-inline">

                                    <div class="col-md-12">
                                        <form action="{{ route('update_password') }}" method="post">
                                            @if(count($errors) > 0)
                                                @foreach($errors->all() as $error)
                                                    <p class="text-danger" style="color: red !important;">{{ $error }}</p>
                                                @endforeach
                                            @endif
                                            <div class="form-group block-inline">
                                                <label> Current Password <span class="red-clr"> * </span> </label>
                                                <input required="" type="password" value="" data-placement="bottom" data-toggle="tooltip" name="current" class="form-control name input-your-name">
                                            </div>
                                            <div class="form-group block-inline">
                                                <label> New Password<span class="red-clr"> * </span> </label>
                                                <input required="" type="password" data-placement="bottom" data-toggle="tooltip" name="password" class="form-control name input-your-name">
                                            </div>
                                            <div class="form-group block-inline">
                                                <label> Confirm New Password<span class="red-clr"> * </span> </label>
                                                <input required="" type="password" data-placement="bottom" data-toggle="tooltip" name="password_confirmation" class="form-control name input-your-name">
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