<?php

namespace App\Http\Controllers\Credencial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credencial;
use App\Models\socio_token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;   // 👈 AGREGA ESTA LÍNEA
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class CredencialController extends Controller
{
    
 public function index(Request $request)
    {
        $socios = collect(DB::connection('sqlsrv_sigmum')->select("
            exec [Comercio_Informal].[sp_Socio] 
                @opc='5',
                @estado1='',
                @nombres='',
                @codigo='',
                @num_doc='',
                @sexo='',
                @id_asociacion='',
                @id_giro='',
                @id_det_giro='',
                @id_turno='',
                @id_zona='',
                @inicio='1',
                @final='15'
        "));
        $token = $request->query('token');
        if (!$token) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Token requerido. Acceso denegado.'
            ], 401);
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
            if (!$user) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Usuario no válido o token corrupto'
                ], 401);
            }

            Auth::login($user);

            dd($socios);
            // 🔹 Cada socio obtiene un QR con ruta fija
            $socios = $socios->map(function ($socio) {
                $qr = base64_encode(
                    QrCode::format('png')->size(800)->generate(
                        url("/credencial/qr/{$socio->id_socio}") // 👈 ruta fija
                    )
                );
                $socio->qr_base64 = $qr;
                return $socio;
            });

            return view('credencial.index', compact('user', 'token', 'socios'));

        } catch (JWTException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error de autenticación: ' . $e->getMessage()
            ], 401);
        }
    }



    public function getToken(Request $request)
    {
        $credentials = $request->only('user_name', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Credenciales inválidas'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'No se pudo crear el token'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'token'  => $token
        ]);
    }


     public function generarLinkTemporal($id_socio)
    {
        // Generar nuevo token temporal válido solo por 10s
        $registro = socio_token::create([
            'socio_id'   => $id_socio,
            'token'      => Str::random(40),
            'expires_at' => Carbon::now()->addSeconds(10),
        ]);

        // Redirigir a la ruta temporal
        return redirect()->to("/credencial/token/{$registro->token}");
    }


    public function showPorToken($token)
    {
        $registro = socio_token::where('token', $token)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$registro) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Token inválido o expirado'
            ], 401);
        }

        // Buscar socio en base al ID
        $socio = collect(DB::connection('sqlsrv_sigmum')->select("
            exec [Comercio_Informal].[sp_Socio] 
                @opc='5',
                @id_socio='{$registro->socio_id}'
        "))->first();

        if (!$socio) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Socio no encontrado'
            ], 404);
        }

        return view('credencial.show', compact('socio'));
    }

    

}
