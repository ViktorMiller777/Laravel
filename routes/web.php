<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


// Rutas de vistas


Route::get('/',function(){
    return view('home');
});
Route::get('/home/login',function(){
    return view('login'); // Formulario login
});

Route::get('/home/register',function(){
    return view('register'); // Formulario register
});

Route::get('/home/dashboard',function(){ // Pagina de inicio
    return view('dashboard');
});

Route::get('/home/mapa',function(){ // Pagina de mapa
    return view('mapa');
});

Route::get('/dashboard',[UserController::class,'getUser']);

Route::post('/login',[AuthController::class,'login']);

Route::post('/register',[AuthController::class,'register']);

Route::get('/mapa',[UserController::class,'iniciarMap']);



