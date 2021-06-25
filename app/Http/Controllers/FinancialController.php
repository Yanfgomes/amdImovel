<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use App\Models\ListType;
use App\Models\ListStatus;
use App\Models\Immobiles;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


        // $financials=Immobiles::with(['financial' => function($q) {
        //     $q->whereBetween('paid', [date("Y-m-01"),date("Y-m-01",strtotime("+1 months"))]);
        // }]) 
        // ->get();
        // $financials[0]->financial->sum('value');

class FinancialController extends Controller
{
    public function index(){
        if(auth()->user()->adm==1)
            $financials=Immobiles::with(['financial' => function($q) {
                $q->where('paid', null);
            }])
            ->get();
        else if(auth()->user()->customer==1)
            $financials=Immobiles::where('user_id',auth()->user()->id)
            ->with(['financial' => function($q) {
                $q->where('paid', null);
            }])
            ->get();
        else
            return back()->with('warning','Acesso Negado');
            
        return view('financial.index', compact(['financials']));
    }

    public function create(){
        if(auth()->user()->adm==1){
            $immobiles=Immobiles::all();
            $listTypes=ListType::all();
            $listStatus=ListStatus::all();
            return view('financial.create', compact(['listTypes','immobiles','listStatus']));
        }
        else
            return back()->with('warning','Acesso Negado');
    }

    public function store(Request $request){
        if(auth()->user()->adm==1){
            if (isset($request->file)) {
                $this->validate($request,[
                    'file'        =>  'required|mimes:pdf,jpeg,png,jpg,gif|max:4096'
                ]);
            }
            
            $financial = new Financial;
    
            $financial->document = $request->file;
            if($financial->document){
            try {
                    $filePath = $this->UserImageUpload($financial->document);
                    $financial->document = $filePath;
    
                } catch (Exception $e) {
                    return redirect()->back()->with('error', 'Ocorreu um erro');
                }
            }

            $value=str_replace(",",".",str_replace(".","",$request->value));
            if($request->type>1)
                $value*=-1;
            $financial->type_id = $request->type;
            $financial->immobile_id = $request->immobile;
            $financial->value = $value;
            $financial->status_id = $request->status;
            if($request->status==1)
                $financial->paid = date("Y-m-d H:i:s");
            $financial->save();

            return redirect()->route("financial.index");
        }
        else
            return back()->with('warning','Acesso Negado');
    }
}
