<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table ='pedidos';

    protected $fillable = [
            "codigo",
            "codigoliteral",
            "lugar",
            "fecha",
            "hora",
            "codigoproyecto",
            "proyecto",
            "solicitante",
            "justificacion",
            "precio",
            "total",
            "literal",
            "autorizado",
            "vistobueno",
            "observacion",
            "estado",
            "etapa",
            "activo",
            "saldo",
            "diferencia",
            "user_id",
    ];
    protected $hidden =['created_at','updated_at'];
    
    public function depositos(){
        return $this->hasMany(Deposito::class);
    }
    public function Detalles(){
        return $this->hasMany(Detalle::class);
    }
    public function fotos(){
        return $this->hasMany(Fotos::class);
    }
  //relacion uno a muchos inversa
  public function user(){
    return $this->belongsTo('App\Models\User');
 }



 
  public function proyecto(){
    return $this->belongsTo('App\Models\Proyecto');
 }


}
