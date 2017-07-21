@extends('front.base')
@section('content')
            <!--Breadcrumb Section Start-->
            <section class="breadcrumb-bg">                
                <div class="theme-container container ">                       
                    <div class="site-breadcumb white-clr">
                        <ol class="breadcrumb breadcrumb-menubar">
                            <li> <a href="{{ route('home') }} "> Home </a> Shopping Cart  </li>
                        </ol>
                    </div>  
                </div>
            </section>
            <!--Breadcrumb Section End-->

            <!-- Cart Starts-->
            <section class="shop-wrap sec-space">
                <div class="container"> 
                    <!-- Shopping Cart Starts -->
                    <div class="cart-table">
                        <table class="product-table">
                            <thead class="">
                            <tr>
                                <th>product detail</th>
                                <th></th>
                                <th>Unit price</th>
                                <th>quantity</th>
                                <th>total price</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach(Cart::content() as $item)
                                <form action="{{ route('cart_update') }}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="row_id" value="{{ $item->rowId }}">
                                    <tr>
                                        <td class="image"><div class="white-bg"> <a class="media-link" href="#"><img src="{{\App\ProductImage::getSingleProductImage($item->id)}}" alt=""></a> </div> </td>
                                        <td class="description">
                                            <div class="divider-2"></div>
                                            <h3 class="product-title no-margin"> <a href="#"> <span class="light-font">{{ $item->name }} </span>  </a> </h3>
                                        </td>    
                                        <td> <div class="price fontbold-2"> <strong class="fsz-20">N{{$item->price}} </strong> </div> </td>
                                        <td>
                                            <div class="prod-btns fontbold-2">
                                                <div class="quantity">
                                                    <input title="Qty" placeholder="" class="form-control qty" type="text" name="qty" value="{{ $item->qty }}">
                                                </div>
                                                <div class="sort-dropdown">
                                                    <div class="search-selectpicker selectpicker-wrapper">
                                                        <button type="submit" class="btn bnt-xs btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td> 
                                            <strong class="clr-txt fsz-20 fontbold-2">N{{$item->price * $item->qty}}</strong> <a href="{{ route('cart_remove',['row_id'=>$item->rowId]) }}" class="remove fa fa-close clr-txt"></a>
                                        </td>                                       
                                    </tr>

                                </form>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="continue-shopping">
                               {{-- <div class="left">
                                    <h6>ENTER VOUCHER CODE IF YOU HAVE ONE. <span class="clr-txt-2"> APPLY HERE </span> </h6>
                                    <div class="coupan-form"> 
                                        <input class="form-control" >
                                        <button class="btn" type="submit"> APPLY CODE </button>
                                    </div>
                                </div>--}}
                                <div class="right"> <strong class="fsz-20 fontbold-2">Subtotal : <span class="clr-txt"> N{{Cart::total()}} </span> </strong> </div>
                            </div>

                            <div class="shp-btn col-sm-12 text-center">
                                <button class="theme-btn-2 btn"> <b> CONTINUE SHOPPING </b> </button>
                                <button class="theme-btn-3 btn"> <b> CHECKOUT NOW </b> </button>
                            </div>                                   

                    </div>                    
                    <!-- / Shopping Cart Ends -->
                </div>
            </section>
            <!-- / Cart Ends -->      

            <!-- / CONTENT AREA -->
@endsection