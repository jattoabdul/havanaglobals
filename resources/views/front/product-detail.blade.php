@extends('front.base')
@section('content')
    <!--Breadcrumb Section Start-->
    <section class="breadcrumb-bg">
        <div class="theme-container container ">
            <div class="site-breadcumb white-clr">
                <h2 class="section-title"> <strong class="clr-txt">{{ $product->name }}</strong> </h2>
                <ol class="breadcrumb breadcrumb-menubar">
                    <li> <a href="#"> Home </a> {{$product->name}}  </li>
                </ol>
            </div>
        </div>
    </section>
    <!--Breadcrumb Section End-->

    <!-- Shop Starts-->
    <section class="shop-wrap sec-space-bottom">
                <div class="container rel-div pt-50">
                    <div class="row">
                        <div class="col-md-3 pt-15">
                            <div class="widget-wrap">
                                <h2 class="widget-title"> <span class="light-font">Product Category</span></h2>
                                <div class="divider-full-1"></div>
                                <ul class="cate-widget">
                                    @foreach($product->category as $product_category)
                                    <li> <i class="fa fa-arrow-circle-o-right clr-txt"></i> <a href="#">{{ $product_category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                        <div class="col-md-9 pt-15">
                            <div class="product-single sec-space-bottom  clearfix">
                                <!-- Single Products Slider Starts --> 
                                <div class="col-lg-6 pb-50 col-sm-8 col-sm-offset-2 col-lg-offset-0">
                                    <div class="prod-slider sync1">
                                        @foreach($product->images as $image)
                                        <div class="item">
                                            <img src="{{ $image->url }}" alt="">
                                        </div>
                                        @endforeach

                                    </div>

                                    <div  class="sync2">
                                        @foreach($product->images as $image)
                                        <div class="item"> <a href="#"> <img src="{{ $image->url }}" alt=""> </a> </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Single Products Slider Ends --> 

                                <div class="col-lg-6">
                                    <div class="product-content block-inline">

                                        @if($stock > 0)
                                            <form method="post" action="{{ route('cart_add') }}">
                                                {{csrf_field()}}
                                                <input type="hidden" name="pid" value="{{ $product->id }}">
                                        @endif

                                        <div class="single-caption"> 
                                            <h3 class="section-title light-font"> {{ $product->name }} </h3>
                                            <span class="divider-2"></span>
                                            <p class="price"> 
                                                <strong class="clr-txt fsz-20">N {{number_format($product->price)}} </strong>
                                            </p>

                                            <div class="fsz-16">
                                                <p></p>
                                            </div>

                                            <div class="prod-btns">
                                                <div class="quantity">
                                                    <input name="qty" placeholder="Quantity" class="form-control" type="text" id="single-product-qty" value="1" @if($stock <= 0) disabled @endif>
                                                </div>
                                                <div class="form-group"> Quantity Available: {{ $product->qty }} </div>
                                            </div>
                                            <ul class="meta">
                                                <li> <strong> SKU </strong> <span>: &nbsp;  HAV-{{$product->id}}</span> </li>
                                                <li class="tags-widget"> <strong> CATEGORY </strong> <span>: @foreach($product->category as $product_category) <a href="#">{{ $product_category->name }}</a> @endforeach </li>
                                            </ul>
                                            <div class="divider-full-1"></div>
                                            <div class="add-cart pt-15">
                                                @if($stock <= 0)
                                                    <div class="alert alert-info text-center"><b>Out Of Stock</b></div>
                                                @else
                                                <button type="submit" class="theme-btn btn"> <strong> ADD TO CART </strong> </button>
                                                @endif
                                            </div>
                                        </div>
                                        @if($stock>0) </form> @endif
                                    </div>
                                </div> 
                            </div>  

                            <div class="prod-tabs pb-50">
                                <ul class="tabs fsz-20">
                                    <li class="active"><a href="#prod-tab-1" data-toggle="tab"> <strong>Product Description </strong> </a></li>
                                    <li class=""><a href="#prod-tab-3" data-toggle="tab"> <strong>Reviews (3)</strong> </a></li>
                                </ul>
                                <div class="divider-full-1"></div>

                                <div class="tab-content prod-tab-content">
                                    <div id="prod-tab-1" class="tab-pane fade in active">
                                        <div class="block-inline pera">
                                            <p>{{ $product->description }}</p>
                                        </div>
                                    </div>
                                    <div id="prod-tab-3" class="tab-pane fade">

                                        <div class="review-wrap">
                                            <div class="review-img">
                                                <a href="#"> <img alt="" src="assets/img/extra/review-1.png" /> </a>
                                            </div>
                                            <div class="review-caption">
                                                <h4 class="title fsz-16">
                                                    <a href="#">Luis Nazario Garcia</a>
                                                    <span class="fsz-10 gray-color">26 JUNE 2016</span>
                                                </h4>
                                                <div class="rating">
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="fsz-12 gray-color"> Rating : 5/5 </span>
                                                </div>

                                                <div class="block-inline pera">
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adiping elit food sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat adiping elit food sed diam nonummy nibh euismod tincidunt ut laoreet dolore. </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="review-wrap">
                                            <div class="review-img">
                                                <a href="#"> <img alt="" src="assets/img/extra/review-1.png" /> </a>
                                            </div>
                                            <div class="review-caption">
                                                <h4 class="title fsz-16">
                                                    <a href="#">Luis Nazario Garcia</a>
                                                    <span class="fsz-10 gray-color">26 JUNE 2016</span>
                                                </h4>
                                                <div class="rating">
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="fsz-12 gray-color"> Rating : 5/5 </span>
                                                </div>

                                                <div class="block-inline pera">
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adiping elit food sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat adiping elit food sed diam nonummy nibh euismod tincidunt ut laoreet dolore. </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="review-wrap">
                                            <div class="review-img">
                                                <a href="#"> <img alt="" src="assets/img/extra/review-1.png" /> </a>
                                            </div>
                                            <div class="review-caption">
                                                <h4 class="title fsz-16">
                                                    <a href="#">Luis Nazario Garcia</a>
                                                    <span class="fsz-10 gray-color">26 JUNE 2016</span>
                                                </h4>
                                                <div class="rating">
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="star active"></span>
                                                    <span class="fsz-12 gray-color"> Rating : 5/5 </span>
                                                </div>

                                                <div class="block-inline pera">
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adiping elit food sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat adiping elit food sed diam nonummy nibh euismod tincidunt ut laoreet dolore. </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="you-like organic-content pb-50">
                                <h3 class="fsz-20 pb-15 text-center"><span class="light-font">Related  </span> <strong>Products </strong>  </h3>
                                <div class="divider-full-1"></div>
                                <div id="rel-prod-slider" class="rel-prod-slider nav-1">                                        
                                    <div class="item"> 
                                        <div class="product-box"> 
                                            <div class="product-media"> 
                                                <img class="prod-img" alt="" src="assets/img/products/1.png" />     
                                                <img class="shape" alt="" src="assets/img/icons/shap-small.png" />  
                                                <div class="prod-icons"> 
                                                    <a href="#" class="fa fa-heart"></a>
                                                    <a href="#" class="fa fa-shopping-basket"></a>
                                                    <a  href="#product-preview" data-toggle="modal" class="fa fa-expand"></a>
                                                </div>
                                            </div>                                           
                                            <div class="product-caption"> 
                                                <h3 class="product-title">
                                                    <a href="#"> <span class="light-font"> organic </span>  <strong>tomato</strong></a>
                                                </h3>
                                                <div class="price"> 
                                                    <strong class="clr-txt">$50.00 </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item"> 
                                        <div class="product-box"> 
                                            <div class="product-media"> 
                                                <img class="prod-img" alt="" src="assets/img/products/2.png" />     
                                                <img class="shape" alt="" src="assets/img/icons/shap-small.png" />
                                                <div class="prod-icons"> 
                                                    <a href="#" class="fa fa-heart"></a>
                                                    <a href="#" class="fa fa-shopping-basket"></a>
                                                    <a  href="#product-preview" data-toggle="modal" class="fa fa-expand"></a>
                                                </div>
                                            </div>

                                            <div class="product-caption"> 
                                                <h3 class="product-title">
                                                    <a href="#"> <span class="light-font"> organic </span>  <strong>cabbege</strong></a>
                                                </h3>
                                                <div class="price"> 
                                                    <strong class="clr-txt">$50.00 </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item"> 
                                        <div class="product-box active"> 
                                            <div class="product-media"> 
                                                <img class="prod-img" alt="" src="assets/img/products/3.png" />     
                                                <img class="shape" alt="" src="assets/img/icons/shap-small.png" />
                                                <div class="prod-icons"> 
                                                    <a href="#" class="fa fa-heart"></a>
                                                    <a href="#" class="fa fa-shopping-basket"></a>
                                                    <a  href="#product-preview" data-toggle="modal" class="fa fa-expand"></a>
                                                </div>
                                            </div>

                                            <div class="product-caption"> 
                                                <h3 class="product-title">
                                                    <a href="#"> <span class="light-font"> organic </span>  <strong>cherry</strong></a>
                                                </h3>
                                                <div class="price"> 
                                                    <strong class="clr-txt">$50.00 </strong> <del class="light-font">$65.00 </del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item"> 
                                        <div class="product-box"> 
                                            <div class="product-media"> 
                                                <img class="prod-img" alt="" src="assets/img/products/4.png" />     
                                                <img class="shape" alt="" src="assets/img/icons/shap-small.png" />
                                                <span class="prod-tag tag-1">new</span> <span class="prod-tag tag-2">sale</span>
                                                <div class="prod-icons"> 
                                                    <a href="#" class="fa fa-heart"></a>
                                                    <a href="#" class="fa fa-shopping-basket"></a>
                                                    <a  href="#product-preview" data-toggle="modal" class="fa fa-expand"></a>
                                                </div>
                                            </div>

                                            <div class="product-caption"> 
                                                <h3 class="product-title">
                                                    <a href="#"> <span class="light-font"> organic </span>  <strong>salad</strong></a>
                                                </h3>
                                                <div class="price"> 
                                                    <strong class="clr-txt">$50.00 </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item"> 
                                        <div class="product-box"> 
                                            <div class="product-media"> 
                                                <img class="prod-img" alt="" src="assets/img/products/5.png" />     
                                                <img class="shape" alt="" src="assets/img/icons/shap-small.png" />
                                                <div class="prod-icons"> 
                                                    <a href="#" class="fa fa-heart"></a>
                                                    <a href="#" class="fa fa-shopping-basket"></a>
                                                    <a  href="#product-preview" data-toggle="modal" class="fa fa-expand"></a>
                                                </div>
                                            </div>

                                            <div class="product-caption"> 
                                                <h3 class="product-title">
                                                    <a href="#"> <span class="light-font"> organic </span>  <strong>pineapple</strong></a>
                                                </h3>
                                                <div class="price"> 
                                                    <strong class="clr-txt">$50.00 </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="your-review">
                                <h3 class="fsz-20 pb-15 text-center"><span class="light-font">Your item </span> <strong>review </strong>  </h3>
                                <div class="divider-full-1"></div>
                                <div class="your-review">
                                    <div class="block-inline your-rating">
                                        <div class="left">
                                            <div class="rating">
                                                <span class="fsz-12 gray-color"> Your Rating :  </span>
                                                <span class="star"></span>
                                                <span class="star"></span>
                                                <span class="star"></span>
                                                <span class="star"></span>
                                                <span class="star"></span>
                                            </div>
                                        </div>
                                        <div class="right">
                                            <div class="rating">
                                                <span class="star active"></span>
                                                <span class="star active"></span>
                                                <span class="star active"></span>
                                                <span class="star active"></span>
                                                <span class="star active"></span>
                                                <span class="fsz-12 gray-color"> Overall Rating : 5/5  </span>
                                            </div>
                                        </div>
                                    </div>

                                    <form class="review-form row">
                                        <div class="form-group col-sm-4">
                                            <input class="form-control" placeholder="Name" required="" type="text">                                                                                     
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input class="form-control" placeholder="Email" required="" type="email">                                                                                     
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input class="form-control" placeholder="Website" type="text">                                                                                     
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <textarea class="form-control"  placeholder="Message" cols="12" rows="4"></textarea>                                                                                     
                                        </div>
                                        <div class="form-group col-sm-12 text-center ptb-15">                                               
                                            <button class="theme-btn" type="submit"> <strong> SUBMIT REVIEW </strong> </button>                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <!-- / Shop Ends -->

@endsection