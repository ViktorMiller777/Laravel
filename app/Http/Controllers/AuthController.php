<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    // FUNCION PARA REGISTRAR
    public function register(Request $request){
        $rule = [
            'name' => 'required|string',
            'lastname_p' => 'required|string',
            'lastname_m' => 'required|string',
            'age' => 'required|numeric',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|string',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
        ];
        $validator = Validator::make($request->input(),$rule);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->all()
            ],400);
        }
        $newUser = new User($request->input());
        $newUser->save();
        return response()->json([
            'status' => true,
            'message' => 'Usuario creado',
            'token' => $newUser->createToken('tokenSP')->plainTextToken
        ],200);
    }

    //FUNCION PARA INICIAR SESION
    public function login(Request $request){
        $rule = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->input(),$rule);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->all()
            ],400);
        }
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'status' => false,
                'message' => 'No autorizado'
            ],401);
        }
        $user = User::where('email',$request->email)->first();
        $token = $user->createToken('tolken')->plainTextToken;
        return view('dashboard', ['token' => $token]);
    }

    // FUNCION PARA CERRAR SESION
    public function logout(){
        auth()->user()->tokens()->delete(); 
        return response()->json([
            'status' => true,
            'message' => 'Sesion cerrada'
        ],200);
    }
}
