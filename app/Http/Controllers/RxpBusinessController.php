<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Month;
use App\RxpBusiness;
use App\Indicador;

class RxpBusinessController extends Controller
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
        $month = Month::find($id);
        $business = RxpBusiness::where('month_id', $month->id)->first();
        $indicador = Indicador::where('name', 'Empresarial')->first();

        return view('rxp.empresarial', [
            'month' => $month,
            'business' => $business,
            'indicador' => $indicador
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
        $indicador = Indicador::find($request->id);

        switch ($request->ajuste) {
            case 2:
                $porcentaje = $indicador->min;
                break;
            
            case 3:
                $porcentaje = $indicador->med;
                break;

            case 4:
                $porcentaje = $indicador->max;
                break;
            
            default:
                $porcentaje = 0;
                break;
        }

        RxpBusiness::where('month_id', $id)
                    ->update(['porcentaje' => $porcentaje]);

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
