<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;


// Rutas de vistas
Route::get('/',function(){
    return view('login'); // Formulario login
});

Route::get('register',function(){
    return view('register'); // Formulario register
});

Route::get('dashboard',function(){
    return view('dashboard');
});

Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');

Route::post('register',[UserController::class,'register'])->name('registerpost');

Route::post('login',[UserController::class,'login'])->name('loginpost');
