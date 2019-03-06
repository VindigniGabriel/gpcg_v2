<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gerencia;

class ExcelGerenciaController extends Controller
{
    //**

    /* Create a new controller instance.

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

            $gerencias = Gerencia::all();

            return \Excel::create('Gerencias', function($excel) use ($gerencias) {
    
                $excel->sheet('Data Gerencias', function($sheet) use ($gerencias)
    
                {
                    $sheet->row(1, ['Gerencia Comercial', 'Dirección Comercial', 'Titular', 'Correo', 'Telélefono'

                    ]);

                    foreach ($gerencias as $key => $gerencia) {
                        $sheet->row( $key + 2, [
                            $gerencia->name, $gerencia->direccion->name, $gerencia->titular, $gerencia->email, $gerencia->phone
                        ]);
                    }
    
                });
    
            })->export($type);

        }else{

            $gerencia = Gerencia::find($id);

            return \Excel::create($gerencia->name, function($excel) use ($gerencia) {
    
                $excel->sheet($gerencia->name, function($sheet) use ($gerencia) {
                    $sheet->row(1, ['Gerencia Comercial', 'Dirección Comercial', 'Titular', 'Correo', 'Teléfono'
                    ]);

                    $sheet->row( 2, [
                        $gerencia->name, $gerencia->direccion->name, $gerencia->titular, $gerencia->email, $gerencia->phone
                    ]);
                      
                });
                
                $excel->sheet('Data Oficinas', function($sheet) use ($gerencia) {

                    $sheet->row(1, ['Oficina', 'Supervisor', 'Correo', 'Teléfono'

                    ]);

                    foreach ($gerencia->oficinas as $oficina) {

                        foreach ($oficina->supervisors as $key => $supervisor) {
                            $sheet->row( $key + 2, [
                                $oficina->name, $supervisor->name, $supervisor->email, $supervisor->phone
                            ]);
                        }
                        
                    }
                      
                });

                foreach ($gerencia->oficinas as $oficina) {
                    $excel->sheet($oficina->name, function($sheet) use ($oficina) {
                        $sheet->row(1, ['p00', 'Nombre', 'Rol', 'Correo', 'Teléfono', 'Oficina'
                        ]);
                        foreach ($oficina->history as $key => $personal) {
                            $sheet->row( $key + 2, [
                                $personal->personal->p00, $personal->personal->name, $personal->rol->name, $personal->personal->email, $personal->personal->phone, $personal->oficina->name
                            ]);
                        }
                    });
                }
            })->export($type);
        }
    }  
}
