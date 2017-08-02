<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	//Relationships
    public function user(){return $this->belongsTo('App\User');}
    public function billing_info(){return $this->belongsTo('App\AddressBook', 'billing_address' );}
    public function shipping_info(){return $this->belongsTo('App\AddressBook', 'shipping_address');}
}
