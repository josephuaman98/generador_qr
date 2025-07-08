<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class generador extends Model
{
    use HasFactory;

    protected $fillable = [
        'imagen_ruta_qr',
        'link_qr',
        'descripcion',
        'user_id',
        'estado',
    ];

    
}
