<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => ['role:admin']], function () {

Route::resource('oficinas', 'OficinasController');
Route::resource('gerencias', 'GerenciasController');
Route::resource('direcciones', 'DireccionesController');
Route::resource('supervisor', 'SupervisorController');
Route::resource('personal', 'PersonalController');
Route::resource('indicadores', 'IndicadorController');
Route::resource('indicadorrols', 'IndicadorRolController');
Route::resource('resultados', 'ResultadosRxpController');
Route::resource('configurarmes', 'ConfigurarMesController');
Route::resource('history', 'HistoryController');
Route::resource('ajustes', 'AjustesController');
Route::resource('actualizar', 'ActualizarController');
Route::resource('month', 'MonthController');
Route::resource('individual', 'RxpIndividualController');
Route::resource('colectivo', 'RxpCollectiveController');
Route::resource('empresarial', 'RxpBusinessController');
Route::resource('management', 'ManagementPersonalController');
Route::resource('oficinarol', 'RolController');
Route::resource('report', 'ReportController');
Route::resource('reportpdf', 'ReportPdfController');
Route::resource('settingrxp', 'SettingRxpController');
Route::get('modifypersonalrxp/{id}/oficina/{oficina}', 'StatusPersonalRxPController@show')->name('modify.personal.rxp');
Route::post('modifypersonalrxp', 'StatusPersonalRxPController@store')->name('modify.personal.rxp.store');
Route::patch('modifypersonalrxp/{id}', 'StatusPersonalRxPController@update')->name('modify.personal.rxp.update');
Route::get('collective/{id}/month/{month}', 'RxpCollectiveController@mostrarModal')->name('mostrar.modal.collective');
Route::get('individual/{id}/month/{month}', 'RxpIndividualController@mostrarModal')->name('mostrar.modal.individual');
Route::get('month/{id}/oficina/{oficina}', 'ReportController@resultRxpIndividual');
Route::get('/selectgerencia/{id}', 'GerenciasController@selectgerencia');

});

//Route::get('import-export-view', 'ExcelPersonalController@importExportView')->name('import.export.view');
Route::post('import-file', 'ExcelPersonalController@importFile')->name('personal.import.file');
//Route::get('export-file/{type}', 'ExcelPersonalController@exportFile')->name('personal.export.file');

Route::post('direccion-import-file', 'ExcelDireccionController@importFile')->name('direcciones.import.file');
Route::get('direccion-export-file/{type}/{id?}', 'ExcelDireccionController@exportFile')->name('direcciones.export.file');

Route::post('gerencia-import-file', 'ExcelGerenciaController@importFile')->name('gerencias.import.file');
Route::get('gerencia-export-file/{type}/{id?}', 'ExcelGerenciaController@exportFile')->name('gerencias.export.file');

Route::post('oficina-import-file', 'ExcelOficinaController@importFile')->name('oficinas.import.file');
Route::get('oficina-export-file/{type}/{id?}', 'ExcelOficinaController@exportFile')->name('oficinas.export.file');

Route::get('reporte-rxp-file/{type}/{id?}', 'ExcelReporteRxpController@exportFile')->name('reporte.rxp.file');
