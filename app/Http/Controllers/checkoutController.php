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
		if(Cart::content()->isEmpty()) { return redirect()->route('cart_show')->with('flash_info',"Cart Is Empty"); }

		$addresses = [];
		if(Auth::check()) { $addresses = AddressBook::where('user_id', Auth::id())->get(); }
		return view('front.checkout', [
			'addresses' => $addresses,
			'cart_items' => Cart::content(),
			'cart_total' => Cart::total()
		]);
	}

	public function addAddress(Request $request)
	{
		$this->validate($request, [
			'street' => 'required|string',
			'state' => 'required|string',
			'lga' => 'required|string',
			'area' => 'required|string',
			'landmark' => 'string',
			'tel' => 'required|string',
		]);

		$address = new AddressBook();
		$address->user_id = Auth::id();
		$address->street_address = $request->street;
		$address->state = $request->state;
		$address->lga = $request->lga;
		$address->area = $request->area;
		$address->landmark = $request->landmark;
		$address->tel = $request->tel;
		$address->save();

		return redirect()->back()->with('flash_success', 'The address was added.');
	}
}
