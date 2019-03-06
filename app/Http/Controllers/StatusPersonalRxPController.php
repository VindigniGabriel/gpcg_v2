<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
use App\Month;
use App\RxpIndividual;
use App\RxpCollective;
use App\RxpCollectiveRols;
use App\Oficina;
use App\Personal;
use App\Http\Requests\StoreOficinaRolRequest;
use App\Http\Requests\StorePersonalRequest;
use Illuminate\Validation\Rule;
use Validator;

class StatusPersonalRxPController extends Controller
{
    public function show($id, $oficina)
    {
        $oficinas =  Oficina::all();
        $month = Month::find($id);
        $office = Oficina::find($oficina);
        $history = History::where('oficina_id', $oficina)->pluck('id');
        $personalOc = RxpIndividual::where('month_id', $id)
                                            ->whereIn('history_id', $history)
                                            ->get();

        return view('statuspersonalrxp.index', [
            'personalOc' => $personalOc,
            'month' => $month,
            'office' => $office,
            'oficinas' => $oficinas,
        ]);
    }



    public function store(StoreOficinaRolRequest $request)
    {
            $old = History::where('personal_id', $request->personalId)
                    ->where('active', 1)->first();
                
            $date_rol_out = strtotime ('-1 day',strtotime($request->fecha));
            $date_rol_out = date ('Y-m-j' , $date_rol_out);

            $old->active = '0';
                    
            $old->save();

            $old->date_rol_out = $date_rol_out;

            $old->save();

            $new = History::create(
                ['personal_id' =>  $request->personalId,
                'oficina_id' => $request->oficina,
                'rol_id' => $request->rol,
                'date_rol_in' => $request->fecha,
                'active' => 1]
            );

            RxpIndividual::whereIn('history_id', History::where('personal_id', $request->personalId)->pluck('id'))
            ->where('month_id', $request->month)->get()->each->delete();
    
            foreach ($new->rol->indicadors->where('pivot.indicador_tipo_id', 1) as $key => $indicador) {
                RxpIndividual::Create([
                    'history_id' => $new->id,
                    'month_id' => $request->month,
                    'indicador_id' => $indicador->id
                ]);
            };


            foreach (Oficina::all() as $oficina) {
                foreach ($oficina->rols as $rol) {
                    foreach ($rol->indicadors->where('pivot.indicador_tipo_id', 2) as $indicador) {
                        $collective = RxpCollective::firstOrCreate(
                            [
                                'indicador_id' => $indicador->id,
                                'oficina_id' => $oficina->id,
                                'month_id' => $request->month
                            ],
                            [
                                'indicador_id' => $indicador->id,
                                'oficina_id' => $oficina->id,
                                'month_id' => $request->month
                            ]
                        );

                        RxpCollectiveRols::firstOrCreate(
                            [
                                'rxp_collective_id' => $collective->id,
                                'rol_id' => $rol->id
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

        return back()->with('status', 'Transferencia procesada con éxito!');
    }

    public function update(StorePersonalRequest $request, $id)
    {
        Validator::make($request->all(), [
            'p00' => [
                'required',
                'numeric',
                'digits:6',
                Rule::unique('personals')->ignore($request->id),
            ]
        ])->validate();

        $personal = Personal::findOrFail($request->id);

        $personal->update($request->only(['p00', 'name', 'phone', 'email', 'date_in', 'date_out']));

        $old = History::where('personal_id', $request->id)
                ->where('active', 1)->first();

        if($old->rol_id != $request->rol_id)
        {

        $date_rol_out = strtotime ('-1 day',strtotime($request->date_in));
        $date_rol_out = date ('Y-m-j' , $date_rol_out);

        $old->active = '0';
                
        $old->save();

        $old->date_rol_out = $date_rol_out;

        $old->save();

        $new = History::create(
            ['personal_id' =>  $request->id,
            'oficina_id' => $id,
            'rol_id' => $request->rol_id,
            'date_rol_in' => $request->date_in,
            'active' => 1]
        );

        RxpIndividual::where('history_id', $old->id)
        ->where('month_id', $request->month)->get()->each->delete();

        foreach ($new->rol->indicadors->where('pivot.indicador_tipo_id', 1) as $key => $indicador) {
            RxpIndividual::Create([
                'history_id' => $new->id,
                'month_id' => $request->month,
                'indicador_id' => $indicador->id
            ]);
        };
        
        foreach (Oficina::all() as $oficina) {
            foreach ($oficina->rols as $rol) {
                foreach ($rol->indicadors->where('pivot.indicador_tipo_id', 2) as $indicador) {
                    $collective = RxpCollective::firstOrCreate(
                        [
                            'indicador_id' => $indicador->id,
                            'oficina_id' => $oficina->id,
                            'month_id' => $request->month
                        ],
                        [
                            'indicador_id' => $indicador->id,
                            'oficina_id' => $oficina->id,
                            'month_id' => $request->month
                        ]
                    );

                    RxpCollectiveRols::firstOrCreate(
                        [
                            'rxp_collective_id' => $collective->id,
                            'rol_id' => $rol->id
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

        return back()->with('status', 'Personal actualizado con éxito');
    }
}
