<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        return view('invoices.index');       
    }

    public function store(Request $request){
        return Client::create(
            $request->only('client_id','user_id')
        );
    }
}
