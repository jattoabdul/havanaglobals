<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = 'John';
        $user->last_name = 'Doe';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('havana123@abc');
        $user->tel = '+234806000000';
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->type = 3;
        $user->save();
    }
}
