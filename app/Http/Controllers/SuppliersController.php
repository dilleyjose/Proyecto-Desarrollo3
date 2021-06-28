<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SuppliersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        return view('suppliers.index');       
    }
    
    public function getSuppliers(){        
        $suppliers = Supplier::all();
        return $suppliers;
    }
 
    public function store(Request $request){
        return Supplier::create(
            $request->only('name', 'description' ,'email','address','phone')
        );
    }

    public function update($id,Request $request){      
        $Supplier = Supplier::find($id);

        $data = $request->only('name', 'description' ,'email','address','phone');

        $Supplier->fill($data);
        $Supplier->save();// UPDATE

        return $Supplier;
    }

    public function destroy($id){
        $Supplier = Supplier::find($id);
        $Supplier->delete();
    }
}
