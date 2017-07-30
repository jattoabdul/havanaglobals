@extends('front.base')

@section('shop-active', 'active')
@section('content')


    <!--Breadcrumb Section Start-->
    <section class="breadcrumb-bg">
        <div class="theme-container container ">
            <div class="site-breadcumb white-clr">
                <h2 class="section-title"> <strong class="clr-txt"> </strong> <span class="light-font">Shop </span> </h2>
                <ol class="breadcrumb breadcrumb-menubar">
                    <li> <a href="#"> Home </a> SHOP  </li>
                </ol>
            </div>
        </div>
    </section>
    <!--Breadcrumb Section End-->


    <!-- Shop Starts-->
    <section class="shop-wrap sec-space-bottom">
        <div class="pattern">
            <img alt="" src="front/img/icons/white-pattern.png">
        </div>

        <div class="container rel-div">
            <div class="row sort-bar">
                <div class="icon"> <img alt="" src="front/img/logo/logo-2.png" /> </div>
                <div class="col-lg-6">
                    <div class="sort-dropdown left">
                        <span>SEARCH</span>
                        <div class="search-wrap">
                            <form method="get" action="{{ app('request')->fullUrl() }}">
                                <input class="form-control" name="q" value="{{ (array_key_exists('q', $_GET))?$_GET['q']:'' }}" placeholder="">
                                @foreach($_GET as $key => $value)
                                    @if($key == 'q') @continue @endif
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <button class="btn" type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-5 right">

                </div>
            </div>

            <div class="divider-full-1"></div>

            <div class="row">
                <div class="col-md-3 pt-15">
                    <div class="widget-wrap">
                        <h2 class="widget-title"> <span class="light-font">Order by</span> <strong>price</strong> </h2>
                        <div class="divider-full-1"></div>
                        <ul class="cate-widget">

                            <li>
                                <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                @if(app('request')->input('sort') == 'low-high')
                                    <a class="clr-txt" href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'low-high'])) }}">Low to High</a>
                                    <a class=" ml-10" href="{{ route('shop', array_merge(app('request')->except('sort'))) }}"><i class="text-danger fa fa-times-circle"></i></a>
                                @else
                                    <a href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'low-high'])) }}">Low to High</a>
                                @endif
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                @if(app('request')->input('sort') == 'high-low')
                                    <a class="clr-txt" href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'high-low'])) }}">High to Low</a>
                                    <a class=" ml-10" href="{{ route('shop', array_merge(app('request')->except('sort'))) }}"><i class="text-danger fa fa-times-circle"></i></a>
                                @else
                                    <a href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'high-low'])) }}">High to Low</a>
                                @endif
                            </li>

                        </ul>
                    </div>

                    <div class="widget-wrap">
                        <h2 class="widget-title"> <span class="light-font">Sort</span> <strong>by</strong> </h2>
                        <div class="divider-full-1"></div>
                        <ul class="cate-widget">
                            <li>
                                <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                @if(app('request')->input('sort') == 'oldest')
                                    <a class="clr-txt" href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'oldest'])) }}">Oldest - Newest</a>
                                    <a class=" ml-10" href="{{ route('shop', array_merge(app('request')->except('sort'))) }}"><i class="text-danger fa fa-times-circle"></i></a>
                                @else
                                    <a href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'oldest'])) }}">Oldest - Newest</a>
                                @endif
                            </li>

                            <li>
                                <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                @if(app('request')->input('sort') == 'recent')
                                    <a class="clr-txt" href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'recent'])) }}">Newest - Oldest</a>
                                    <a class=" ml-10" href="{{ route('shop', array_merge(app('request')->except('sort'))) }}"><i class="text-danger fa fa-times-circle"></i></a>
                                @else
                                    <a href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'recent'])) }}">Newest - Oldest</a>
                                @endif
                            </li>

                            <li>
                                <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                @if(app('request')->input('sort') == 'a-z')
                                    <a class="clr-txt" href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'a-z'])) }}">A - Z</a>
                                    <a class=" ml-10" href="{{ route('shop', array_merge(app('request')->except('sort'))) }}"><i class="text-danger fa fa-times-circle"></i></a>
                                @else
                                    <a href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'a-z'])) }}">A - Z</a>
                                @endif
                            </li>
                            <li>
                                <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                @if(app('request')->input('sort') == 'z-a')
                                    <a class="clr-txt" href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'z-a'])) }}">Z - A</a>
                                    <a class=" ml-10" href="{{ route('shop', array_merge(app('request')->except('sort'))) }}"><i class="text-danger fa fa-times-circle"></i></a>
                                @else
                                    <a href="{{ route('shop', array_merge(app('request')->input(), ['sort'=>'z-a'])) }}">Z - A</a>
                                @endif
                            </li>

                        </ul>
                    </div>

                    <div class="widget-wrap">
                        <h2 class="widget-title"> <span class="light-font">Refine by</span> <strong>category</strong> </h2>
                        <div class="divider-full-1"></div>
                        <ul class="cate-widget">
                            @foreach(\App\Category::all() as $category)
                                <li>
                                    <i class="fa fa-arrow-circle-o-right clr-txt"></i>
                                    @if(app('request')->input('cat') == urlencode($category->name))
                                        <a class="clr-txt" href="{{ route('shop', array_merge(app('request')->input(), ['cat'=>urlencode($category->name)])) }}">{{ $category->name }}</a>
                                        <a class=" ml-10" href="{{ route('shop', array_merge(app('request')->except('cat'))) }}"><i class="text-danger fa fa-times-circle"></i></a>
                                    @else
                                        <a href="{{ route('shop', array_merge(app('request')->input(), ['cat'=>urlencode($category->name)])) }}">{{ $category->name }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{--
                    <div class="widget-wrap">
                        <h2 class="widget-title"> <span class="light-font">Sort by</span> <strong>Tags</strong> </h2>
                        <div class="divider-full-1"></div>
                        <ul class="tags-widget">
                            <li> <a href="#">fruits</a> </li>
                            <li> <a href="#">vegetables</a> </li>
                            <li> <a href="#">juices</a> </li>
                            <li> <a href="#">natural food</a> </li>
                            <li> <a href="#">food</a> </li>
                            <li> <a href="#">Breads</a> </li>
                            <li> <a href="#">natural</a> </li>
                            <li> <a href="#">healthy</a> </li>
                        </ul>
                    </div>
                    --}}
                </div>

                <div class="col-md-9">
                    <div class="result-bar block-inline">
                        <h4 class="result-txt"> result <b> {{ $results->total() }} </b> </h4>
                        <ul class="view-tabs">
                            <li class="active">
                                <a href="#grid-view" data-toggle="tab">
                                    <i class="fa fa-th"></i>
                                </a>
                            </li>
                            <li class="">
                                <a href="#list-view" data-toggle="tab">
                                    <i class="fa fa-th-list"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content shop-content">
                        <div id="grid-view" class="tab-pane fade active in" role="tabpanel">
                            <div class="row">
                                @foreach($results as $product)
                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-box">
                                        <div class="product-media">
                                            <img class="prod-img" style="cursor: pointer;" data-url="{{ route('product_detail', ['id'=>$product->id, 'slug'=>\App\Core::slugger($product->name)]) }}" alt="" src="{{ ($product->images->isNotEmpty())?$product->images[0]->url:'' }}" />
                                            <img class="shape" alt="" src="{{ asset('front/img/icons/shap-small.png') }}" />
                                            <div class="prod-icons">
                                                <a href="javascript:;" class="fa fa-heart add-to-wishlist" @if(Auth::check()) data-id="{{ $product->id }}" @endif></a>
                                                <a href="javascript:;" @if($product->qty>0) data-id="{{ $product->id }}" @endif data-title="" class="fa fa-shopping-basket{{ ($product->qty>0)?' add-to-cart':'' }}"></a>
                                                <a href="#product-preview" data-id="{{ $product->id }}" data-toggle="modal" class="product-quicklook fa fa-expand"></a>
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

                            <div class="rel-div pt-50">
                                <div class="divider-full-1"></div>
                            </div>

                            {{ $results->links() }}

                        </div>

                        <div id="list-view" class="tab-pane fade" role="tabpanel">
                            <div class="row">
                                @foreach($results as $product)
                                <div class="col-sm-12">
                                    <div class="deal-item list-view">
                                        <div class="deal-icons">
                                            <a href="javascript:;" class="fa fa-heart add-to-wishlist" @if(Auth::check()) data-id="{{ $product->id }}" @endif></a>
                                            <a href="javascript:;" @if($product->qty>0) data-id="{{ $product->id }}" @endif data-title="" class="fa fa-shopping-basket{{ ($product->qty>0)?' add-to-cart':'' }}"></a>
                                            <a href="#product-preview" data-id="{{ $product->id }}" data-toggle="modal" class="product-quicklook fa fa-expand"></a>
                                        </div>
                                        <div class="deal-content">
                                            <div class="deal-text">
                                                <h4 class="sub-title"> {{ ($product->category->isNotEmpty())?$product->category[0]->name:'' }} </h4>
                                                <h2 class="fsz-30 pb-15"> <a href="{{ route('product_detail', ['id'=>$product->id, 'slug'=>\App\Core::slugger($product->name)]) }}"> <span class="light-font">{{ $product->name }} </a> </h2>
                                                <p>{{ ($product->description)?substr($product->description, 0, 50).'...':'' }}</p>
                                                <div class="price pt-15">
                                                    <strong class="clr-txt">N{{ number_format($product->price) }} </strong> @if($product->old_price) <del class="light-font">N{{ number_format($product->old_price) }} </del> @endif
                                                </div>
                                            </div>
                                            <div class="img"> <img class="prod-img" style="cursor: pointer;" data-url="{{ route('product_detail', ['id'=>$product->id, 'slug'=>\App\Core::slugger($product->name)]) }}" alt="{{ $product->name }}" src="{{ ($product->images->isNotEmpty())?$product->images[0]->url:'' }}"></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>


                            <div class="rel-div pt-50">
                                <div class="divider-full-1"></div>
                            </div>

                            {{ $results->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Shop Ends -->

@endsection