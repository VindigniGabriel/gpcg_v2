@extends('layouts.master')

@section('title2')
    Indicadores
@endsection

@section('opciones')
<div class="btn-group mr-2">
    <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#newIndicador">Nuevo</button>
</div>
@endsection

@section('content')

@include('notificaciones._notificaciones')
<table class="table table-striped mt-4 table table-sm text-center">
    <thead class="thead-dark">
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" >Metas para el Indicador</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="col">Nombre (Alias)</th>
            <th scope="col">Descripción</th>
            <th scope="col">min</th>
            <th scope="col">med</th>
            <th scope="col">max</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($indicadores as $indicador)
            <tr>
                <th scope="row">{{$indicador->name}}</th>
                <td>{{$indicador->description}}</td>
                <td>{{$indicador->min}}</td>
                <td>{{$indicador->med}}</td>
                <td>{{$indicador->max}}</td>
                <td><button type="button" class="btn btn-sm btn-outline-success" data-target="#editIndicador" data-toggle="modal" data-name="{{$indicador->name}}" data-min="{{$indicador->min}}" data-med="{{$indicador->med}}" data-max="{{$indicador->max}}" data-description="{{$indicador->description}}" data-id="{{$indicador->id}}">Editar</button></td>
                <td>
                    <form action="/indicadores/{{$indicador->id}}" method="post">
                        {{method_field('DELETE')}}
                        {{ csrf_field() }}
                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete" {{($indicador->id === 1) ? 'disabled' : ''}}>Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>

@include('indicadores._edit')
@include('indicadores._new')

@endsection