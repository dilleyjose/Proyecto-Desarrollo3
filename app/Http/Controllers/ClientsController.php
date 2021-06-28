<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        return view('clients.index');       
    }
    
    public function getClients(){        
        $clients = Client::all();
        return $clients;
    }
 
    public function store(Request $request){
        return Client::create(
            $request->only('name','email','identity_card','address','phone')
        );
    }

    public function update($id,Request $request){      
        $Client = Client::find($id);

        $data = $request->only('name','email','identity_card','address','phone');

        $Client->fill($data);
        $Client->save();// UPDATE

        return $Client;
    }

    public function destroy($id){
        $Client = Client::find($id);
        $Client->delete();
    }
}
