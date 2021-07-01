<?php

use Illuminate\Database\Seeder;

use App\Supplier;

class SuppliersTableSeeder extends Seeder
{

    public function run()
    {
       	Supplier::create([
	        'name' => 'Materiales Guayana',
	        'description' => 'Distribuidor de Herramientas Varias',
	        'email' => 'materialesguayana@example.com',
	        'addres' => 'Unares',
	        'phone' => '0412-8784333',
	    ]);

	  	Supplier::create([
	        'name' => 'FerreMax',
	        'description' => 'Distribuidor de Herramientas Varias',
	        'email' => 'FerreMax@example.com',
	        'addres' => 'Unares',
	        'phone' => '0412-8784333',
	    ]);

	    Supplier::create([
	        'name' => 'ElectricImport',
	        'description' => 'Distribuidor de Materiales Electricos',
	        'email' => 'electricimport@example.com',
	        'addres' => 'San Felix',
	        'phone' => '0412-8784333',
	    ]);

	    Supplier::create([
	        'name' => 'FerreTotal',
	        'description' => 'Distribuidor de Herramientas Varias',
	        'email' => 'Ferretotal@example.com',
	        'addres' => 'Sierra Parima',
	        'phone' => '0412-8784333',
	    ]);
    }
}

//'name', 'description' ,'email','address','phone',