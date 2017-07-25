
    <div class="cart-hover">
        <a href="#"> <img alt="" src="{{ asset('front/img/icons/cart-icon.png') }}" /> </a>
        <span class="cnt crl-bg" id="cart-count">{{Cart::count()}}</span> <span class="price cart-total">N{{ Cart::total() }}</span>
            <ul class="pop-up-box cart-popup" id="cart-popup">

                @foreach(Cart::content() as $item)
                    <li class="cart-list" id="cart-item-{{ $item->id }}">
                        <div class="cart-img"> <img src="{{ asset('front/img/extra/cart-sm-1.jpg') }}" alt=""> </div>
                        <div class="cart-title">
                            <div class="fsz-16">
                                <a href="{{ route('product_detail', ['id'=>$item->id, 'slug'=>\App\Core::slugger($item->name)]) }}" target="_blank"> <span class="light-font"> {{$item->name}}</span></a>
                            </div>
                            <div class="price">
                                <strong class="clr-txt"><span>N{{$item->price}}</span> x <span id="cart-item-qty-{{ $item->id }}">{{$item->qty}}</span></strong>
                            </div>
                        </div>
                        <div class="close-icon"> <i class="fa fa-close clr-txt cart-item-remove" data-id="{{ $item->id }}"></i> </div>
                    </li>
                @endforeach

                <li class="cart-list sub-total">
                    <div class="pull-left"> <strong>Subtotal</strong> </div>
                    <div class="pull-right"> <strong class="clr-txt cart-total">N{{ Cart::total() }}</strong> </div>
                </li>
                <li class="cart-list buttons">
                    <div class="pull-left">
                        <a href="{{ route('cart_show') }}" class="theme-btn-sm-2">View Cart</a>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('cart_checkout') }}" class="theme-btn-sm-3"> Checkout </a>
                    </div>
                </li>

            </ul>
    </div>