<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

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
            $request->only('name','email','identity_card','address','phone','position','role')
            + [
                //'role' => 'user',
                'password' => bcrypt($request->input('password'))
            ]
        );
        
    }

    public function update($id,Request $request){      

        $user = User::find($id);

        $data = $request->only('name','email','identity_card','address','phone','position','role');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();// UPDATE

        return $user;


    
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
    }}
