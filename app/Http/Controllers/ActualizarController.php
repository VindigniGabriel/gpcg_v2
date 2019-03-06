<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RxpCollective;
use App\Indicador;
use App\Oficina;

class ActualizarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        foreach ($request->all() as $key => $value) {
            if ($key != '_method' && $key != '_token') {
                if ($value >= Indicador::where('name', $key)->first()->max) {
                    
                    return '30';
                }elseif(Indicador::where('name', $key)->first()->med <= $value && $value < Indicador::where('name', $key)->first()->max){
                    return '25';
                }elseif(Indicador::where('name', $key)->first()->min <= $value && $value < Indicador::where('name', $key)->first()->med){
                    return '20';
                }elseif($value < Indicador::where('name', $key)->first()->min){
                    return '0';
                };
                    
            }
        }
        
        /*for ($i=0; $i < count($request->id); $i++) { 
            $rxpcollective = RxpCollective::where('id', $request->id[$i])->first();
            $indicador = Indicador::where('id', $rxpcollective->indicador_id)->first();
            if ($request->porcentaje[$i] >= $indicador->max) {
                $porcentaje = $rxpcollective->rol->indicadors->where('id', $rxpcollective->indicador_id)->first()->pivot->max;
            }elseif($indicador->med <= $request->porcentaje[$i] && $request->porcentaje[$i] < $indicador->max){
                $porcentaje = $rxpcollective->rol->indicadors->where('id', $rxpcollective->indicador_id)->first()->pivot->med;
            }elseif($indicador->min <= $request->porcentaje[$i] && $request->porcentaje[$i] < $indicador->med){
                $porcentaje = $rxpcollective->rol->indicadors->where('id', $rxpcollective->indicador_id)->first()->pivot->min;
            }elseif($request->porcentaje[$i] < $indicador->min){
                $porcentaje = 0;
            };


            RxpCollective::where('id', $request->id[$i])
                        ->update(['porcentaje' => $porcentaje]);
        }*/

        return back();
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
