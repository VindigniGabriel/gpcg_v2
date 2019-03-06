<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficina;
use App\Direccion;
use App\Gerencia;
use App\OficinaTipo;
use App\Rol;
use App\Turno;
use App\Exports\OficinaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreOficinaRequest;

class OficinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oficinas = Oficina::orderBy('name', 'asc')->get();
        $direcciones = Direccion::all();
        $gerencias = Gerencia::all();
        $oficinaTipos = OficinaTipo::all();
        $rols = Rol::all();

        return view('/oficinas.index', [
            'oficinas' => $oficinas,
            'direcciones' => $direcciones,
            'gerencias' => $gerencias,
            'oficinaTipos' => $oficinaTipos,
            'rols' => $rols
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
    public function store(StoreOficinaRequest $request)
    {
        Oficina::create($request->all());

        return back()->with('status', 'Oficina creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $oficina = Oficina::find($id);
        $direcciones = Direccion::all();
        $oficinaTipos = OficinaTipo::all();
        $rols = Rol::orderBy('id', 'desc')->get();
        $turnos = Turno::all();

        return view('/oficinas.show', [
            'oficina' => $oficina,
            'direcciones' => $direcciones,
            'oficinaTipos' => $oficinaTipos,
            'rols' => $rols,
            'turnos' => $turnos
        ]);
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
    public function update(StoreOficinaRequest $request, $id)
    {
       $oficina = Oficina::findOrFail($request->id);

       $oficina->update($request->all());

       return back()->with('status', 'Oficina actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oficina = Oficina::find($id);

        $oficina->delete();

        return back()->with('status', 'Oficina eliminada con éxito');
    }

    public function export() 
    {
        return Excel::download(new OficinaExport, 'oficinas.xlsx');
    }
}
