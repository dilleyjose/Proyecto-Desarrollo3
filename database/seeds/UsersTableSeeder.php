<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
	    User::create([
	        'name' => 'Jhonny Carpenito',
	        'email' => 'jhonny@example.com',
	        'password' => bcrypt('123123'),
	        'identity_card' => '25744294',
	        'address' => 'Unare 1',
	        'phone' => '0412-8784392',
	        'position' => 'Trabajador Explotado',
	        'role' => 'admin'
	    ]);	
    }
}
