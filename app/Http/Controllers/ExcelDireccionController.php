<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Direccion;

class ExcelDireccionController extends Controller
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

    public function importFile(Request $request){

        return $request->all();

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();

            $data = \Excel::load($path)->get();


            if($data->count()){

                foreach ($data as $key => $value) {

                    $personal = Personal::updateOrCreate(
                        ['p00' => $value->p00],
                        ['oficina_id' => $value->oficina_id,
                        'rol_id' => $value->rol_id,
                        'p00' => $value->p00,
                        'name' => $value->name]
                    );

                    $personal->save();

                }

            }

        }

    } 


    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function exportFile($type, $id=null){

        if ($id == null){

            $direcciones = Direccion::all();

            return \Excel::create('Direcciones', function($excel) use ($direcciones) {
    
                $excel->sheet('Data Direcciones', function($sheet) use ($direcciones)
    
                {
                    $sheet->row(1, ['Dirección Comercial', 'Titular', 'Correo', 'Telélefono'

                    ]);

                    foreach ($direcciones as $key => $direccion) {
                        $sheet->row( $key + 2, [
                            $direccion->name, $direccion->titular, $direccion->email, $direccion->phone
                        ]);
                    }
    
                });
    
            })->export($type);

        }else{

            $direccion = Direccion::find($id);

            return \Excel::create($direccion->name, function($excel) use ($direccion) {
    
                $excel->sheet($direccion->name, function($sheet) use ($direccion) {
                    $sheet->row(1, ['Dirección Comercial', 'Titular', 'Correo', 'Telélefono'

                    ]);

                    $sheet->row( 2, [
                        $direccion->name, $direccion->titular, $direccion->email, $direccion->phone
                    ]);
                      
                });

                $excel->sheet('Data Gerencias', function($sheet) use ($direccion) {

                    $sheet->row(1, ['Gerencia', 'Titular', 'Correo', 'Telélefono'

                    ]);

                    foreach ($direccion->gerencias as $key => $gerencia) {
                        $sheet->row( $key + 2, [
                            $gerencia->name, $gerencia->titular, $gerencia->email, $gerencia->phone
                        ]);
                    }
                      
                });
    
            })->export($type);

        }

    }  
}
