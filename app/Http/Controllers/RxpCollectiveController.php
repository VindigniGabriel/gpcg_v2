<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Month;
use App\Oficina;
use App\Indicador;
use App\RxpCollective;
use App\Direccion;
use App\RxpCollectiveRols;


class RxpCollectiveController extends Controller
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
        $indicadorsC_id = RxpCollective::all()->where('month_id', $id)->unique('indicador_id')->pluck('indicador_id');
        $collective = RxpCollective::where('month_id', $id)->get();
        $indicadorsCollectives = Indicador::whereIn('id', $indicadorsC_id)->get();
        $month = Month::find($id);
        $direccions = Direccion::all();
        $oficinas = Oficina::all();
        $rxpcollectiverols = RxpCollectiveRols::whereIn('rxp_collective_id', $collective->pluck('id'))->get();

        return view('rxp.colectivos',
        [
            'month' => $month,
            'direccions' => $direccions,
            'indicadorsCollectives' => $indicadorsCollectives,
            'collective' => $collective,
            'rxpcollectiverols' => $rxpcollectiverols,
            'oficinas' => $oficinas
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
    public function update(Request $request, $id)
    {
        
        
        foreach ($request->all() as $key => $value) {
            if ($key != '_method' && $key != '_token' && $key != 'oficina_id') {
                $indicador_id = Indicador::where('name', $key)->first()->id;

                $collective = RxpCollective::updateOrCreate(
                                ['oficina_id' => $request->oficina_id,
                                'indicador_id' => $indicador_id,
                                'month_id' => $id],
                                ['porcentaje' => $value]);

                if ($value >= Indicador::where('name', $key)->first()->max) {
                    
                    foreach ($collective->rols as $key => $rol) {
                        $act = $rol->indicadors->where('id', $indicador_id)->first()->pivot->max;
                        $er = RxpCollectiveRols::where('rxp_collective_id', $collective->id)
                                                ->where('rol_id', $rol->id)
                                                ->update(['porcentaje_value' => $act]);
                        $collective->save();

                    };


                }elseif(Indicador::where('name', $key)->first()->med <= $value && $value < Indicador::where('name', $key)->first()->max){
                    
                    foreach ($collective->rols as $key => $rol) {
                        $act = $rol->indicadors->where('id', $indicador_id)->first()->pivot->med;
                        $er = RxpCollectiveRols::where('rxp_collective_id', $collective->id)
                                                ->where('rol_id', $rol->id)
                                                ->update(['porcentaje_value' => $act]);
                        $collective->save();

                    };

                }elseif(Indicador::where('name', $key)->first()->min <= $value && $value < Indicador::where('name', $key)->first()->med){
                    
                    foreach ($collective->rols as $key => $rol) {
                        $act = $rol->indicadors->where('id', $indicador_id)->first()->pivot->min;
                        $er = RxpCollectiveRols::where('rxp_collective_id', $collective->id)
                                                ->where('rol_id', $rol->id)
                                                ->update(['porcentaje_value' => $act]);
                        $collective->save();
                    };

                }elseif($value < Indicador::where('name', $key)->first()->min){
                    
                    foreach ($collective->rols as $key => $rol) {
                        $act = 0;
                        $er = RxpCollectiveRols::where('rxp_collective_id', $collective->id)
                                                ->where('rol_id', $rol->id)
                                                ->update(['porcentaje_value' => $act]);
                        $collective->save();
                    };

                };
                    
            }
        }

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


    public function mostrarModal($oficina_id, $month_id)
    {
        $collectives = RxpCollective::where('month_id', $month_id)
                                    ->where('oficina_id', $oficina_id)
                                    ->get();


        $r = $collectives->map(function ($item, $key) {
            return ['indicador' => Indicador::find($item->indicador_id)->name,
                    'value' => $item->porcentaje,
                    'name' => Oficina::find($item->oficina_id)->name];
        });

        return $r;
        
    }
}
