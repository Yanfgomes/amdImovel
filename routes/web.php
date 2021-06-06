<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';
date_default_timezone_set('America/Sao_Paulo');


Route::get('/', function () {
    $hora=date("H");
    if($hora<3){
        $mensagem="Boa noite";
        $imagem="noite";
    }
    else if($hora<12){
        $mensagem="Bom dia";
        $imagem="manha";
    }
    else if($hora<18){
        $mensagem="Boa tarde";
        $imagem="tarde";
    }
    else{
        $mensagem="Boa noite";
        $imagem="noite";
    }
    $explodeName=explode(" ",auth()->user()->name);
    $firstName=$explodeName[0];
    
    return view('dashboard', compact("mensagem","imagem","firstName"));
})->middleware(['auth'])->name('dashboard');


Route::group(['middleware' => ['auth']], function () {

    Route::prefix('customer')->name('customer.')->group(function()
    {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/new', [UserController::class, 'create'])->name('create');
    });

});





