<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Paystack;

class paymentController extends Controller
{
	protected function getStatus()
	{
		$trans = Paystack::getPaymentData();

		//dd($trans);

		//Log Transaction
		$transaction = new Payment();
		$transaction->user_id = Auth::id();
		$transaction->amount = $trans['data']['amount']/100;
		$transaction->ref = $trans['data']['reference'];
		$transaction->status = ($trans['data']['status'] == "success")? 1 : 2;
		$transaction->save();

		return [
			'status' => $transaction->status,
			'message' => $trans['data']['message'],
			'ref' => $trans['data']['reference'],
			'amount' => $trans['data']['amount']
		];
	}

	public function paystackCallback()
	{
		$trans = $this->getStatus();

		//dd($trans);

		$status = $trans['status'];
		$msg = $trans['message'];
		$ref = $trans['ref'];
		$amount = $trans['amount'];

		$order = Order::where('ref', $ref)->first();
		if($status == 1)
		{
			$order->status = 1;
			foreach(json_decode($order->products) as $item)
			{
				$product = Product::find($item->id);
				$product->qty = $product->qty - $item->qty;
				$product->save();
			}

			$msg = 'Transaction complete, your order ('.$ref.') has been received. Thank you.';
		}
		else
		{
			$order->status = 2;
			foreach(json_decode($order->products) as $item) { Cart::add(['id'=>$item->id,'name'=>$item->name,'qty'=>$item->qty,'price'=>$item->price]); }
			$msg = "Transaction failed: ".$msg;
		}

		$order->save();

		return redirect()->route('confirm_order')->with('msg', $msg);
	}

	public function confirm()
	{
		if(session('msg')) { return view('front.confirm'); }
		else { return redirect('/'); }
	}
}
