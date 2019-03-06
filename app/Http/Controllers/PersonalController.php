<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personal;
use App\History;
use App\Http\Requests\StorePersonalRequest;
use Illuminate\Validation\Rule;
use Validator;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function store(StorePersonalRequest $request)
    {
        Validator::make($request->all(), [
            'p00' => [
                'required',
                'numeric',
                'digits:6',
                Rule::unique('personals')->ignore($request->id),
            ]
        ])->validate();
        
        $personal = Personal::create($request->all());

        History::create(array_merge($request->all(), ['personal_id' => $personal->id,'active' => 1]));

        return back()->with('status', 'Personal creado con éxito');


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


        $date_rol_out = strtotime ('-1 day',strtotime($request->date_rol_in));
        $date_rol_out = date ('Y-m-j' , $date_rol_out);

        $personal = Personal::findOrFail($request->id);

        $personal->update($request->only(['p00', 'name', 'phone', 'email', 'date_in', 'date_out']));

        $act = History::updateOrCreate(
            ['personal_id' => $request->id,
            'oficina_id' => $id,
            'rol_id' => $request->rol_id,
            'active' => 1],
            ['personal_id' => $request->id,
            'oficina_id' => $id,
            'rol_id' => $request->rol_id,
            'active' => 1,
            'date_rol_in' => $request->date_rol_in]
        );

        if(!$act->id){
            History::where('personal_id', $request->id)
                    ->where('active', 1)
                    ->update(['active' => 0, 'date_rol_out' => $date_rol_out]);
        };

        $act->save();

        return back()->with('status', 'Personal actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personal = Personal::findOrFail($id);

        $personal->delete();

        return back()->with('status', 'Registro eliminado con éxito');
    }
}
