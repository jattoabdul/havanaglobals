<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Core;
use Illuminate\Support\Collection;

class havanaController extends Controller
{

	public function home()
	{
		return view('front.index',
			[
				'products'=>Product::with('images')->limit(8)->get(),
				'deals'=>Product::with('category')->inRandomOrder()->limit(4)->get(),
				'categories'=>Category::all(),
			]);
	}

	public function productShow(Request $request, $id, $slug="")
	{
		$product = Product::with(['category','images'])->where('id',$id)->first();

		if($product==null){ return redirect()->route('error_404'); }

		$related = new Collection();
		foreach ($product->category as $category)
		{
			$related = $related->merge($category->products()->limit(4)->get());
		}

		return view('front.product-detail',
			[
				'product'=>$product,
				'stock'=>$product->qty,
				'related' => $related
			]);
	}

	public function cartAdd(Request $request)
	{
		$product = Product::find($request->pid);

		if($product)
		{
			$item = Cart::add(['id'=>$request->pid,'name'=>$product->name,'qty'=>$request->qty,'price'=>$product->price]);

			if($request->ajax())
			{
				return response()->json([
					'state' => 'success',
					'msg' => $product->name." Added To Cart",
					'total' => Cart::total(),
					'count' => Cart::count(),
					'data' => [
						'name' => $product->name,
						'qty' => $request->qty,
						'price' => $product->price,
						'img' => ($product->images->isNotEmpty())?$product->images[0]->url:'',
						'url' => route('product_detail', ['id'=>$product->id, 'slug'=>Core::slugger($product->name)]),
						'row_id' => $item->rowId,
					]
				]);
			}
			return redirect()->back()->with('flash_success',"{$product->name} Added To Cart");
		}

		if($request->ajax())
		{
			return response()->json(['state'=>'error', 'msg' => "Product {$product->name} Not Found."]);
		}
		return redirect()->route('home');
	}

	public function cartShow(Request $request) { return view('front.cart'); }

	public function cartRemove(Request $request,$row_id){
		Cart::remove($row_id);
		if($request->ajax()) { return response()->json(['state'=>'success', 'msg'=>'Item Removed', 'count'=>Cart::count(), 'total'=>Cart::total()]); }
		return redirect()->back()->with('flash_success','Item Removed');
	}

	public function cartUpdate(Request $request)
	{
		Cart::update($request->row_id,$request->qty);
		return redirect()->back()->with('flash_success','Item Quantity Updated');
	}
}
