<?php

namespace App\Http\Controllers;

use App\Models\Deposito;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepositoRequest;
use App\Http\Requests\UpdateDepositoRequest;

class DepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deposito= Deposito::all();
        return \response()->json($deposito,200);
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
    public function store(StoreDepositoRequest $request)
    {
        $deposito=new Deposito();
        $deposito->fecha=date('Y-m-d');
        $deposito->hora=date('H:i:s');
        $deposito->pedido_id=$request->pedido_id;
        $deposito->deposito=$request->deposito;
        $deposito->monto=$request->monto;
        $deposito->moneda=$request->moneda;
        $deposito->origen=$request->origen;
        $deposito->destino=$request->destino;
        $deposito->numerodocumento=$request->numerodocumento;
        $deposito->observacion=$request->observacion;
        $deposito->estado="ACTIVO";
        $deposito->save();
        return \response()->json(['res'=> true, 'message'=>'insertado correctamente'],200);
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Deposito $deposito)
    {
        return \response()->json($deposito,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deposito $deposito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepositoRequest $request, Deposito $deposito)
    {
        $deposito->update($request->all());
        return \response()->json(['res'=> true, 'message'=>'modificado  correctamente'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deposito $deposito)
    {
        try{
            $deposito->delete();
            return \response()->json(['res'=> true, 'message'=>'Eliminado Correctamente'],200);
        }
        catch(\Exception $e){
            return \response()->json(['res'=> false, 'message'=>$e->getMessage()],200);
        }
    }
}
