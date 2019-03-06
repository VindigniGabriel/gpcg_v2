<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficina;
use App\Indicador;
use App\Personal;
use App\RxpIndividual;

class ResultadosRxpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $personals = Personal::all();
        
        foreach ($personals as $personal) {
            foreach ($personal->rol->indicadors as $indicador) {
                RxpIndividual::firstOrCreate([
                    'personal_id' => $personal->id, 
                    'indicador_id' => $indicador->id
                ],
                [
                    'personal_id' => $personal->id, 
                    'indicador_id' => $indicador->id
                ]);
        }} 
            


        $oficinas = Oficina::all();
        $indicadors = Indicador::all();

        return view('resultados.index',[
            'oficinas' => $oficinas,
            'indicadors' => $indicadors
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
