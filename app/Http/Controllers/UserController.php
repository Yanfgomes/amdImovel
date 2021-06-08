<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        if(auth()->user()->adm==1){
            $users=User::all();
            return view("user.index", compact('users'));
        }
        else{
            return back()->with('warning','Access Denied');
        }
    }

    public function create(){
        if(auth()->user()->adm==1){
            return view('user.create');
        }
        else{
            return back()->with('warning','Access Denied');
        }
    }

    public function store(Request $request){
        if(auth()->user()->adm==1){
            $array = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'cpf' => $request->cpf,
                'adm' => $request->permission==1?1:0,
                'customer' => $request->permission==2?1:0,
                'lessee' => $request->permission==3?1:0
            ];
            //die(json_encode($array));
            $user = User::create($array);
    
            $users=User::all();
            return view('user.index', compact('users'));
        }
        else{
            return back()->with('warning','Access Denied');
        }
    }

    public function view($id){
        if(auth()->user()->adm==1 || auth()->user()->id==$id){
            $user = User::find($id);
            if(!isset($user))
                return back()->with('danger','User Not Found');
            return view('user.view', compact('user'));
        }
        else{
            return back()->with('warning','Access Denied');
        }
    }
}
