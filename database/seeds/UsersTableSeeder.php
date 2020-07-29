<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	      User::create([
	    	'name' => 'Francisco Quintero',
	        'email' => 'ingfcoquintero@gmail.com',
	        'password' => bcrypt('laravel123'), // password
	        'cédula' => '79949682',
	        'address' => '',
	        'phone' => '',
	        'role' => 'admin'
	      ]);
	      factory(User::class, 50)->create();
    }
}
