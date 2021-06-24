<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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


        return User::create(
            $request->only('name','email','identity_card','address','phone','position')
            + [
                'role' => 'patient',
                'password' => bcrypt($request->input('password'))
            ]
        );

/*
        $destination = new Destination();
        $destination->diminutive = $request->diminutive;
        $destination->description = $request->description;
        $destination->save();
*/
//        return $destination;
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
