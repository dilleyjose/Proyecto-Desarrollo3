<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\ItemInvoice;

class InvoicesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        return view('invoices.index');       
    }

    public function store(Request $request){
        return Invoice::create(
            $request->only('client_id','user_id')
        );
    }

    public function storeItem(Request $request){
        
        $Item = ItemInvoice::create(
            $request->only('invoice_id','product_id','quantity','amount')
        );

        $Item->product_name = $Item->product->name;

        return $Item;
    }

    public function destroyItem($id){
        $Item = ItemInvoice::find($id);
        $Item->delete();
    }

}
