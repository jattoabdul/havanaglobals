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
                    <div class="panel">
                        <div class="chk-heading">
                            <a class="fsz-30" href="#collapseSix">
                                <span class="light-font">Wish</span><strong>list </strong>
                            </a>
                        </div>
                        <div class="">
                            <div class="chk-body pt-15 block-inline">
                                <table class="product-table">
                                    <thead>
                                    <th>product Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Availability</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <?php $item = 'item_'.$product->id; ?>
                                        <tr id="wish-item-{{$product->id}}">

                                            <td class="" style="height: 60px !important;">
                                                <div class="white-bg"> <a class="media-link" href="{{ route('product_detail', ['id'=>$product->id, 'slug'=>\App\Core::slugger($product->name)]) }}"><img src="{{$product->images[0]->url}}" alt="" style="height: 80px !important;"></a> </div>
                                            </td>

                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                N{{ number_format($product->price) }}
                                            </td>
                                            <td>
                                                {{ $list->$item->created_at }}
                                            </td>
                                            <td>
                                                {{($product->qty>0)?'In stock':'Out of stock'}}
                                            </td>
                                            <td>
                                                <button @if($product->qty>0) data-id="{{ $product->id }}" @endif data-title="<i class='fa fa-shopping-basket'></i>" class="btn btn-success{{ ($product->qty>0)?' add-to-cart':'' }}"><i class="fa fa-shopping-basket"></i></button>
                                                <button data-id="{{ $product->id }}" data-title="<i class='fa fa-trash'></i>" class="btn btn-danger remove-from-wishlist"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>

                                </table>
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