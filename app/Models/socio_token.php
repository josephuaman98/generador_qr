<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class socio_token extends Model
{
     use HasFactory;
     
    protected $fillable = ['socio_id', 'token', 'expires_at'];
    public $timestamps = true;

   
}
