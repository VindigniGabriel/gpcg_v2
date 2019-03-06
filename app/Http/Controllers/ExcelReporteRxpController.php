<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Month;
use App\Indicador;
use App\RxpIndividual;
use App\RxpCollective;
use App\RxpCollectiveRols;
use App\RxpBusiness;

class ExcelReporteRxpController extends Controller
{
    public function importExportView(){

        return view('import_export');

    }

    public function exportFile($type, $id=null){

        $registro = 2;

        $indicadorId = [];

        $month = Month::find($id);

        $empresarial = RxpBusiness::where('month_id', $id)->first()->porcentaje;
        $rxpIndividuals = RxpIndividual::where('month_id', $id)->get()->unique('history_id');
        $rxpCollectives = RxPCollective::where('month_id', $id)->get();
        $rxpIndividualsIndicadors = RxpIndividual::where('month_id', $id)->get();

        $indicadorId =  array_merge($indicadorId, $rxpIndividualsIndicadors->unique('indicador_id')->pluck('indicador_id')->toArray());
        $indicadorId =  array_merge($indicadorId, $rxpCollectives->unique('indicador_id')->pluck('indicador_id')->toArray());

        $indicadorsName = Indicador::whereIn('id', $indicadorId)->pluck('name')->toArray();
        $indicadors = Indicador::whereIn('id', $indicadorId)->get();

        $colum = [
            'Logro',
            'P00',
            'Nombre',
            'Oficina'
        ];

        return \Excel::create('Reporte RxP '.$month->month , function($excel) use ($rxpIndividuals, $id, $indicadorsName, $indicadors, $rxpCollectives, $rxpIndividualsIndicadors, $registro, $empresarial) {
     
            $excel->sheet('Resultados RxP', function($sheet) use ($rxpIndividuals, $id, $indicadorsName, $indicadors, $rxpCollectives, $rxpIndividualsIndicadors, $registro, $empresarial)

            {
            
                $colum = [
                    'Pago',
                    'P00',
                    'Nombre',
                    'Oficina'
                ];

                $colum = array_merge($colum, $indicadorsName);

                $colum = array_merge($colum, ['Individual', 'Colectivo', 'Empresarial', 'Total']);

                $sheet->row(1, $colum);

                foreach ($rxpIndividuals as $rxpIndividual ){

                    $porcentajes = array();

                    $sumI = $rxpIndividualsIndicadors->where('history_id', $rxpIndividual->history_id)->first()->history->esquemaRxp->where('month_id', $id)->sum('porcentaje');
                
                    $sumC = RxpCollectiveRols::whereIn('rxp_collective_id', $rxpCollectives->where('oficina_id', $rxpIndividual->history->oficina->id)->pluck('id'))->where('rol_id', $rxpIndividual->history->rol->id)->sum('porcentaje_value');

                    $total = $sumI + $sumC + $empresarial;

                    $pago = $rxpIndividualsIndicadors->where('history_id', $rxpIndividual->history_id)->first()->history->rol->sumaesquema($rxpIndividualsIndicadors->where('history_id', $rxpIndividual->history_id)->first()->history->rol->id, $total);
                    
                    foreach ($indicadors as $indicador) {
                        
                        if ($individual = $rxpIndividual->history->rol->indicadors->where('id', $indicador->id)->first()) {
                        
                            switch ($individual->pivot->indicador_tipo_id) {
                                case 1:
                                    $porcentajes [] = $rxpIndividualsIndicadors->where('history_id', $rxpIndividual->history_id)->where('indicador_id', $indicador->id)->first()->porcentaje;
                                    break;
        
                                case 2:
                                    $porcentajes [] = $rxpCollectives->where('indicador_id', $indicador->id)->where('oficina_id', $rxpIndividual->history->oficina->id)->first()->rols->first()->pivot->porcentaje_value;
                                    break;
                                
                                default:
                                    # code...
                                    break;
                            }
                        
                        } else {
        
                            $porcentajes [] = "-" ;
        
                        }
                        
                    }  
                    
                    $personal = [
                        $pago, 
                        $rxpIndividual->history->personal->p00, 
                        $rxpIndividual->history->personal->name, 
                        $rxpIndividual->history->oficina->name
                    ];

                    $personal = array_merge($personal, $porcentajes);

                    $personal [] = $sumI;

                    $personal [] = $sumC;

                    $personal [] = $empresarial;

                    $personal [] = $total;

                    $sheet->row( $registro, $personal);

                    $registro++;
        
                };

            });






            $excel->sheet('Detalle de Logros %', function($sheet) use ($rxpIndividuals, $id, $indicadorsName, $indicadors, $rxpCollectives, $rxpIndividualsIndicadors, $registro, $empresarial)

            {
            
                $colum = [
                    'Pago',
                    'P00',
                    'Nombre',
                    'Oficina'
                ];

                $colum = array_merge($colum, $indicadorsName);

                $sheet->row(1, $colum);

                foreach ($rxpIndividuals as $rxpIndividual ){

                    $porcentajes = array();

                    $sumI = $rxpIndividualsIndicadors->where('history_id', $rxpIndividual->history_id)->first()->history->esquemaRxp->where('month_id', $id)->sum('porcentaje');
                
                    $sumC = RxpCollectiveRols::whereIn('rxp_collective_id', $rxpCollectives->where('oficina_id', $rxpIndividual->history->oficina->id)->pluck('id'))->where('rol_id', $rxpIndividual->history->rol->id)->sum('porcentaje_value');

                    $total = $sumI + $sumC + $empresarial;

                    $pago = $rxpIndividualsIndicadors->where('history_id', $rxpIndividual->history_id)->first()->history->rol->sumaesquema($rxpIndividualsIndicadors->where('history_id', $rxpIndividual->history_id)->first()->history->rol->id, $total);
                    
                    foreach ($indicadors as $indicador) {
                        
                        if ($individual = $rxpIndividual->history->rol->indicadors->where('id', $indicador->id)->first()) {
                        
                            switch ($individual->pivot->indicador_tipo_id) {
                                case 1:
                                    $porcentajes [] = $rxpIndividualsIndicadors->where('history_id', $rxpIndividual->history_id)->where('indicador_id', $indicador->id)->first()->porcentaje_value;
                                    break;
        
                                case 2:
                                    $porcentajes [] = $rxpCollectives->where('indicador_id', $indicador->id)->where('oficina_id', $rxpIndividual->history->oficina->id)->first()->porcentaje;
                                    break;
                                
                                default:
                                    # code...
                                    break;
                            }
                        
                        } else {
        
                            $porcentajes [] = "-" ;
        
                        }
                        
                    }  
                    
                    $personal = [
                        $pago, 
                        $rxpIndividual->history->personal->p00, 
                        $rxpIndividual->history->personal->name, 
                        $rxpIndividual->history->oficina->name
                    ];

                    $personal = array_merge($personal, $porcentajes);

                    $sheet->row( $registro, $personal);

                    $registro++;
        
                };

            });



        })->export($type);


    }  
}
