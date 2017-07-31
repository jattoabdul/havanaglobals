<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Wishlist;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Core;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class havanaController extends Controller
{

	public function home()
	{
		return view('front.index',
			[
				'products'=>Product::with(['images'])->orderBy('id', 'desc')->limit(12)->get(),
				'deals'=>Product::with(['category', 'images'])->where('old_price', '!=', null)->limit(4)->inRandomOrder()->get(),
				'categories'=>Category::all(),
			]);
	}

	public function contactUs()
	{
		return view('front.contact');
	}

	public function aboutUs()
	{
		return view('front.about');
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


		if($request->ajax()) {return response()->json(['state'=>'success', 'product' => $product->toArray()]);}

		return view('front.product-detail', ['product'=>$product, 'stock'=>$product->qty, 'related' => $related]);
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

	public function addToWishlist(Request $request)
	{
		if(Product::where('id', $request->id)->exists())
		{
			$wishlist = Wishlist::where('user_id', Auth::id())->first();

			if($wishlist)
			{
				$list = json_decode($wishlist->list, true);
				if(!is_array($list)) { $list = []; }

				if(!array_key_exists('item_'.$request->id, $list))
				{
					$list['item_'.$request->id] = ['id' => $request->id, 'created_at' => Carbon::now()->toFormattedDateString()];
					$wishlist->list = json_encode($list);
					$wishlist->save();

					$response = ['state'=>'success','msg'=>'The item has been added to your wishlist.'];
				}
				else { $response = ['state'=>'info','msg'=>'This item is already on your wishlist.']; }
			}
			else
			{
				$wishlist = new Wishlist();
				$wishlist->user_id = Auth::id();
				$wishlist->list = json_encode(['item_'.$request->id => ['id' => $request->id, 'created_at' => Carbon::now()->toFormattedDateString()]]);
				$wishlist->save();

				$response = ['state'=>'success','msg'=>'The item has been added to your wishlist.'];
			}
		}
		else { $response = ['state'=>'error','msg'=>'The item you are trying to add to your wishlist does not exist.']; }


		if($request->ajax()) { return response()->json($response); }
		else { return redirect()->back()->with('flash_'.$response['state'], $response['msg']); }
	}

	public function removeFromWishlist(Request $request)
	{
		if(Product::where('id', $request->id)->exists())
		{
			$wishlist = Wishlist::where('user_id', Auth::id())->first();

			if($wishlist)
			{
				$list = json_decode($wishlist->list, true);
				if(!is_array($list)) { $list = []; }

				if(array_key_exists('item_'.$request->id, $list))
				{
					unset($list['item_'.$request->id]);
					$wishlist->list = json_encode($list);
					$wishlist->save();

					$response = ['state'=>'success','msg'=>'The item has been removed from your wishlist.'];
				}
				else { $response = ['state'=>'info','msg'=>'This item you are trying to remove is not on your wishlist.']; }
			}
			else { $response = ['state'=>'info','msg'=>'There are no items on your wishlist.']; }
		}
		else { $response = ['state'=>'error','msg'=>'The item you are trying to remove no longer exists.']; }


		if($request->ajax()) { return response()->json($response); }
		else { return redirect()->back()->with('flash_'.$response['state'], $response['msg']); }
	}
}
