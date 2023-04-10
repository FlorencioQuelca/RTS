<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $table ='fotos';

    protected $fillable = [
        "tipo",
        "items",
        "numero",
        "razon",
        "nit",
        "empresa",
        "observacion",
        "foto_url",
        "fecha",
        "hora",
        "total",
        "subtotal",
        "literal",
        "pedido_id"
    ];
    protected $hidden =['created_at','updated_at'];

   

  //relacion uno a muchos inversa
  public function pedido(){
    return $this->belongsTo('App\Models\Pedido');
 }
 
}
