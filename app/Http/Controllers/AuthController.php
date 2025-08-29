<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // CERRAR SESION....
    public function logout()
    {
        Auth::logout();  
        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('user_name', 'password'); 

        if (Auth::attempt($credentials)) {
            
            return redirect()->route('usuarios.index');
        }

        return back()->withErrors([
            'user_name' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);

        
    }


}
