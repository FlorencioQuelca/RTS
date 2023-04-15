<?php

namespace App\Http\Controllers;

use App\Models\Detalle;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDetalleRequest;
use App\Http\Requests\UpdateDetalleRequest;

class DetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalle =Detalle::all();
        return \response()->json($detalle,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDetalleRequest $request)
    {
        $maxValue = Detalle::max('num');
        $detalle=new Detalle();
         if( is_numeric($maxValue) && $maxValue>0){
                 $detalle->num=$maxValue+1;
            }else{
                $detalle->num=1;
            }
        $detalle->estado="ACTIVO";
        $detalle->unidad=$request->unidad;
        $detalle->pedido_id=$request->pedido_id;
        $detalle->cantidadrecibo=$request->cantidadrecibo;
        $detalle->detallerecibo=$request->detallerecibo;
        $detalle->preciorecibo=$request->preciorecibo;
        $detalle->subtotalrecibo=$request->subtotalrecibo;
        $detalle->save();
        return \response()->json(['res'=> true, 'message'=>'insertado correctamente'],200);
       // Detalle::create($request->all());
       // return \response()->json(['res'=> true, 'message'=>'insertado correctamente'],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Detalle $detalle)
    {
      //  return $detalle;
        return \response()->json($proyecto,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detalle $detalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetalleRequest $request, Detalle $detalle)
    {
        $detalle->update($request->all());
        return \response()->json(['res'=> true, 'message'=>'modificado  correctamente'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detalle $detalle)
    {
        try{
            $detalle->delete();
          //  ProyectoPersona::destroy($id);
            return \response()->json(['res'=> true, 'message'=>'Eliminado Correctamente'],200);
        }
        catch(\Exception $e){
            return \response()->json(['res'=> false, 'message'=>$e->getMessage()],200);
        }
    }
}
