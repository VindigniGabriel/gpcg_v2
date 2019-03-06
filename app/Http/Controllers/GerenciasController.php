<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gerencia;
use App\Direccion;
use App\OficinaTipo;
use App\Http\Requests\StoreGerenciaRequest;

class GerenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gerencias = Gerencia::orderBy('name', 'asc')->get();
        $direcciones = Direccion::all();

        return view('gerencias.index', [
            'gerencias' => $gerencias,
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
    public function store(StoreGerenciaRequest $request)
    {
        Gerencia::create($request->all());
        
        return back()->with('status', 'Gerencia creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $direcciones = Direccion::all();
        $gerencia = Gerencia::find($id);
        $oficinaTipos = OficinaTipo::all();

        return view('gerencias.show', [
            'direcciones' => $direcciones,
            'gerencia' => $gerencia,
            'oficinaTipos' => $oficinaTipos
        ]);
    }

    public function selectgerencia($id)
    {
        //$id = Input::get('direccion');

        $gerencia = Gerencia::where('direccion_id', $id)->get();

        return response()->json($gerencia);
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
    public function update(StoreGerenciaRequest $request, $id)
    {
        $gerencia = Gerencia::findOrFail($request->id);

        $gerencia->update($request->all());

        return back()->with('status', 'Gerencia actualizada con éxito');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gerencia = Gerencia::find($id);

        $gerencia->delete();

        return back()->with('status', 'Gerencia eliminada con éxito');
    }
}
