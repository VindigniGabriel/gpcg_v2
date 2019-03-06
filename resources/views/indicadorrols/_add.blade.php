<!-- Modal add Indicador por Rol-->
<div class="modal fade" id="addIndicador{{$rol->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Indicador a Rol {{$rol->name}}<span id="rolname"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('indicadorrols.store')}}" method="post">
                {{ csrf_field() }}
            <div class="modal-body">
                    <input type="hidden" name="rol_id" value="{{$rol->id}}">
                    <table class="table table-striped mt-4 table-sm">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                        <td scope="col"></td>
                                        <td scope="col" colspan="3">Meta Esquema RxP</td>
                                        <td scope="col"></td>
                                </tr>
                                <tr class="text-center">
                                    <th scope="col">Indicador</th>
                                    <th scope="col">20%</th>
                                    <th scope="col">25%</th>
                                    <th scope="col">30%</th>
                                    <th scope="col">Tipo</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr class="text-center">
                                    <td>
                                        <select class="form-control form-control-sm" id="indicador_id" name="indicador_id">
                                                <option value="" selected>Seleccione Indicador</option>
                                                    @foreach ($indicadores->whereNotIn('id', $rol->indicadors->pluck('id')) as $ind)
                                                        <option value="{{$ind->id}}" >{{$ind->name}}</option>
                                                    @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form form-control form-control-sm text-info" type="number" value="" name="min" min="0" step="0.5" >
                                    </td>
                                    <td>
                                        <input class="form form-control form-control-sm text-info" type="number" value="" name="med" min="0" step="0.5" >
                                    </td>
                                    <td>
                                        <input class="form form-control form-control-sm text-info" type="number" value="" name="max" min="0" step="0.5" >
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm" id="indicador_tipo_id" name="indicador_tipo_id">
                                                    <option value="" selected>Seleccione Tipo</option>
                                            @foreach ($indicadorTipos->where('id', '!==' , 3) as $indicadortipo)
                                                    <option value="{{$indicadortipo->id}}" >{{$indicadortipo->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>