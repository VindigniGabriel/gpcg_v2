<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personal;
use App\History;
use App\Http\Requests\StoreExcelPersonalRequest;

class ExcelPersonalController extends Controller
{
    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function importExportView(){

        return view('import_export');

    }


    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function importFile(StoreExcelPersonalRequest $request){

        if($request->hasFile('personal')){
            
            $path = $request->file('personal')->getRealPath();

            $data = \Excel::load($path)->get();

            if($data->count()){

                foreach ($data as $key => $value) {

                    $date_in = $value->fecha_ingreso;
                    $dateIn = str_replace('/', '-', $date_in);
                    $date_in = date('Y-m-d', strtotime($dateIn));

                    $date_rol_in = $value->fecha_cargo;
                    $dateRol = str_replace('/', '-', $date_rol_in);
                    $date_rol_in = date('Y-m-d', strtotime($dateRol));
                    
                    $personal = Personal::create(
                        ['p00' => $value->p00,
                        'name' => $value->nombre,
                        'email' => $value->correo,
                        'date_in'  => $date_in]
                    );

                    History::create(
                        ['personal_id' => $personal->id,
                        'oficina_id' => $request->oficina_id,
                        'rol_id' => $request->rol_id,
                        'date_rol_in'  => $date_rol_in,
                        'active' => 1]
                    );

                };

                return back()->with('status', 'Personal agregado con éxito!');

            }else{

                return back()->with('warning', 'No pudo ser procesado');

            };


        }else{

            return back()->with('warning', 'Debe seleccionar un archivo valido');

        }

    } 


    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function exportFile($type){

        $products = Personal::get()->toArray();


        return \Excel::create('hdtuto_demo', function($excel) use ($products) {

            $excel->sheet('sheet name', function($sheet) use ($products)

            {

                $sheet->fromArray($products);

            });

        })->download($type);

    } 
    
}
