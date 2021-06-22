<?php

namespace App\Http\Controllers;

use App\Models\financial;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function index()
    {
        return view('financial.index');
    }

}
