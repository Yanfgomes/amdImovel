<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immobiles;
use App\Models\User;
use App\Models\Ufs;

class ImmobileController extends Controller
{
    public function index(){
        if(auth()->user()->adm==1)
            $immobiles=Immobiles::with('user')
            ->with('uf')
            ->get();
        else if(auth()->user()->customer==1)
            $immobiles=Immobiles::where('user_id',auth()->user()->id)->with('user')
            ->with('uf')
            ->get();
        else
            return back()->with('warning','Acesso Negado');
        return view('immobile.index',compact('immobiles'));
    }

    public function create(){
        if(auth()->user()->adm==1){
            $users=User::where('customer',1)->get();
            $lessees=User::where('lessee',1)->get();
            $ufs=Ufs::all();
            return view('immobile.create',compact(['users','ufs','lessees']));
        }
        else
            return back()->with('warning','Acesso Negado');
    }

    public function store(Request $request){
        if(auth()->user()->adm==1){
            $rent=str_replace(",",".",str_replace(".","",$request->rent));
            $immobile=[
                'user_id' => $request->customer,
                'cep' => $request->cep,
                'uf_id' => $request->uf,
                'city' => $request->city,
                'district' => $request->district,
                'street' => $request->street,
                'number' => $request->number,
                'complement' => $request->complement,
                'rent' => $rent
            ];
            Immobiles::create($immobile);
            $immobiles=Immobiles::all();
            return view('immobile.index', compact('immobiles'));
        }
        else
            return back()->with('warning','Acesso Negado');
    }
}
