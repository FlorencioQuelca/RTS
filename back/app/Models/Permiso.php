<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

  
    protected $table ="permisos";
    protected $fillable = [
        'nombre',
        'code',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
