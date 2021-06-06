<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users=User::all();
        return view("user.index", compact('users'));
    }

    public function create(){
        if(auth()->user()->adm==1){
            return view('user.create');
        }
        else{
            return redirect()->back()->withStatusError("Access Denied");
        }
    }
}
