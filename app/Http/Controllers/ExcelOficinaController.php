<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficina;

class ExcelOficinaController extends Controller
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
 
             $oficinas = Oficina::all();
 
             return \Excel::create('Oficinas', function($excel) use ($oficinas) {
     
                 $excel->sheet('Data Oficinas', function($sheet) use ($oficinas)
     
                 {
                     $sheet->row(1, ['Oficina', 'Gerencia Comercial', 'Dirección Comercial', 'Alias', 'Tipo Oficina'
 
                     ]);
 
                     foreach ($oficinas as $key => $oficina) {
                         $sheet->row( $key + 2, [
                             $oficina->name, $oficina->gerencia->name, $oficina->gerencia->direccion->name, $oficina->alias, $oficina->oficinatipo->name
                         ]);
                     }
     
                 });


                 foreach ($oficinas as $oficina) {
                    $excel->sheet($oficina->name, function($sheet) use ($oficina) {
                        $sheet->row(1, ['P00', 'Supervisor', 'Correo', 'Teléfono', 'Turno', 'Oficina']);

                        foreach ($oficina->supervisors as $key => $supervisor) {
                            $sheet->row( $key + 2, [
                                $supervisor->p00, $supervisor->name, $supervisor->email, $supervisor->phone, $supervisor->turno->name, $oficina->name
                            ]);
                        }
                        $sheet->row(5, ['p00', 'Nombre', 'Rol', 'Correo', 'Teléfono', 'Oficina'
                        ]);
                        foreach ($oficina->history as $key => $personal) {
                            $sheet->row( $key + 6, [
                                $personal->personal->p00, $personal->personal->name, $personal->rol->name, $personal->personal->email, $personal->personal->phone, $personal->oficina->name
                            ]);
                        }
                    });
                }
     
             })->export($type);
 
         }else{
 
            $oficina = Oficina::find($id);
 
            return \Excel::create($oficina->name, function($excel) use ($oficina) {
    
                $excel->sheet($oficina->name, function($sheet) use ($oficina)
    
                {
                    $sheet->row(1, ['Oficina', 'Gerencia Comercial', 'Dirección Comercial', 'Alias', 'Tipo Oficina'

                    ]);

                        $sheet->row( 2, [
                            $oficina->name, $oficina->gerencia->name, $oficina->gerencia->direccion->name, $oficina->alias, $oficina->oficinatipo->name
                        ]);
    
                });


                    $excel->sheet('Personal - '.$oficina->alias, function($sheet) use ($oficina) {
                        $sheet->row(1, ['P00', 'Supervisor', 'Correo', 'Teléfono', 'Turno', 'Oficina']);
                        $rows = 6;
                        foreach ($oficina->supervisors as $key => $supervisor) {
                            $sheet->row( $key + 2, [
                               $supervisor->p00, $supervisor->name, $supervisor->email, $supervisor->phone, $supervisor->turno->name, $oficina->name
                            ]);
                        }
                        $sheet->row(5, ['p00', 'Nombre', 'Rol', 'Correo', 'Teléfono', 'Oficina'
                        ]);
                        foreach ($oficina->history->where('active', 1) as $key => $personal) {
                            $sheet->row( $rows, [
                               $personal->personal->p00, $personal->personal->name, $personal->rol->name, $personal->personal->email, $personal->personal->phone, $personal->oficina->name
                            ]);
                            $rows++;
                        }
                    });
    
            })->export($type);
         }
     } 
}
