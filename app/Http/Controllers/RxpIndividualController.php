<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Month;
use App\Indicador;
use App\Personal;
use App\RxpIndividual;
use App\RxpCollective;
use App\Rol;
use App\History;
use App\Direccion;
use App\RxpCollectiveRols;
use App\Oficina;
use App\AverageOperatingTime;
use App\RxpBusiness;
use App\SettingRxp;

class RxpIndividualController extends Controller
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
        $history_id = RxpIndividual::all()->where('month_id', $id)->unique('history_id')->pluck('history_id');
        $indicadorsI_id = RxpIndividual::all()->where('month_id', $id)->unique('indicador_id')->pluck('indicador_id');
        $personals = History::whereIn('id', $history_id)->get();
        $indicadorsIndividuals = Indicador::whereIn('id', $indicadorsI_id)->get();
        $month = Month::find($id);
        $collective = RxpCollective::where('month_id', $id)->get();
        $rols = Rol::all();
        $direccions = Direccion::all();
        $empresarial = RxpBusiness::where('month_id', $id)->first()->porcentaje;
        $settings = SettingRxp::all();
        $rxpcollectiverols = RxpCollectiveRols::whereIn('rxp_collective_id', $collective->pluck('id'))->get();

        return view('rxp.individuales',
        [
            'personals' => $personals,
            'month' => $month,
            'indicadorsIndividuals' => $indicadorsIndividuals,
            'collective' => $collective,
            'direccions' => $direccions,
            'rxpcollectiverols' => $rxpcollectiverols,
            'empresarial' => $empresarial,
            'rols' => $rols,
            'settings' => $settings
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
        
        $personal = Personal::find($request->personal_id);

        $rxp = RxpIndividual::whereIn('history_id', $personal->history->pluck('id'))
                            ->where('month_id', $id)
                            ->get();

        foreach ($request->all() as $key => $value) {
            if (Indicador::where('name', $key)->first()) {

                $indicador_id = Indicador::where('name', $key)->first()->id;

                $indicador = Indicador::where('name', $key)->get();

                if ($value >= $indicador->first()->max) {

                    $porcentaje = $personal->history->where('active', 1)->first()->rol->indicadors->where('id', $indicador_id )->first()->pivot->max; 

                }elseif($indicador->first()->med <= $value && $value < $indicador->first()->max){
                    
                    $porcentaje = $personal->history->where('active', 1)->first()->rol->indicadors->where('id', $indicador_id )->first()->pivot->med; 

                }elseif($indicador->first()->min <= $value && $value < $indicador->first()->med){
                    
                    $porcentaje = $personal->history->where('active', 1)->first()->rol->indicadors->where('id', $indicador_id )->first()->pivot->min; 

                }elseif($value < $indicador->first()->min){

                    $porcentaje = 0;

                };

                    $rxp->where('indicador_id', $indicador_id )->first()->update(['porcentaje_value' => $value, 'porcentaje' => $porcentaje]);
                    
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

    public function mostrarModal($personal_id, $month_id)
    {
        $history = History::where('personal_id', $personal_id)->pluck('id');

        $individuals = RxpIndividual::whereIn('history_id', $history)
                            ->where('month_id', $month_id)
                            ->get();

        $r = $individuals->map(function ($item, $key) {

            return ['indicador' => Indicador::find($item->indicador_id)->name,
                    'value' => $item->porcentaje_value,
                    'name' => Personal::find($item->history->personal_id)->name,
                    'p00' => Personal::find($item->history->personal_id)->p00,
                    'oficina' => Oficina::find($item->history->oficina_id)->name,
                    'time' => $time = (AverageOperatingTime::where('rxp_individual_id', $item->id)->first()) ? AverageOperatingTime::where('rxp_individual_id', $item->id)->first()->time : 0,
                    'tmo' => Oficina::find($item->history->oficina_id)->tmo,
                    'rol' => Rol::find($item->history->rol_id)->description];
        });

        return $r;
        
    }
}
