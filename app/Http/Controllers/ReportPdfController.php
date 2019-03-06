<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RxpCollective;
use App\RxpIndividual;
use App\Indicador;
use App\RxpCollectiveRols;
use App\Oficina;
use App\RxpBusiness;
use App\Month;

class ReportPdfController extends Controller
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
        $mes = Month::find($request->mesId);
        $rxpColective = RxpCollective::where('month_id', $request->mesId)->where('oficina_id', $request->oficinaId)->get();
        $rxpIndividual = RxpIndividual::where('month_id', $request->mesId)->whereIn('history_id', Oficina::find($request->oficinaId)->history->pluck('id') )->get();
        $iIndividuals = Indicador::whereIn('id', $rxpIndividual->pluck('indicador_id'))->get();
        $empresarial = RxpBusiness::where('month_id', $request->mesId)->first()->porcentaje;
        $collectiveName = Indicador::whereIn('id', $rxpColective->pluck('indicador_id'))->pluck('name');
        $collectiveValue = $rxpColective->pluck('porcentaje');
        $individualName = $iIndividuals->pluck('name');
        $oficina = Oficina::find($request->oficinaId);

        $valueIndividual = [];

        foreach ($rxpIndividual->unique('history_id') as $key => $in) {
            $value = [];
            $sumI = $in->where('history_id',$in->history->id)->where('month_id', $request->mesId)->sum('porcentaje');
            $sumC = RxpCollectiveRols::whereIn('rxp_collective_id', $rxpColective->pluck('id'))->where('rol_id', $in->history->rol->id)->sum('porcentaje_value');
            $total = $sumC + $sumI +$empresarial;
            $value [] = $in->history->rol->sumaEsquema($in->history->rol->id, $total);
            $value [] = $in->history->personal->p00;
            $value [] = $in->history->personal->name;
                foreach ($iIndividuals as $key => $i) {
                    $value [] = ($rxpIndividual->where('history_id',$in->history->id)->where('indicador_id', $i->id)->first()) ? $rxpIndividual->where('history_id',$in->history->id)->where('indicador_id', $i->id)->first()->porcentaje_value : "-" ;
                }
            $value [] = number_format($sumI,2);
            $value [] = number_format($sumC,2);
            $value [] = number_format($total,2);
            
            $valueIndividual [] = $value;
        };

        $pdf = collect([
            'name' => $oficina->name,
            'gerencia' => $oficina->gerencia->name,
            'direccion' => $oficina->gerencia->direccion->name,
            'supervisores' => $oficina->supervisors,
            'empresarial' => $empresarial,
            'nameCollective' => $collectiveName,
            'valueCollective' => $collectiveValue,
            'nameIndividual' => $individualName,
            'valueIndividual' => $valueIndividual,
            'mes'=> $mes->month
        ]);

        return $pdf;

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
