<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immobiles;
use App\Models\User;
use App\Models\Ufs;
use App\Models\Image;
use App\Models\Financial;

class RequestController extends Controller
{
    public function index(){
        if(auth()->user()->adm==1)
            $immobiles=Immobiles::with('user:id,name')
            ->with('uf:id,uf')
            ->with('lessee:id,name')
            ->get();
        else if(auth()->user()->customer==1)
            $immobiles=Immobiles::where('user_id',auth()->user()->id)
            ->with('user:id,name')
            ->with('uf:id,uf')
            ->with('lessee:id,name')
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
                'lessee_id' => empty($request->lessee)?null:$request->lessee,
                'status' => $request->status,
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
            return redirect()->route('immobiles.index');
        }
        else
            return back()->with('warning','Acesso Negado');
    }

    public function view($id){
        $immobile=Immobiles::find($id);
        if(!isset($immobile))
            return back()->with('warning','Imóvel não encontrado');
        if(auth()->user()->adm==0 && $immobile->user->id<>auth()->user()->id)
            return back()->with('warning','Acesso Negado');
        if(auth()->user()->adm==1){
            $users=User::where('customer',1)->get();
            $lessees=User::where('lessee',1)->get();
            $ufs=Ufs::all();
            $images=Image::where('immobile_id',$id)->get();
            return view('immobile.view',compact(['immobile','users','ufs','lessees','images']));
        }
        else{
            return view('immobile.viewCustomer',compact(['immobile']));
        }
    }
    
    public function delete($id){
        if(auth()->user()->adm==1){
            $immobile = Immobiles::Find($id)->delete();
            return back()->with('success','Sucesso');
        }
        else
            return back()->with('error','Acesso negado');
    }

    public function update(Request $request){
        if(auth()->user()->adm==1){
            $rent=str_replace(",",".",str_replace(".","",$request->rent));
            $immobile = Immobiles::Find($request->id);
            if(!isset($immobile))
                return back()->with('warning','Imóvel não encontrado');

            $immobile->user_id=$request->customer;
            $immobile->lessee_id=empty($request->lessee)?null:$request->lessee;
            $immobile->status=$request->status;
            $immobile->cep=$request->cep;
            $immobile->uf_id=$request->uf;
            $immobile->city=$request->city;
            $immobile->district=$request->district;
            $immobile->street=$request->street;
            $immobile->number=$request->number;
            $immobile->complement=$request->complement;
            $immobile->rent=$rent;
            $immobile->save();
            return back()->with('success','Sucesso');
        }
        else
            return back()->with('error','Acesso negado');
    }

    public function dashboard($id, Request $request){
        $month=$request->month;

        $immobile=Immobiles::where('id',$id)
        ->first();
        
        if(auth()->user()->adm==0 && $immobile->user->id<>auth()->user()->id)
            return back()->with('warning','Acesso Negado');

        $financials=Financial::where('immobile_id',$id)
        ->where('cycle',$month.'-01')
        ->with('type')
        ->with('status')
        ->get();

        $financialCharts=Financial::where('immobile_id',$id)
        ->selectRaw('sum(value) as value, type_id')
        ->where('cycle',$month.'-01')
        //->where('status_id',2)
        ->with('type')
        ->groupBy('type_id')
        ->get();
        
        $json='{"name": "Vazio","value": 0}';
        foreach ($financialCharts as $financialChart)
            $json.=',{"name": "'.$financialChart->type->name.'","value": '.($financialChart->value<0?($financialChart->value*-1):$financialChart->value).'}';
        $json=str_replace('{"name": "Vazio","value": 0},',"",$json); 
        $json=json_decode('['.$json.']');
        return view('immobile.dashboard', compact('immobile','financials','json','month'));
    }
}
