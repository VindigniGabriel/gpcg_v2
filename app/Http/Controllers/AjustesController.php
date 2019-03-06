<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficina;
use App\Rol;
use App\RxpIndividual;
use App\RxpCollective;
use App\Indicador;
use App\History;
use App\RxpCollectiveRols;

class AjustesController extends Controller
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
        if (isset($request->history)) {
            switch ($request->ajuste) {
                case 2:
                    $rxpIndividuals = RxpIndividual::whereIn('history_id', $request->history)->where('month_id', $id)->get();

                    foreach ($rxpIndividuals as $key => $individual) {
                        $individual->update(['porcentaje' => $individual->history->rol->indicadors->where('id', $individual->indicador_id)->first()->pivot->min]);
                        $individual->update(['porcentaje_value' => $individual->history->rol->indicadors->where('id', $individual->indicador_id)->first()->min]);
                    };
                    
                    $ajuste = 'Meta Mínima';

                    break;

                case 3:
                    $rxpIndividuals = RxpIndividual::whereIn('history_id', $request->history)->where('month_id', $id)->get();

                    foreach ($rxpIndividuals as $key => $individual) {
                        $individual->update(['porcentaje' => $individual->history->rol->indicadors->where('id', $individual->indicador_id)->first()->pivot->med]);
                        $individual->update(['porcentaje_value' => $individual->history->rol->indicadors->where('id', $individual->indicador_id)->first()->med]);
                    };

                    $ajuste = 'Meta Media';

                    break;

                case 4:
                    $rxpIndividuals = RxpIndividual::whereIn('history_id', $request->history)->where('month_id', $id)->get();

                    foreach ($rxpIndividuals as $key => $individual) {
                        $individual->update(['porcentaje' => $individual->history->rol->indicadors->where('id', $individual->indicador_id)->first()->pivot->max]);
                        $individual->update(['porcentaje_value' => $individual->history->rol->indicadors->where('id', $individual->indicador_id)->first()->max]);
                    };

                    $ajuste = 'Meta Máxima';

                    break;
                
                default:
                    $rxpIndividuals = RxpIndividual::whereIn('history_id', $request->history)->where('month_id', $id)->get();

                    foreach ($rxpIndividuals as $key => $individual) {
                        $individual->update(['porcentaje' => 0.00]);
                        $individual->update(['porcentaje_value' => 0.00]);
                    };

                    $ajuste = 'Sin Logro';

                    break;
            }

            $individual->save();

            return back()->with('status', 'Los Indicadores Individuales del personal seleccionado ha sido ajustado a '.$ajuste);

        }

        if (isset($request->ajusteRoles)) {
        
            $selectOficinas = Oficina::all()->whereIn('name', $request->ajusteOficina)->pluck('id');
            $selectRols = Rol::all()->whereIn('name', $request->ajusteRoles);
            foreach ($selectRols as $selectRol) {
            
                $personals_id = $selectRol->personals->whereIn('oficina_id', $selectOficinas )->pluck('id');
                
                
                foreach ($selectRol->indicadors as $indicador) {
                    switch ($request->ajuste) {
                        case '1':
                            $porcentaje = 0;
                            $porcentaje_value = 0;
                            break;

                        case '2':
                            $porcentaje = $indicador->pivot->min;
                            $porcentaje_value = Indicador::find($indicador->pivot->indicador_id)->min;
                            break;

                        case '3':
                            $porcentaje = $indicador->pivot->med;
                            $porcentaje_value = Indicador::find($indicador->pivot->indicador_id)->med;
                            break;

                        case '4':
                            $porcentaje = $indicador->pivot->max;
                            $porcentaje_value = Indicador::find($indicador->pivot->indicador_id)->max;
                            break;
                    };

                    RxpIndividual::whereIn('history_id', $personals_id)
                                    ->where('indicador_id', $indicador->id)
                                    ->where('month_id', $id)
                                    ->update(array('porcentaje' => $porcentaje, 'porcentaje_value' => $porcentaje_value));

                };
            };

        return back()->with('status', 'Ajuste(s) procesado(s) con éxito!');

        };
        
        if (isset($request->ajusteIndividuales)){
            
            $Indicadores_id = Indicador::whereIn('name', $request->ajusteIndividuales)->pluck('id');

            $Oficinas =  Oficina::whereIn('name', $request->ajusteOficina)->pluck('id');

            $HistoryId = History::whereIn('oficina_id', $Oficinas)->pluck('id');

            $RxpIndividuals = RxpIndividual::whereIn('history_id', $HistoryId)
                                                ->where('month_id', $id)
                                                ->get();

            foreach ($RxpIndividuals as $RxpIndividual) {
                foreach ($RxpIndividual->history->rol->indicadors->whereIn('id', $Indicadores_id) as $indicador) {
                    if ($indicador->pivot->indicador_tipo_id === 1) {
                        switch ($request->ajuste) {
                        case '1':
                            $porcentaje = 0;
                            $porcentaje_value = 0;
                            break;

                        case '2':
                            $porcentaje = $indicador->pivot->min;
                            $porcentaje_value = Indicador::find($indicador->pivot->indicador_id)->min;
                            break;

                        case '3':
                            $porcentaje = $indicador->pivot->med;
                            $porcentaje_value = Indicador::find($indicador->pivot->indicador_id)->med;
                            break;

                        case '4':
                            $porcentaje = $indicador->pivot->max;
                            $porcentaje_value = Indicador::find($indicador->pivot->indicador_id)->max;
                            break;
                    };

                    RxpIndividual::whereIn('history_id', $HistoryId)
                                ->where('indicador_id', $indicador->id)
                                ->where('month_id', $id)
                                ->update(array('porcentaje' => $porcentaje, 'porcentaje_value' => $porcentaje_value));
                };
            };
            };

        return back()->with('status', 'Ajuste(s) procesado(s) con éxito!');

        };

        if (isset($request->ajusteColectivos)){
            
            $Indicadores_id = Indicador::whereIn('name', $request->ajusteColectivos)->pluck('id');

            $OficinasId =  Oficina::whereIn('name', $request->ajusteOficina)->pluck('id');

            $RxpCollectives = RxpCollective::whereIn('oficina_id', $OficinasId)
                                            ->whereIn('indicador_id', $Indicadores_id)
                                            ->where('month_id', $id)
                                            ->get();


            foreach ($RxpCollectives as $RxpCollective) {
                
                        switch ($request->ajuste) {
                            case '1':
                                $porcentaje = 0;

                                foreach ($RxpCollective->rols as $key => $rol) {
                                    $act = 0;
                                    $er = RxpCollectiveRols::where('rxp_collective_id', $RxpCollective->id)
                                                            ->where('rol_id', $rol->id)
                                                            ->update(['porcentaje_value' => $act]);
                    
                                };

                                break;
    
                            case '2':
                                $porcentaje = Indicador::where('id', $RxpCollective->indicador_id)->first()->min;

                                foreach ($RxpCollective->rols as $key => $rol) {
                                    $act = $rol->indicadors->where('id', $RxpCollective->indicador_id)->first()->pivot->min;
                                    $er = RxpCollectiveRols::where('rxp_collective_id', $RxpCollective->id)
                                                            ->where('rol_id', $rol->id)
                                                            ->update(['porcentaje_value' => $act]);
                    
                                };

                                break;
    
                            case '3':
                                $porcentaje = Indicador::where('id', $RxpCollective->indicador_id)->first()->med;
                                
                                foreach ($RxpCollective->rols as $key => $rol) {
                                    $act = $rol->indicadors->where('id', $RxpCollective->indicador_id)->first()->pivot->med;
                                    $er = RxpCollectiveRols::where('rxp_collective_id', $RxpCollective->id)
                                                            ->where('rol_id', $rol->id)
                                                            ->update(['porcentaje_value' => $act]);
                    
                                };

                                break;
    
                            case '4':
                                $porcentaje = Indicador::where('id', $RxpCollective->indicador_id)->first()->max;
                                
                                foreach ($RxpCollective->rols as $key => $rol) {
                                    $act = $rol->indicadors->where('id', $RxpCollective->indicador_id)->first()->pivot->max;
                                    $er = RxpCollectiveRols::where('rxp_collective_id', $RxpCollective->id)
                                                            ->where('rol_id', $rol->id)
                                                            ->update(['porcentaje_value' => $act]);
                    
                                };
                                
                                break;
                        };

            $RxpCollective->update(['porcentaje' => $porcentaje]);
                    
            };

        return back()->with('status', 'Ajuste(s) procesado(s) con éxito!');

        };

        return back()->with('warning', 'Debe seleccionar los criterios de ajustes');

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
