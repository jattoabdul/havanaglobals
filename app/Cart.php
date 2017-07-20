<?php

namespace App;

class Cart
{
    public function hasItemsInCart()
	{
		if(isset($_SESSION['cart'])) { return true; } return false;
	}
}
