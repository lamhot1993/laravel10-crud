<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UserController extends Controller
{
    public function get(){
        $users = new Users;
        return $users->all();
    }

    public function add(Request $request){
        $users = new Users;
 
        $users->username = $request->username;
        $users->email = $request->email;
        $users->birthday = $request->birthday;

        return $users->save();
    }

    public function update(Request $request){
        
        $id = $request->id;

        $users = Users::find($id);
 
        $users->username = $request->username;
        $users->email = $request->email;
        $users->birthday = $request->birthday;

        return $users->save();
    }

    public function delete(Request $request){
        $id = $request->id; 
        
        $Users = Users::find($id);
 
        return $Users->delete();
    }
}
