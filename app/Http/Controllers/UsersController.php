<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request){
        return view('users.index');       
    }
    
    public function getUsers(){        
        $users = User::all();
        return $users;
    }

    public function collectionForSelect(){
        return new SelectDestinationsCollection( Destination::all() );
    }
    
    public function store(Request $request){
        $destination = new Destination();
        $destination->diminutive = $request->diminutive;
        $destination->description = $request->description;
        $destination->save();
        return $destination;
    }

    public function update($id,Request $request){      
        $destination = Destination::find($id);
        $destination->diminutive = $request->diminutive;
        $destination->description = $request->description;
        $destination->save();
        return $destination;
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
    }}
