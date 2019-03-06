<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RxpCollective;
use App\RxpBusiness;
use App\Indicador;
use App\RxpIndividual;
use App\Oficina;
use App\RxpCollectiveRols;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('report.index');
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
        $indicadors = Indicador::all();
        $rxpIndividual = RxpIndividual::where('month_id', $id)->get();
        $rxpColective = RxpCollective::where('month_id', $id)->get();

        return view('report.index',[
            'rxpColective' => $rxpColective,
            'indicadors' => $indicadors,
            'rxpIndividual' => $rxpIndividual,
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
