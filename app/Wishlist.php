<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //Relationships
	public function user() { return $this->belongsTo('App\User'); }
}
