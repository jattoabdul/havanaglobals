<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class havanaController extends Controller
{

	public function home()
	{
		return view('front.index',
			[
				'products'=>Product::with('images')->limit(8)->get(),
				'deals'=>Product::with('category')->inRandomOrder()->limit(4)->get(),
				'categories'=>Category::get(),
			]);
	}

	public function productShow(Request $request, $id, $slug="")
	{
		$product = Product::with(['category','images'])->where('id',$id)->first();

		if($product==null){ return redirect()->route('error_404'); }
		return view('front.product-detail',
			[
				'product'=>$product,
				'stock'=>$product->qty,
			]);
	}

	public function cartAdd(Request $request)
	{
		$product = Product::find($request->pid);
		if($product)
		{
			Cart::add(['id'=>$request->pid,'name'=>$product->name,'qty'=>$request->qty,'price'=>$product->price]);
			return redirect()->back()->with('flash_success',"{$product->name} Added To Cart");
		}
		return redirect()->route('home');
	}

	public function cartShow(Request $request) { return view('front.cart'); }

	public function cartRemove(Request $request,$row_id){ Cart::remove($row_id); return redirect()->back()->with('flash_success','Item Removed'); }
	public function cartUpdate(Request $request)
	{
		Cart::update($request->row_id,$request->qty);
		return redirect()->back()->with('flash_success','Item Quantity Updated');
	}
}
