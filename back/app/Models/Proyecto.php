<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table ='proyectos';

    protected $fillable = [
        "codigo",
        "nombre",
        "lugar",
        "estado",
        "observacion",
       
    ];
    protected $hidden =['created_at','updated_at'];

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }
}
