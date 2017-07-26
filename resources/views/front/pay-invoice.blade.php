@extends('front.base')
@section('content')
    <!--Breadcrumb Section Start-->
    <section class="breadcrumb-bg">
        <div class="theme-container container ">
            <div class="site-breadcumb white-clr">
                <ol class="breadcrumb breadcrumb-menubar">
                    <li> <a href="{{ route('home') }} "> Home </a> Invoice  </li>
                </ol>
            </div>
        </div>
    </section>
    <!--Breadcrumb Section End-->

    <!-- Cart Starts-->
    <section class="shop-wrap sec-space">
        <div class="container">
            <!-- Shopping Cart Starts -->
            <div class="cart-table" id="shopping-cart-table">
                <div>
                    <h3 class="clr-txt text-center">Order Invoice</h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Shipping Address</h4>
                        {{ $order->shipping_info->street_address }}, <br />
                        {{ $order->shipping_info->area }}, <br />
                        {{ $order->shipping_info->lga }}, <br />
                        {{ $order->shipping_info->state }}. <br />
                        {{ $order->shipping_info->tel }}. <br />
                    </div>
                    <div class="col-md-6 text-right">
                        <h4 class="text-right">Billing Address</h4>
                        {{ $order->billing_info->street_address }}, <br />
                        {{ $order->billing_info->area }}, <br />
                        {{ $order->billing_info->lga }}, <br />
                        {{ $order->billing_info->state }}. <br />
                        {{ $order->billing_info->tel }}. <br />
                    </div>

                </div>
                <br />
                <br />
                <h3 class="clr-txt text-center">Order Products</h3>
                <table class="product-table">
                    <thead>
                    <th>product Image</th>
                    <th>product Name</th>
                    <th>Unit price</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                    </thead>
                    <tbody>
                    @foreach(json_decode($order->products) as $item)
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

                </table>

                <div class="continue-shopping">
                    <div class="right"> <strong class="fsz-20 fontbold-2">Total : <span class="clr-txt"> N{{number_format($order->total)}} </span> </strong> </div>
                </div>

                <div class="shp-btn col-sm-12 text-center">
                    <button id="pay-now" class="theme-btn-2 btn"> <b> Pay Now</b> </button>
                    <form action="/payment/callback?trxref={{ $order->ref }}&reference={{$order->ref}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="reference" value="{{ $order->ref }}">
                        <script
                                src="https://js.paystack.co/v1/inline.js"
                                data-key="{{ config('paystack.publicKey') }}"
                                data-email="{{ Auth::user()->email }}"
                                data-amount="{{ $order->total*100 }}"
                                data-ref="{{ $order->ref }}"
                                data-custom-button="pay-now"
                        >
                        </script>
                    </form>
                </div>

            </div>
            <!-- / Shopping Cart Ends -->
        </div>
    </section>
    <!-- / Cart Ends -->

    <!-- / CONTENT AREA -->
@endsection