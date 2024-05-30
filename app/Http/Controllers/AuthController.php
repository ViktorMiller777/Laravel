<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        $newUser = new User([
            'name' => $request->input('name'),
            'lastname_p' => $request->input('lastname_p'),
            'lastname_m' => $request->input('lastname_m'),
            'age' => $request->input('age'),
            'birthdate' => $request->input('birthdate'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'active' => '0', 
            'latitude' => '25.59887027853254',
            'longitude' => '-103.47985881534363'
        ]);

        $newUser->save();

        $this->codigo($newUser);

        return redirect('/home/correo');
        // return redirect('/home/login');
    }

    //FUNCION PARA INICIAR SESION
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password) && $user->active == '1') {
            $token = Str::random(80);
            $user->forceFill([
                'api_token' => hash('sha256', $token),
            ])->save();

            $cookie = cookie('api_token', $token, 80);

            return redirect('/dashboard')->withCookie($cookie);
        }
        
        return redirect()->back()->with('error', 'Correo electrónico o contraseña incorrectos. Por favor, inténtalo de nuevo.');
    }
    

    // FUNCION PARA CERRAR SESION
    public function logout()
    {
        Auth::logout();

        $cookie = Cookie::forget('api_token');

        return redirect('/home')->withCookie($cookie);

    }

    public function codigo(User $user)
    {
        $verificationCode = rand(1000, 9999);

        Session::put('verification_code', $verificationCode);
        Session::put('email', $user->email);

        Mail::raw("Este es tu codigo de verificacion: {$verificationCode}  protegelo con tu vida.", function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Codigo de verificacion');
        });
    }
}
