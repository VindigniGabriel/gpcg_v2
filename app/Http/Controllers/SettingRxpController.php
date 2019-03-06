<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingRxp;
use App\Http\Requests\SettingRxpRequest;
use Illuminate\Validation\Rule;
use Validator;

class SettingRxpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = SettingRxp::all();

        return view('settingrxp.index', [
            'settings' => $settings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRxpRequest $request)
    {
        Validator::make($request->all(), [
            'name' => [
                Rule::unique('setting_rxps')->ignore($request->id),
            ]
        ])->validate();

        SettingRxp::create($request->all());

        return back()->with('status', 'Ajuste personalizado ha sido agregado');
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
        for ($i=0; $i < count($request->id); $i++) { 
            SettingRxp::where('id', $request->id[$i])
            ->update(['goal_id' => $request->goal_id[$i]]);
        }

        return back()->with('status', 'Ajustes personalizados has sido actualizados.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personal = SettingRxp::findOrFail($id);

        $personal->delete();

        return back()->with('status', 'Ajuste Personalizado "'.$personal->name.'" eliminado con éxito');
    }
}
