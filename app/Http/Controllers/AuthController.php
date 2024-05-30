<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
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
        return redirect('/home/login');
    }

    //FUNCION PARA INICIAR SESION
    // public function login(Request $request){
    //     $rule = [
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ];
    //     $validator = Validator::make($request->input(),$rule);
    //     if($validator->fails()){
    //         return response()->json([
    //             'status' => false,
    //             'error' => $validator->errors()->all()
    //         ],400);
    //     }
    //     if(!Auth::attempt($request->only('email','password'))){
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'No autorizado'
    //         ],401);
    //     }
    //     $user = User::where('email',$request->email)->first();
    //     return redirect('/dashboard');
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //El codigo de abajo es para verificar si el correo existe en la base de datos
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password) && $user->active == '1') {
            // Aqui se genera un token aleatorio
            $token = Str::random(80);
            //forceFill es un metodo de laravel que me permite asignar un valor a un atributo de un modelo
            $user->forceFill([
                //el sha256 es un algoritmo de encriptacion y lo que hace aqui es que encripta el token
                'api_token' => hash('sha256', $token),
            ])->save();

            // Almacena el token en una cookie segura
            $cookie = cookie('api_token', $token, 80);

            //el withCookie es un metodo de laravel que me permite enviar una cookie al navegador
            return redirect('/dashboard')->withCookie($cookie);
        }
        

        return redirect()->back()->with('error', 'Correo electrónico o contraseña incorrectos. Por favor, inténtalo de nuevo.');
    }
    

    // FUNCION PARA CERRAR SESION
    public function logout()
    {
        // Aqui has de cuenata que quito la sesion del usuario
        Auth::logout();

        // elimion la cookie con la qe se autentico el usuario
        $cookie = Cookie::forget('api_token');

        // Y aqui mandi al usuario a la pagina de inicio con la cookie eliminada
        return redirect('/home')->withCookie($cookie);

    }
}
