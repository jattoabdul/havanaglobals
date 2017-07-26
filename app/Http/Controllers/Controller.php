<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function generateRandString($length=10, $type=3)
	{
		//1 - alphanumeric, 2 - alpha, 3 - numeric
		if($type==1){ $string = 'abcdefghijklmnopqrstuvwxyz1234567890'; }
		if($type==1){ $string = 'abcdefghijklmnopqrstuvwxyz'; }
		if($type==3){ $string = '1234567890'; }

		$randString='';

		for($i=0; $i < $length; $i++)
		{
			$randString .= $string[mt_rand(0,strlen($string)-1)];
		}

		if(Order::where('order_id', $randString)->exists()){
			$this->generateRandString();
		}

		return $randString;
	}
}
