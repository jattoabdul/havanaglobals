<?php

namespace App\Http\Controllers;

use App\AddressBook;
use App\Order;
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

	public function addOrder(Request $request)
	{
		$this->validate($request, [
			'billing_info' => 'required|integer|exists:address_book,id',
			'shipping_info' => 'required|integer|exists:address_book,id',
			'shipping_amount' => 'required|numeric',
		]);

		$order = new Order();
		$order->user_id = Auth::id();
		$order->order_id = $this->generateRandString(8);
		$order->ref = $this->generateRandString(10, 1);
		$order->total = (float) str_replace(',','', Cart::total()) + (int) $request->shipping_amount;
		$order->billing_address = $request->billing_info;
		$order->shipping_address = $request->shipping_info;
		$order->shipping_address = $request->shipping_info;
		$order->products = Cart::content()->toJson();
		$order->save();


		return redirect()->route('pay_invoice', $order->order_id);
	}

	public function payInvoice(Request $request, $order_id)
	{
		Cart::destroy();

		$order = Order::with(['billing_info', 'shipping_info'])->where('order_id', $order_id)->first();
		if($order && $order->status != 1)
		{
			return view('front.pay-invoice', [
				'order' => $order
			]);
		}
		else
		{
			return redirect()->route('cart_show');
		}
	}
}
