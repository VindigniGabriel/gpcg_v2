<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RxpIndividual;
use App\RxpCollective;
use App\Month;
use App\RxpCollectiveRols;
use App\RxpBusiness;

class MonthController extends Controller
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
        $rxpindividuals = RxpIndividual::where('month_id', $id);
        $rxpcollective = RxpCollective::where('month_id', $id);
        $rxpbusiness = RxpBusiness::where('month_id', $id);
        $rxpcollective_id = RxpCollective::where('month_id', $id)->pluck('id');
        $rxpcollectiverols = RxpCollectiveRols::whereIn('rxp_collective_id', $rxpcollective_id);
        $month = Month::where('id', $id);

        $rxpindividuals->delete();
        $rxpcollective->delete();
        $rxpcollectiverols->delete();
        $rxpbusiness->delete();
        $month->delete();

        return back()->with('status', 'Mes RxP eliminado con éxito');
    }
}
