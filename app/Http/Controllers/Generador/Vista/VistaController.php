<?php

namespace App\Http\Controllers\Generador\Vista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VistaController extends Controller
{
    public function parqueAntonioDeLaGuerra()
    {
        return view('generador.vistas.parque_antonio_de_la_guerra');
    }
}
