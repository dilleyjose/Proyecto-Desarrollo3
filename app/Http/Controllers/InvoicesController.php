<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
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

    public function controlInvoices(Request $request){
        return view('invoices.invoices');       
    }

    
    public function getProducts($id){        
        
        $Invoice = Invoice::find($id);
        $Products = $Invoice->items;

        foreach ($Products as $Product ) {
            $Product->name = $Product->product->name;            
        }

        return $Products;
    }

    public function getInvoices(){        
        
        $Invoices = Invoice::all();

        foreach ($Invoices as $Invoice ) {
            $Invoice->client;
        }

        return $Invoices;
    }


    public function store(Request $request){
        
        $Invoice = Invoice::create(
            $request->only('client_id','user_id')
        );

        $Invoice->client_name = $Invoice->client->name;

        return $Invoice;
    }

    public function storeItem(Request $request){
        
        $Item = ItemInvoice::create(
            $request->only('invoice_id','product_id','quantity','amount')
        );

        $Item->product_name = $Item->product->name;

        $product = Product::find( $Item->product_id );
        $product->stock -= $Item->quantity;
        $product->save();

        $invoice = Invoice::find( $Item->invoice_id );
        $invoice->amount += $Item->quantity * $Item->amount;
        $invoice->save();

        return $Item;
    }

    public function destroyItem($id){
        $Item = ItemInvoice::find($id);
        $Item->delete();
    }

    public function destroy($id){
        $Invoice = Invoice::find($id);

        foreach ($Invoice->items as $Item ) {
            $product = Product::find($Item->product_id);
            $product->stock += $Item->quantity;
            
            $Item->delete();
            $product->save();
        }

        $Invoice->delete();
    }

}
