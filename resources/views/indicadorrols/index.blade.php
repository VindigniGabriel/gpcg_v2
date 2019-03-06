@extends('layouts.master')

@section('title2')
    Indicadores por Rol
@endsection

@section('content')
@include('notificaciones._notificaciones')
@foreach ($rols as $rol)
@include('indicadorrols._add')

       <div class="d-flex bd-highlight mb-3 mt-4">
        <span class="card-title p-2 bd-highlight h4">{{$rol->description}}</span>
        <div class="ml-auto p-2 bd-highlight">
            @if(count($rol->indicadors)>0)
            <button class="btn btn-sm btn-outline-success" type="button" data-toggle="modal" data-target="#edit{{$rol->name}}">
                Editar
            </button>  
            @endif
            <div class="btn-group mr-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#addIndicador{{$rol->id}}">Agregar</button>
            </div>
        </div>

      </div>

      <table class="table table-striped mt-4 table-sm">
        <thead class="thead-dark">
            <tr class="text-center">
                    <td scope="col"></td>
                    <td scope="col" colspan="3">Metas Esquema RxP</td>
                    <td scope="col"></td>
            </tr>
            <tr class="text-center">
                <th scope="col">Indicador</th>
                <th scope="col">20%</th>
                <th scope="col">25%</th>
                <th scope="col">30%</th>
                <th scope="col">Tipo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rol->indicadors as $indicador)
                <tr class="text-center">
                    <td>{{$indicador->name}}</td>
                    <td class="text-danger">{{$indicador->pivot->min}}</td>
                    <td class="text-info">{{$indicador->pivot->med}}</td>
                    <td class="text-success">{{$indicador->pivot->max}}</td>
                    @foreach ($indicadorTipos as $indicadortipo)
                        @if ($indicadortipo->id == $indicador->pivot->indicador_tipo_id)
                            <td>{{$indicadortipo->name}}</td>
                        @endif
                    @endforeach
                    <td>
                        <form action="/indicadorrols/{{$indicador->pivot->id}}" method="post">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete" >Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
</table>


    <!-- Modal Indicadores por Rol-->
<div class="modal fade" id="edit{{$rol->name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Indicadores para Rol {{$rol->name}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <form action="{{route('indicadorrols.update', $rol->id)}}" method="post">
                    @method('patch')
                    {{ csrf_field() }}
                    <div class="modal-body">
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
                                        @foreach ($rol->indicadors as $indicador)
                                        <input type="hidden" value="{{$indicador->id}}" name="indicador_id[]">
                                        <tr class="text-center">
                                            <td>{{$indicador->name}}</td>
                                            <td>
                                                <input class="form form-control form-control-sm text-danger" type="number" value="{{$indicador->pivot->min}}" name="min[]" min="0" step="0.5" >
                                            </td>
                                            <td>
                                                <input class="form form-control form-control-sm text-info" type="number" value="{{$indicador->pivot->med}}" name="med[]" min="0" step="0.5" >
                                            </td>
                                            <td>
                                                <input class="form form-control form-control-sm text-success" type="number" value="{{$indicador->pivot->max}}" name="max[]" min="0" step="0.5" >
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm" id="indicador_tipo_id" name="indicador_tipo_id[]">
                                                    @foreach ($indicadorTipos->where('id', '!==' , 3) as $indicadortipo)
                                                        @if ($indicadortipo->id == $indicador->pivot->indicador_tipo_id)
                                                            <option value="{{$indicadortipo->id}}" selected>{{$indicadortipo->name}}</option>
                                                        @else
                                                            <option value="{{$indicadortipo->id}}" >{{$indicadortipo->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>


@endforeach



@endsection