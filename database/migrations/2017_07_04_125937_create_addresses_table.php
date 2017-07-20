<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_book', function(Blueprint $table){
        	$table->increments('id');
        	$table->integer('user_id');
        	$table->string('street_address');
        	$table->string('state');
        	$table->string('lga');
        	$table->string('area');
        	$table->string('landmark')->nullable();
        	$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_book');
    }
}
