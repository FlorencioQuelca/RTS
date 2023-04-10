<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFotoRequest;
use App\Http\Requests\UpdateFotoRequest;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
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
    public function store(StoreFotoRequest $request)
    {
        Foto::create($request->all());
        return \response()->json(['res'=> true, 'message'=>'insertado correctamente'],200);
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Foto $foto)
    {
        
        //return $foto;
        return \response()->json($foto,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFotoRequest $request, Foto $foto)
    {
        $foto->update($request->all());
        return \response()->json(['res'=> true, 'message'=>'modificado  correctamente'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foto $foto)
    {
        try{
            $foto->delete();
          //  ProyectoPersona::destroy($id);
            return \response()->json(['res'=> true, 'message'=>'Eliminado Correctamente'],200);
        }
        catch(\Exception $e){
            return \response()->json(['res'=> false, 'message'=>$e->getMessage()],200);
        }
    }
}
