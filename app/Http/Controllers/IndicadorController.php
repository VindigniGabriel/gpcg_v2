<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indicador;
use App\Http\Requests\StoreIndicadorRequets;
use Illuminate\Validation\Rule;
use Validator;

class IndicadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $indicadores = Indicador::all();

       return view('indicadores.index', [
            'indicadores' => $indicadores
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
    public function store(StoreIndicadorRequets $request)
    {
        Validator::make($request->all(), [
            'name' => [
                'required',
                'regex:/^[a-zA-Z ]+$/',
                Rule::unique('indicadors')->ignore($request->id),
            ]
        ])->validate();
        Indicador::create($request->all());
        return back()->with('status', 'Indicador creado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(StoreIndicadorRequets $request, $id)
    {
        $indicador = Indicador::find($request->id);
        $indicador->update($request->all());
        return back()->with('status', 'Indicador actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $indicador = Indicador::find($id);

        $indicador->delete();

        return Back()->with('status', 'Indicador eliminado con éxito!');
    }
}
