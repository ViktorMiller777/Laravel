<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;


// Rutas de vistas
Route::get('/',function(){
    return view('welcome');
});
// Esta es la ruta de la vista dashboard 
Route::get('/dashboard',function(){
    return view('dashboard');
});
// Y esta es la ruta de la funcion dashboard
Route::get('/dashboard',[UserController::class,'getUser']);

// Ventana de inicio
Route::get('/home',function(){
    return view('home');
});

// Formulario login
Route::get('/home/login',function(){
    return view('login'); // Formulario login
});
Route::post('/home/login/bd',[AuthController::class,'login']);

 // Formulario register
Route::get('/home/register',function(){
    return view('register');
});
// Funcion register
Route::post('/home/register/bd',[AuthController::class,'register']);

// Tabla usuarios
Route::get('/mapa',[UserController::class,'iniciarMap']);

Route::get('/logout',[AuthController::class,'logout']);



