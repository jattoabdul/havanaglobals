<?php
/**
 * Created by PhpStorm.
 * User: jcobhams
 * Date: 8/2/17
 * Time: 2:03 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
	public function index()
	{
		return view('admin.customers.index', [
			'users' => User::all()
		]);
	}

	public function makeAdmin(Request $request)
	{
		$this->validate($request, [
			'id' => 'required|integer|exists:users,id'
		]);

		$user = User::find($request->id);
		$user->type = 3;
		$user->save();

		return redirect()->back()->with('success', $user->first_name.' has been promoted.');
	}

	public function makeCustomer(Request $request)
	{
		$this->validate($request, [
			'id' => 'required|integer|exists:users,id'
		]);

		$user = User::find($request->id);
		$user->type = 1;
		$user->save();

		return redirect()->back()->with('success', $user->first_name.' has been demoted.');
	}

	public function loginAs(Request $request)
	{
		$this->validate($request, [
			'id' => 'required|integer|exists:users,id'
		]);
		Auth::loginUsingId($request->id);
		return redirect()->back();
	}
}