<?php

use Illuminate\Database\Seeder;

//my uses:
use Illuminate\Support\Facades\Hash;
use App\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }
	
}

class UsersTableSeeder extends Seeder 
{

    public function run()
    {
        DB::table('users')->delete();

        User::create([
        			'email' => 'henryespinozat@gmail.com',
        			'password' => Hash::make('46618582'), //to encrip password
        				]);
	}
}
