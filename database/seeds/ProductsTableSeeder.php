<?php

use Illuminate\Database\Seeder;

use App\Product;

class ProductsTableSeeder extends Seeder
{

    public function run()
    {
       	Product::create([
	        'name' => 'Alicate',
	        'description' => 'Marca Dewar',
	        'stock' => 3,
	        'amount' => 6,
	    ]);

	    Product::create([
	        'name' => 'Serrucho',
	        'description' => 'Marca Dewar',
	        'stock' => 6,
	        'amount' => 5,
	    ]);

	    Product::create([
	        'name' => 'Martillo',
	        'description' => 'Marca Dewar',
	        'stock' => 5,
	        'amount' => 8,
	    ]);

	    Product::create([
	        'name' => 'Esmeril',
	        'description' => 'Marca Dewar',
	        'stock' => 6,
	        'amount' => 7,
	    ]);
    }
}
