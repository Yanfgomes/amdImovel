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
            return back()->with('error','Acesso negado');
        }
    }

    public function create(){
        if(auth()->user()->adm==1){
            return view('user.create');
        }
        else{
            return back()->with('error','Acesso negado');
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
            return back()->with('error','Acesso negado');
        }
    }

    public function view($id){
        if(auth()->user()->adm==1 || auth()->user()->id==$id){
            $user = User::find($id);
            if(!isset($user))
                return back()->with('warning','Usuário não encontrado');
            return view('user.view', compact('user'));
        }
        else{
            return back()->with('error','Acesso negado');
        }
    }

    public function update(Request $request){
        if(auth()->user()->adm==1 || auth()->user()->id==$id){
            $user = User::find($request->id);
            if(!isset($user))
                return back()->with('warning','Usuário não encontrado');

            if(!empty($request->password)){
                if($request->password==$request->password_confirmation){
                    $user->password=Hash::make($request->password);
                }
                else
                    return back()->with('warning','As senhas devem ser iguais');
            }

            $user->cpf=$request->cpf;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->adm=$request->permission==1?1:0;
            $user->customer=$request->permission==2?1:0;
            $user->lessee=$request->permission==3?1:0;
            $user->save();

            if(auth()->user()->adm==1)
                return redirect()->route('customer.index');
            else
                return redirect()->route('dashboard');

        }
        else{
            return back()->with('error','Acesso negado');
        }
    }

    public function delete($id){
        if(auth()->user()->adm==1){
            $user = User::Find($id);
            if($user->adm==1)
                return back()->with('info','Contate o suporte para exclusão de usuário Administrador');
            else
                $user->delete();
            return redirect()->route('customer.index');
        }
        else
            return back()->with('error','Acesso negado');
    }
}
