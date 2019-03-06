<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Month;
use App\Oficina;
use App\Indicador;
use App\Personal;
use App\RxpIndividual;
use App\RxpCollective;
use App\RxpCollectiveRols;
use App\Rol;
use App\Direccion;
use App\History;
use App\IndicadorTipo;
use App\RxpBusiness;
use App\Http\Requests\StoreMonthRequets;

class ConfigurarMesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $months = Month::orderBy('month')->get();
        return view('configurarmes.index', [
            'months' => $months
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
    public function store(StoreMonthRequets $request)
    {
        $month = Month::firstOrNew([
            'month' => $request->month
        ]);

        if (!isset($month->id)) {

        $month->save();

        RxpBusiness::firstOrCreate(
            [
                'month_id' => $month->id
            ],
            [
                'month_id' => $month->id
            ]
        );

        $personals = Personal::all();

            foreach ($personals as $personal) {
                foreach ($personal->history->where('active', 1)->first()->rol->indicadors as $indicador) {
                    $personal_details_id = $personal->history->where('active', 1)->first();
                    if ($indicador->pivot->indicador_tipo_id === 1) {
                        RxpIndividual::firstOrCreate(
                            [
                                'indicador_id' => $indicador->id,
                                'history_id' => $personal_details_id->id,
                                'month_id' => $month->id
                            ],
                            [
                                'indicador_id' => $indicador->id,
                                'history_id' => $personal_details_id->id,
                                'month_id' => $month->id
                            ]
                        );
                    } elseif ($indicador->pivot->indicador_tipo_id === 2) {
                        
                        foreach (Oficina::all() as $oficina) {
                            foreach ($oficina->rols->unique() as $rol) {
                                foreach ($rol->indicadors->where('pivot.indicador_tipo_id', 2) as $indicador) {
                                    $collective = RxpCollective::firstOrCreate(
                                        [
                                            'indicador_id' => $indicador->id,
                                            'oficina_id' => $oficina->id,
                                            'month_id' => $month->id
                                        ],
                                        [
                                            'indicador_id' => $indicador->id,
                                            'oficina_id' => $oficina->id,
                                            'month_id' => $month->id
                                        ]
                                    );

                                    RxpCollectiveRols::firstOrCreate(
                                        [
                                            'rxp_collective_id' => $collective->id,
                                            'rol_id' => $rol->id,
                                            'porcentaje_value' => 0
                                        ],
                                        [
                                            'rxp_collective_id' => $collective->id,
                                            'rol_id' => $rol->id,
                                            'porcentaje_value' => 0
                                        ]
                                    );

                                };
                            };
                            
                        }
                        
                    }
                                     
                }
            }

        return back()->with('status', 'Mes creado con la configuración actual de las Oficinas y esquema RxP.');
            
        }else{

        return back()->with('warning', 'Información invalida. El mes seleccionado ya existe');
        
        };

        

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
