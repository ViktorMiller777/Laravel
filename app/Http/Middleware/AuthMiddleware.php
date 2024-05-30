<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) //Aqui le paso requets para que me permita acceder a la informacion de la peticion y closure para que me permita continuar con la peticion
    {
        if (Auth::check()) {
            // Si el usuario ya está autenticado, permite que la solicitud continúe
            return $next($request);
        }
        //Aqui lo que ahgao es verificar que el navegador tenga una cookie con el token
        $token = $request->cookie('api_token');

        if ($token && $user = User::where('api_token', hash('sha256', $token))->first()) {
            // Autentica al usuario
            Auth::login($user);
        } else {
            // Si el token no es válido, redirige al usuario a la página de inicio de sesión
            return redirect('/home/login');
        }
        //Aqui abajo le pongo nnext porque quiero que continue con la peticion
        return $next($request);
    }
}
