<?php

namespace App\Http\Controllers;

use App\AddressBook;
use App\Order;
use App\Product;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class accountController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth']);
	}

	public function index()
	{
		return view('front.account.account');
	}

	public function editInfo()
	{
		return view('front.account.edit-info');
	}

	public function saveInfo(Request $request)
	{
		$this->validate($request, [
			'first_name' => 'required|string|max:200',
			'last_name' => 'required|string|max:200',
			'email' => 'required|email|max:250',
			'tel' => 'required|string|numeric|digits_between:8,16',
		]);

		$user = $request->user();
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->tel = $request->tel;
		$user->save();

		return redirect()->back()->with('flash_success', 'Your account information was updated successfully.');
	}

	public  function editPassword()
	{
		return view('front.account.change-password');
	}

	public function updatePassword(Request $request)
	{
		$this->validate($request, [
			'password' => 'required|string|min:6|confirmed',
			'current' => 'required|string|min:6',
		]);

		if (Hash::check($request->current, Auth::user()->password))
		{
			$user = $request->user();
			$user->password = bcrypt($request->password);
			$user->save();
		} else {
			return redirect()->back()->with('flash_error', 'Incorrect password.');
		}

		return redirect()->back()->with('flash_success', 'Your password was updated successfully.');
	}

	public function addressBook()
	{
		return view('front.account.addresses', [
			'addresses' => $addresses = AddressBook::where('user_id', Auth::id())->get()
		]);
	}

	public function editAddress($id)
	{
		return view('front.account.edit-address', [
			'add' => AddressBook::find($id)
		]);
	}

	public function updateAddress(Request $request, $id)
	{
		$this->validate($request, [
			'street' => 'required|string',
			'state' => 'required|string',
			'lga' => 'required|string',
			'area' => 'required|string',
			'landmark' => 'string',
			'tel' => 'required|string',
		]);

		$address = AddressBook::find($id);
		$address->street_address = $request->street;
		$address->state = $request->state;
		$address->lga = $request->lga;
		$address->area = $request->area;
		$address->landmark = $request->landmark;
		$address->tel = $request->tel;
		$address->save();

		return redirect()->route('show_address')->with('flash_success', 'The address was updated.');
	}

	public function showOrders()
	{
		return view('front.account.orders', [
			'orders' => Order::with(['billing_info', 'shipping_info'])->where('user_id', Auth::id())->orderBy('id', 'desc')->get()
		]);
	}

	public function wishlist()
	{
		$wishlist = Wishlist::where('user_id', Auth::id())->first();
		$ids = [];
		foreach(json_decode($wishlist->list) as $item)
		{
			$ids[] = $item->id;
		}

		return view('front.account.wishlist', [
			'products' => Product::with(['images'])->whereIn('id', $ids)->get(),
			'list' => json_decode($wishlist->list)
		]);
	}
}
