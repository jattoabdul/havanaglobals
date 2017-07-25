<?php

namespace App\Http\Controllers;

use App\AddressBook;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class checkoutController extends Controller
{
    public function index()
	{
		if(Cart::content()->isEmpty()) { return redirect()->route('cart_show'); }

		$addresses = [];
		if(Auth::check()) { $addresses = AddressBook::where('user_id', Auth::id())->get(); }
		return view('front.checkout', [
			'addresses' => $addresses,
			'cart_items' => Cart::content(),
			'cart_total' => Cart::total()
		]);
	}
}
