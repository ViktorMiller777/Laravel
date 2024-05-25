<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
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
            'latitude' => 'numeric',
            'longitude' => 'numeric',
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
            'latitude' => 18,
            'longitude' => 3,
            // 'latitude' => $request->latitude,
            // 'longitude' => $request->longitude,
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

    public function login(Request $request){

        $credenciales = $request->only('email','password');

        if(Auth::attempt($credenciales)){

            $user = Auth::user();

            $token = $user->createToken('auth_token')->plainTextToken;

            return redirect()->route('dashboard')->with('token',$token);

        }else{
            return back()->withErrors(['message' => 'Credenciales incorrectas.'])->withInput();
        }
    }

    public function logout(){
        Auth::logout();

        return view('login');
    }
}
