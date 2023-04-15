<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedido = Pedido::with(['proyecto','user','depositos','fotos','detalles'])->orderByDesc('id')->get();
        //$pedido = Pedido::all();
        return \response()->json($pedido, 200);

    }

    public function pedidoid(Pedido $pedido)
    {
        $pedido =Pedido::with(['proyecto','user','depositos','fotos','detalles'])
                            ->orWhere('id', '=', $pedido->id)->get();

        return \response()->json($pedido,200);
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
    public function store(StorePedidoRequest $request)
    {
       $maxValue = Pedido::max('codigo');
        $pedido=new Pedido();
         if( is_numeric($maxValue) && $maxValue>0){
                 $pedido->codigo=$maxValue+1;
            }else{
                $pedido->codigo=1;
            }
        $pedido->fecha=date('Y-m-d');
        $pedido->hora=date('H:i:s');
        $pedido->etapa="NUEVO";
        $pedido->estado="ACTIVO";
        $pedido->proyecto_id=$request->proyecto_id;
        $pedido->user_id=$request->user_id;
        $pedido->justificacion=$request->justificacion;
        $pedido->save();
        return \response()->json(['res'=> true, 'message'=>'insertado correctamente'],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        return $pedido;
        return \response()->json($pedido,200);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    { 
        $pedido->justificacion=$request->justificacion;
        $pedido->proyecto_id=$request->proyecto_id;
       // $pedido->update($request->all());
        $pedido->save();
        return \response()->json(['res'=> true, 'message'=>'modificado  correctamente'],200);
    }
    public function pedidoedit(UpdatePedidoRequest $request, Pedido $pedido)
    { 
        $pedido->etapa=$request->etapa;
        $pedido->save();
        return \response()->json(['res'=> true, 'message'=>'modificado  correctamente'],200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        try{
            $pedido->delete();
          //  ProyectoPersona::destroy($id);
            return \response()->json(['res'=> true, 'message'=>'Eliminado Correctamente'],200);
        }
        catch(\Exception $e){
            return \response()->json(['res'=> false, 'message'=>$e->getMessage()],200);
        }
    }
}
