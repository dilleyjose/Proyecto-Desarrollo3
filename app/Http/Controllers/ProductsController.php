<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        return view('products.index');       
    }
    
    public function getProducts(){        
        $products = Product::all();
        return $products;
    }
 
    public function store(Request $request){
        return Product::create(
            $request->only('name', 'description' ,'stock','amount')
        );
    }

    public function update($id,Request $request){      
        $Product = Product::find($id);

        $data = $request->only('name', 'description' ,'stock','amount');

        $Product->fill($data);
        $Product->save();// UPDATE

        return $Product;
    }

    public function destroy($id){
        $Product = Product::find($id);
        $Product->delete();
    }
}
