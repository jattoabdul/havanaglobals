@extends('front.base')

@section('home-active', 'active')
@section('content')

            <!-- Main Slider Start -->
            <section class="main-slide">
                <img alt=".." src="{{ asset('front/img/slider/slide-6.jpg') }}" />
                <div class="tbl-wrp slide-1">
                    <div class="text-middle">
                        <div class="tbl-cell">
                            <div class="slide-caption container text-center">
                                <div class="slide-title2 pb-10">
                                    <h2 class="section-title" style="color:#FFF;">  <strong>Healthy and Locally Grown Organic Farm Products</strong></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- / Main Slider Ends -->

            <!-- Naturix Goods Starts-->
            <section class="naturix-goods sec-space-bottom">
                <div class="container">
                    <div class="title-wrap">
                        <h4 class="sub-title"> FRESH FROM OUR FARM </h4>
                        <h2 class="section-title"> <span class="round-shape">  <strong> {{env('APP_NAME')}} <img src="{{ asset('front/img/icons/logo-icon.png') }}" alt="" /></strong> </span> </h2>
                    </div>

                    <div class="tabs-box text-center">
                        <ul class="theme-tabs small">
                            <li class="active"><a href="#naturix-tab-0" data-toggle="tab"> <span class="light-font">All</span> </a></li>
                            @foreach($categories as $category)
                            <li class=""><a href="#naturix-tab-{{ $category->id }}" data-toggle="tab"> <span class="light-font">{{ $category->name }} </span> </a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="tab-content organic-content row">
                        <div id="naturix-tab-0" class="tab-pane fade active in">
                            <div class="naturix-slider-1 dots-1">
                                @foreach($products as $product)
                                    {{ dd($product->images[0]->url) }}
                                    <div class="item">
                                        <div class="product-box">
                                            <div class="product-media">
                                                <img class="prod-img" style="cursor: pointer;" data-url="{{ route('product_detail', ['id'=>$product->id, 'slug'=>\App\Core::slugger($product->name)]) }}" alt="" src="{{ ($product->images->isNotEmpty())?$product->images[0]->url:'' }}" />
                                                <img class="shape" alt="" src="{{ asset('front/img/icons/shap-small.png') }}" />
                                                <div class="prod-icons">
                                                    <a href="javascript:;" class="fa fa-heart add-to-wishlist" @if(Auth::check()) data-id="{{ $product->id }}" @endif></a>
                                                    <a href="javascript:;" @if($product->qty>0) data-id="{{ $product->id }}" @endif data-title="" class="fa fa-shopping-basket{{ ($product->qty>0)?' add-to-cart':'' }}"></a>
                                                    <a href="#product-preview" data-id="{{ $product->id }}" data-toggle="modal" class="fa fa-expand"></a>
                                                </div>
                                            </div>
                                            <div class="product-caption">
                                                <h3 class="product-title">
                                                    <a href="{{ route('product_detail', ['id'=>$product->id, 'slug'=>\App\Core::slugger($product->name)]) }}"> <span class="light-font"> {{$product->name}} </span></a>
                                                </h3>
                                                <div class="price">
                                                    <strong class="clr-txt"> N{{number_format($product->price)}} </strong>
                                                    {{--  @if( $product->old_price ) <del class="light-font">{{ $product->old_price }} </del> @ednif  --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        @foreach($categories as $category)
                        <div id="naturix-tab-{{ $category->id }}" class="tab-pane fade">
                            <div class="naturix-slider-1 dots-1">
                                @foreach($category->products()->with('images')->orderBy('id', 'desc')->limit(12)->get() as $product)
                                <div class="item">
                                    <div class="product-box">
                                        <div class="product-media">
                                            <img class="prod-img" style="cursor: pointer;" data-url="{{ route('product_detail', ['id'=>$product->id, 'slug'=>\App\Core::slugger($product->name)]) }}" alt="" src="{{ ($product->images->isNotEmpty())?$product->images[0]->url:'' }}" />
                                            <img class="shape" alt="" src="{{ asset('front/img/icons/shap-small.png') }}" />
                                            <div class="prod-icons">
                                                <a href="javascript:;" class="fa fa-heart add-to-wishlist" @if(Auth::check()) data-id="{{ $product->id }}" @endif></a>
                                                <a href="javascript:;" @if($product->qty>0) data-id="{{ $product->id }}" @endif data-title="" class="fa fa-shopping-basket{{ ($product->qty>0)?' add-to-cart':'' }}"></a>
                                                <a href="#product-preview" data-id="{{ $product->id }}" data-toggle="modal" class="fa fa-expand"></a>
                                            </div>
                                        </div>
                                        <div class="product-caption">
                                            <h3 class="product-title">
                                                <a href="{{ route('product_detail', ['id'=>$product->id, 'slug'=>\App\Core::slugger($product->name)]) }}"> <span class="light-font"> {{$product->name}} </span></a>
                                            </h3>
                                            <div class="price">
                                                <strong class="clr-txt"> N{{number_format($product->price)}} </strong>
                                                {{--  @if( $product->old_price ) <del class="light-font">{{ $product->old_price }} </del> @ednif  --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </section>
            <!-- / Naturix Goods Ends -->

            <!-- Deals Starts-->
            <section class="deals sec-space light-bg">
                <img alt="" src="{{ asset('front/img/extra/sec-img-3.png') }}" class="right-bg-img" />
                <img alt="" src="{{ asset('front/img/extra/sec-img-4.png') }}" class="left-bg-img" />

                <div class="container">
                    <div class="row">

                        <div class="col-sm-2 text-center no-padding">
                            <img alt="" src="{{ asset('front/img/extra/deal.png') }}" />
                        </div>
                        <div class="col-sm-8 text-right">
                            <h4 class="sub-title"> The Best Deals</h4>
                            <h2 class="section-title"> <span class="light-font">Healthy and Organic Fresh Farm Produce </span> </h2>
                        </div>

                    </div>
                    <div class="deal-count">
                        <div class="countdown-wrapper">
                            <div id="defaultCountdown" class="countdown"></div>
                        </div>
                    </div>
                    <div class="deal-slider dots-2">

                        @foreach($deals as $product)
                        <div class="item">
                            <div class="deal-item">
                                <div class="deal-icons">
                                    <a href="javascript:;" class="fa fa-heart add-to-wishlist" @if(Auth::check()) data-id="{{ $product->id }}" @endif></a>
                                    <a href="javascript:;" @if($product->qty>0) data-id="{{ $product->id }}" @endif data-title="" class="fa fa-shopping-basket{{ ($product->qty>0)?' add-to-cart':'' }}"></a>
                                    <a href="#product-preview" data-id="{{ $product->id }}" data-toggle="modal" class="fa fa-expand"></a>
                                </div>
                                <div class="deal-content">
                                    <div class="deal-text">
                                        <h4 class="sub-title"> {{ $product->category[0]->name }} </h4>
                                        <h2 class="fsz-30 pb-15"> <a href="{{ route('product_detail', ['id'=>$product->id, 'slug'=>\App\Core::slugger($product->name)]) }}"> <span class="light-font">{{ $product->name }} </span> </a> </h2>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy...</p>
                                        <div class="price pt-15">
                                            <strong class="clr-txt">N{{ number_format($product->price) }} </strong>
                                        </div>
                                    </div>
                                    <div class="deal-img"> <img alt="" src="{{ asset('front/img/extra/deal-1.png') }}" /> </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </section>
            <!-- / Deals Ends -->

            <!-- Subscribe Newsletter Starts-->
            <section class="subscribe-wrap sec-space">
                <img alt="" src="{{ asset('front/img/extra/sec-img-5.png') }}" class="right-bg-img" />
                <img alt="" src="{{ asset('front/img/extra/sec-img-6.png') }}" class="left-bg-img" />

                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="sub-title"> JOIN OUR NEWSLETTER </h4>
                            <h2 class="fsz-35"> <span class="light-font">subscribe </span> <strong> newsletter</strong> </h2>
                        </div>
                        <div class="col-md-8">
                            <form class="newsletter-form row">
                                <div class="form-group col-sm-8">
                                    <input class="form-control" placeholder="enter your email address" required=""  type="text">
                                </div>
                                <div class="form-group col-sm-4">
                                    <button class="theme-btn btn-block" type="submit"> subscribe <i class="fa fa-long-arrow-right"></i> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Subscribe Newsletter Ends -->

            <!-- / CONTENT AREA -->
    @endsection