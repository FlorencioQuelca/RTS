<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;
    protected $table ='detalles';

    protected $fillable = [
        "num",
        "unidad",
        "categoria",
        "observacion",
        "estado",
        "cantidadrecibo",
        "detallerecibo",
        "preciorecibo",
        "subtotalrecibo",

        "cantidadfactura", 
        "detallefactura",
        "preciofactura",
        "subtotalfactura",
        "pedido_id"
          
    ];
    protected $hidden =['created_at','updated_at'];

  //relacion uno a muchos inversa
  public function pedido(){
    return $this->belongsTo('App\Models\Pedido');
 }
 
}
