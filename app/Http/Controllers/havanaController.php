<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class havanaController extends Controller
{

	public function home()
	{
		return view('front.index',
			[
				'products'=>Product::limit(8)->get(),
				'deals'=>Product::with('category')->inRandomOrder()->limit(4)->get(),
				'categories'=>Category::get(),
			]);
	}

	public function productShow(Request $request, $id, $slug="")
	{
		$product = Product::with('category')->where('id',$id)->first();

		if($product==null){ return redirect()->route('error_404'); }
		return view('front.product-detail',
			[
				'product'=>$product,
				'stock'=>$product->qty,
			]);
	}

	public function cartAdd(Request $request)
	{
		$cart = new Cart();
		dd($cart->hasItemsInCart());
	}
}
