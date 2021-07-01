<?php

use Illuminate\Database\Seeder;
use App\Client;


class ClientsTableSeeder extends Seeder
{

    public function run()
    {
       	Client::create([
	        'name' => 'Jhonny Jimenez',
	        'email' => 'jhonny@example.com',
	        'identity_card' => '25744294',
	        'address' => 'Unare 1',
	        'phone' => '0412-8784392',
	    ]);	

	    Client::create([
	        'name' => 'Alex Carpenito',
	        'email' => 'alex@example.com',
	        'identity_card' => '25744777',
	        'address' => 'Unare 1',
	        'phone' => '0412-8784777',
	    ]);	

	    Client::create([
	        'name' => 'Juan Carpenito',
	        'email' => 'juan@example.com',
	        'identity_card' => '25744888',
	        'address' => 'Unare 1',
	        'phone' => '0412-8784888',
	    ]);	

	    Client::create([
	        'name' => 'Luis Jimenez',
	        'email' => 'luis@example.com',
	        'identity_card' => '25744555',
	        'address' => 'Unare 1',
	        'phone' => '0412-8784555',
	    ]);	
    }
}

