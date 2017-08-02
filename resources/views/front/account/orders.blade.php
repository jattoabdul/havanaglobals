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
                    <h2 class="section-title"> <span class="light-font">Order </span> <strong class="clr-txt">History </strong> </h2>

                    <div class="panel-group chk-panel" id="accordion">
                        @foreach($orders as $order)
                            <div class="panel">
                            <div>
                                <table class="" style="width: 100%; max-width: 100%;">
                                    <tr>
                                        <td><strong>Order ID: </strong> #{{ $order->order_id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }}</td>
                                        <td><strong>Total: </strong> N{{ number_format($order->total) }}</td>
                                        <td>
                                            @if($order->status == 0) <span class="text-warning">Pending <i class="fa fa-warning"></i></span> @endif
                                            @if($order->status == 1) <span class="text-success">Success <i class="fa fa-check-circle"></i></span> @endif
                                            @if($order->status == 2) <span class="text-danger">Failed <i class="fa fa-times-circle"></i></span>@endif
                                            @if($order->status == 3) <span class="text-info">Shipped <i class="fa fa-check-circle"></i> <i class="fa fa-bus"></i></span>@endif
                                            @if($order->status == 4) <span class="text-success">Completed <i class="fa fa-check-circle"></i> <i class="fa fa-check-circle"></i></span>@endif
                                        </td>

                                        <td>
                                            <a class="" data-toggle="collapse" data-parent="#accordion" href="#ord{{ $order->order_id }}">
                                                <span class="light-font">Show </span> <strong>details <i class="fa fa-arrow-circle-o-right clr-txt"></i></strong>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div id="ord{{ $order->order_id }}" class="panel-collapse collapse">
                                <div class="chk-body pt-15 block-inline">
                                    <div class="row">
                                        <div class="col-md-4" style="border-right: 1px solid">
                                            <div>
                                                <h5>Shipping Address</h5>
                                                {{ $order->shipping_info->street_address }}, <br />
                                                {{ $order->shipping_info->area }}, <br />
                                                {{ $order->shipping_info->lga }}, <br />
                                                {{ $order->shipping_info->state }}. <br />
                                                {{ $order->shipping_info->tel }}. <br />
                                            </div>

                                            <br />
                                            <div>
                                                <h5>Billing Address</h5>
                                                {{ $order->billing_info->street_address }}, <br />
                                                {{ $order->billing_info->area }}, <br />
                                                {{ $order->billing_info->lga }}, <br />
                                                {{ $order->billing_info->state }}. <br />
                                                {{ $order->billing_info->tel }}. <br />
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            @foreach(json_decode($order->products) as $item)
                                                <?php $product = \App\Product::find($item->id); ?>
                                                <div class="col-sm-6 col-md-4 text-center">
                                                    <a href="{{ route('product_detail', ['id'=>$product->id, 'slug'=>\App\Core::slugger($product->name)]) }}" target="_blank">
                                                        <img src="{{ $product->images[0]->url }}" height="100px">
                                                    </a>

                                                    <br />
                                                    <span class="clr-txt">{{ $product->name }}</span> x {{ $item->qty }} <br />
                                                    <span class=" light-font">N{{ $item->price }}</span>
                                                    <br />
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </aside>

                @include('front.fragments.account-sidebar')
            </div>
        </div>
    </section>
@endsection