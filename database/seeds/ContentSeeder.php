<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('contents')->insert([
			'title' => 'Contact',
			'status' => 1,
			'slug' => 'contact',
			'top' => 1,
			'parent' => null,
			'body' => '',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		]);
		DB::table('contents')->insert([
			'title' => 'Store Address',
			'status' => 1,
			'slug' => 'address',
			'top' => 0,
			'parent' => 'contact',
			'body' => '100 highland ave, california, united state',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		]);
		DB::table('contents')->insert([
			'title' => 'Store Email',
			'status' => 1,
			'slug' => 'email',
			'top' => 0,
			'parent' => 'contact',
			'body' => 'contact@naturix.com',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		]);
		DB::table('contents')->insert([
			'title' => 'Store Website',
			'status' => 1,
			'slug' => 'website',
			'top' => 0,
			'parent' => 'contact',
			'body' => 'www.havana.com',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		]);
    }
}
