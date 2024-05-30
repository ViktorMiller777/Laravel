<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MapaController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Correo;


// Rutas de vistas
Route::get('/',function(){
    return view('welcome');
});
// Esta es la ruta de la vista dashboard 
Route::get('/dashboard',function(){
    return view('dashboard');
});
// Y esta es la ruta de la funcion dashboard
Route::get('/dashboard',[UserController::class,'getUser'])->middleware(AuthMiddleware::class);

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

Route::get('/home/correo',function(){
    return view('correo');
});

Route::post('/home/correo/bd',[UserController::class,'verificacion']);

// Funcion register
Route::post('/home/register/bd',[AuthController::class,'register']);

// Tabla usuarios
Route::get('/mapa',[UserController::class,'iniciarMap']);

Route::put('/dashboard/user/{id}',[UserController::class,'actualizar']);

Route::get('/logout',[AuthController::class,'logout']);

Route::get('/home/mapa/{id}',[MapaController::class,'mapaUnico'])->middleware(AuthMiddleware::class);;
Route::get('/home/mundo',[MapaController::class,'mapaCompleto'])->middleware(AuthMiddleware::class);

Route::get('/mail', function(){
    Mail::to('cabellordz15@gmail.com')
        ->send(new Correo());
});


