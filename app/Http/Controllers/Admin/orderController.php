<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class orderController extends Controller
{
	protected $allowedStatusUpdated = [1,3,4];
    public function index()
	{
		return view('admin.order.index', [
			'orders' => Order::all()
		]);
	}

	public function view($id)
	{
		$order = Order::find($id);
		if($order)
		{
			return view('admin.order.view',[
				'order' => $order
			]);
		}

		return redirect()->back();
	}

	public function updateStatus($id, $status)
	{
		$order = Order::find($id);
		if($order)
		{
			if(in_array($status, $this->allowedStatusUpdated))
			{
				$order->status = $status;
				$order->save();

				return redirect()->back()->with('success', 'Order status has been updated.');
			}
			return redirect()->back()->with('error', 'Invalid order status supplied.');
		}
		return redirect()->back()->with('success', 'Order not found.');
	}
}
