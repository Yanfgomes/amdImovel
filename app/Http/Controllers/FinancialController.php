<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use App\Models\ListType;
use App\Models\ListStatus;
use App\Models\Immobiles;
use App\Models\User;
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
    
    protected $month;

    public function index(){
        $this->month=date("Y-m");
        $month=date("Y-m");

        $immobiles=Immobiles::all();

        $users=User::where('customer',1)->get();

        if(auth()->user()->adm==1){

            $financialsNotPaid=Financial::where('paid', null)
            ->with('immobile')
            ->with('type')
            ->get();
            
            $financials=Immobiles::with(['financial' => function($q) {
                $q->whereBetween('created_at', [$this->month."-01",date("Y-m-01",strtotime("$this->month-01 +1 months"))]);
            }])
            ->get();
        }    
        else if(auth()->user()->customer==1){

            $financialsNotPaid=Financial::where('paid', null)
            ->with(['financial' => function($q) {
                $q->where('user_id', auth()->user()->id);
            }])
            ->with('type')
            ->get();

            $financials=Immobiles::where('user_id',auth()->user()->id)
            ->with(['financial' => function($q) {
                $q->whereBetween('created_at', [$this->month."-01",date("Y-m-01",strtotime("$this->month-01 +1 months"))]);
            }])
            ->get();
        }    
        else
            return back()->with('warning','Acesso Negado');
        return view('financial.index', compact(['financials','financialsNotPaid','immobiles','users','month']));
    }

    public function search(Request $request){
        $this->month=$request->month;
        $month= $request->month;
        $immobiles=Immobiles::all();

        $users=User::where('customer',1)->get();

        if(auth()->user()->adm==1){

            //PESQUISA POR IMÓVEL E PERÍODO
            if(!empty($request->immobile)){
                
                $financialsNotPaid=Financial::where('paid', null)
                ->where('immobile_id',$request->immobile)
                ->whereBetween('created_at', [$this->month."-01",date("Y-m-01",strtotime("$this->month-01 +1 months"))])
                ->with('immobile')
                ->with('type')
                ->get();
                
                $financials=Immobiles::where('id', $request->immobile)
                ->with(['financial' => function($q) {
                    $q->whereBetween('created_at', [$this->month."-01",date("Y-m-01",strtotime("$this->month-01 +1 months"))]);
                }])
                ->get();
            }
            //PESQUISA POR CLIENTE E PERÍODO
            else if(!empty($request->customer)){

                $financialsNotPaid=Financial::where('paid', null)
                ->where('immobile_id',$request->immobile)
                ->whereBetween('created_at', [$this->month."-01",date("Y-m-01",strtotime("$this->month-01 +1 months"))])
                ->with(['immobile' => function($q) {
                    $q->where('user_id', $request->customer);
                }])
                ->with('type')
                ->get();
                
                $financials=Immobiles::where('user_id', $request->customer)
                ->with(['financial' => function($q) {
                    $q->whereBetween('created_at', [$this->month."-01",date("Y-m-01",strtotime("$this->month-01 +1 months"))]);
                }])
                ->get();
            }
            //PESQUISA APENAS POR PERÍODO
            else{
                $financialsNotPaid=Financial::where('paid', null)
                ->whereBetween('created_at', [$this->month."-01",date("Y-m-01",strtotime("$this->month-01 +1 months"))])
                ->with(['immobile' => function($q) {
                    $q->where('user_id', $request->customer);
                }])
                ->with('type')
                ->get();
                
                $financials=Immobiles::with(['financial' => function($q) {
                    $q->whereBetween('created_at', [$this->month."-01",date("Y-m-01",strtotime("$this->month-01 +1 months"))]);
                }])
                ->get();
            }

        }    
        else if(auth()->user()->customer==1){

            $financialsNotPaid=Financial::where('paid', null)
            ->with(['financial' => function($q) {
                $q->where('user_id', auth()->user()->id);
            }])
            ->with('type')
            ->get();

            $financials=Immobiles::where('user_id',auth()->user()->id)
            ->with(['financial' => function($q) {
                $q->whereBetween('created_at', [$this->month."-01",date("Y-m-01",strtotime("$this->month-01 +1 months"))]);
            }])
            ->get();
        }    
        else
            return back()->with('warning','Acesso Negado');
        return view('financial.index', compact(['financials','financialsNotPaid','immobiles','users','month']));
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
            if (isset($request->file) || $request->status==2) {
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
            if($request->status==2)
                $financial->paid = date("Y-m-d H:i:s");
            $financial->save();

            return redirect()->route("financial.index");
        }
        else
            return back()->with('warning','Acesso Negado');
    }

    public function view($id){
        $financial=Financial::find($id)
        ->with('immobile')
        ->with('status')
        ->with('type')
        ->first();
        
        if(auth()->user()->adm==0 && $financial->immobile->user_id<>auth()->user()->id)
            return back()->with('warning','Acesso Negado');
        if(auth()->user()->adm==1){
            $immobiles=Immobiles::all();
            $listTypes=ListType::all();
            $listStatus=ListStatus::all();
            return view('financial.view',compact(['financial','immobiles','listTypes','listStatus']));
        }
        else{
            return view('financial.viewCustomer',compact(['financial']));
        }
    }

    public function delete($id){
        if(auth()->user()->adm==1){
            $financial = Financial::Find($id);
            if($financial->status_id==1)
                $financial->delete();
            else
                return back()->with('error','Não é possível apagar registro pago');
            return back()->with('success','Sucesso');
        }
        else
            return back()->with('error','Acesso negado');
    }
}
