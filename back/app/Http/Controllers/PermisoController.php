<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorepermisoRequest;
use App\Http\Requests\UpdatepermisoRequest;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Permiso::all();
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
    public function store(StorepermisoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(permiso $permiso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(permiso $permiso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepermisoRequest $request, permiso $permiso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(permiso $permiso)
    {
        //
    }
}
