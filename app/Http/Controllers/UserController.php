<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    public function getUser()
    {
        $users = User::all();
        return view('dashboard',['users'=>$users]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'lastname_p' => 'required|string',
            'lastname_m' => 'required|string',
            'age' => 'required|numeric',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|string',
            'active' => 'string',
            'latitude' => 'string',
            'longitude' => 'string',
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $user = User::create([
            'name' => $request->name,
            'lastname_p' => $request->lastname_p,
            'lastname_m' => $request->lastname_m,
            'age' => $request->age,
            'birthdate' => $request->birthdate,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'active' => 0,
            'latitude' => 25.676997,
            'longitude' => -100.309302,
        ]);
        return view('login')->with('Success','Registro exitoso, porfavor inicia sesion.');
    }

    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json('No existe');
        }
        $user->active = !$user->active;
        $user->save();
        return ($user);
        
    }
    
    public function actualizar(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'active' => 'required|numeric|max:255',
            'latitude' => 'required|numeric|max:255',
            'longitude' => 'required|numeric|max:255',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()],401);
        }
        $user = User::find($id);
        $user->active = $request->input('active');
        $user->latitude = $request->input('latitude');
        $user->longitude = $request->input('longitude');
        $user->save();
        return redirect('/dashboard');
    }

    public function iniciarMap()
    {
        $coord = ['lat' => 25.676997, 'lng' => -100.309302];
        $zoom = 10;
    
        return view('mapa', compact('coord', 'zoom'));
    }

    
    public function verificacion(Request $request)
    {
        $inputCode = $request->input('verificationCode');

        if ($inputCode == Session::get('verification_code')) {
            $user = User::where('email', Session::get('email'))->first();
            if ($user) {
                $user->active = '1';
                $user->save();
            }
            return redirect('/home')->with('success', 'Verificación exitosa.');
        } else {
            return redirect('/home/correo')->with('error', 'El codigo de verificacion no coinciden');
        }
    }    
}
