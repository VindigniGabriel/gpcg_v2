<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Direccion;
use App\Http\Requests\StoreDireccionRequest;

class DireccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $direcciones = Direccion::orderBy('name', 'asc')->get();
        return view('direcciones.index', [
            'direcciones' => $direcciones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDireccionRequest $request)
    {
        Direccion::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $direccion = Direccion::find($id);
        $direcciones = Direccion::all();

        return view('direcciones.show', [
            'direccion' => $direccion,
            'direcciones' => $direcciones
        ])->with('status', 'Dirección creada con éxito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDireccionRequest $request, $id)
    {
        $direccion = Direccion::findOrFail($request->id);

        $direccion->update($request->all());

        return back()->with('status', 'Dirección actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $direccion = Direccion::find($id);

        $direccion->delete();

        return back()->with('status', 'Dirección eliminada con éxito');
        
    }
}
