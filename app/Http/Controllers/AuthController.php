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

         // 1️⃣ Obtener solo el user_name (y una contraseña fija para que Auth::attempt() funcione)
        $credentials = [
            'user_name' => $request->user_name,
            'password' => '123123123' 
        ];

        // 2️⃣ Intenta autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt($credentials)) {
            
            // 3️⃣ Si la autenticación es exitosa, obtiene el usuario de la base de datos
            $user = User::where('user_name', $credentials['user_name'])->first();

            // 4️⃣ Verifica si el usuario ha completado sus datos personales
            if($user->departamento != null && $user->distrito != null && $user->codigo_postal != null && $user->celular != null) {
                
                // 5️⃣ Si todos los datos están completos, redirige a la página de multas
                return redirect()->route('administrado.multa.index');
            
            } else {
                // 6️⃣ Si falta algún dato personal, redirige a la página de perfil para que los complete
                return redirect()->route('perfil');
            }
        }

        // 7️⃣ Si la autenticación falla, devuelve un mensaje de error
        return back()->withErrors([
            'user_name' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);

        
    }

    public function loginFiscalizador(Request $request)
    {
        // 1️⃣ Obtiene los datos del formulario
        $credentials = $request->only('user_name', 'password'); 

        // 2️⃣ Intenta autenticar al usuario
        if (Auth::attempt($credentials)) {
            
            // 3️⃣ Redirige al usuario a la lista de usuarios
            return redirect()->route('usuarios.index');
        }

        // 4️⃣ Si la autenticación falla, muestra un mensaje de error
        return back()->withErrors([
            'user_name' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }








}
