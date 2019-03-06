<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indicador;
use App\Rol;
use App\IndicadorRol;
use App\IndicadorTipo;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\StoreIndicadorRolsRequets;

class IndicadorRolController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indicadores = Indicador::whereNotIn('name', ['Empresarial'])->get();
        $rols = Rol::all();
        $indicadorTipos = IndicadorTipo::get();

        return view('indicadorrols.index', [
            'indicadores' => $indicadores,
            'rols' => $rols,
            'indicadorTipos' => $indicadorTipos
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
    public function store(StoreIndicadorRolsRequets $request)
    {
        //return $request->rol_id;
        
        IndicadorRol::create(
        $request->all()
        );
        
        return back()->with('status', 'Indicador agregado a rol con éxito!');
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
    public function update(StoreIndicadorRolsRequets $request, $id)
    {

        //return $request->all();
      foreach ($request->max as $index => $max) {

        IndicadorRol::where('rol_id', $id)
          ->where('indicador_id', $request->indicador_id[$index])
          ->update(['max' => $max, 
                    'med' => $request->med[$index], 
                    'min' => $request->min[$index],
                    'indicador_tipo_id' => $request->indicador_tipo_id[$index]
                    ]);

      }

      return back()->with('status', 'Indicador actualizado con éxito!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $indicadorrol = IndicadorRol::find($id);

        $indicadorrol->delete();

        return back()->with('status', 'Indicador eliminado del rol con éxito!');
    }
}
