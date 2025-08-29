<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class generador extends Model
{
    protected $connection = 'sqlsrv_sigmum'; 


    use HasFactory;

    protected $fillable = [
        'area_id',
        'imagen_ruta_qr',
        'link_qr',
        'descripcion',
        'user_id',
        'estado',
        'con_logo',
    ];

    
}
