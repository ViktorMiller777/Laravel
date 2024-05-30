<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class MapaController extends Controller
{
    public function mapaUnico($id){

        $user = User::find($id);
        return view('mapa', ['user'=> $user]);
    }

    public function mapaCompleto(){
        $users = User::all();
        return view('mundo',['users' => $users]);
    }
}
