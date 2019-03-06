<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficina;
use App\Rol;
use App\History;
use App\Personal;
use App\Http\Requests\StoreOficinaRolRequest;
use App\Http\Requests\UpdateOficinaRolRequest;
use App\RxpIndividual;


class ManagementPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oficinas = Oficina::all();
        $roles = Rol::all();

        return view('personal.index', [
            'oficinas' => $oficinas,
            'roles' => $roles
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
    public function store(StoreOficinaRolRequest $request)
    {
        $date_rol_out = strtotime ('-1 day',strtotime($request->fecha));
        $date_rol_out = date ('Y-m-j' , $date_rol_out);



        history::where('personal_id', $request->personalId)
                ->where('active', 1)
                ->update(['active' => 0 , 'date_rol_out' => $date_rol_out]);

        History::create(
            ['personal_id' =>  $request->personalId,
            'oficina_id' => $request->oficina,
            'rol_id' => $request->rol,
            'date_rol_in' => $request->fecha,
            'active' => 1]
        );

        return back()->with('status', 'Transferencia procesada con éxito!');
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
    public function update(UpdateOficinaRolRequest $request, $id)
    {
       
        History::where('personal_id', $request->personal)
                ->update(['active' => 0, 'date_rol_out' => $request->fecha]);

        Personal::where('id', $request->personal)
                ->update(['date_out' => $request->fecha]);

        $personal = Personal::findOrFail($request->personal);

        if(!is_null($id))
        {
            RxpIndividual::whereIn('history_id', $personal->history->pluck('id'))
                        ->where('month_id', $id)->get()->each->delete();
        }

        $personal->delete();

        return back()->with('status', 'Trabajador ha sido desincorporado con éxito!');
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
