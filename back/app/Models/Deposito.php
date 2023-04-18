<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;

    protected $table ='depositos';

    protected $fillable = [
        "deposito",
        "glosa",
        "descripcion",
        "moneda",
        "monto",
        "literal",
        "origen",
        "destino",
        "fecha",
        "hora",
        "numerodocumento",
        "observacion",
        "foto_url",
        "pedido_id"
    ];
    protected $hidden =['created_at','updated_at'];

           
  //relacion uno a muchos inversa
  public function pedido(){
    return $this->belongsTo('App\Models\Pedido');
 }
}
