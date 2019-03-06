@extends('layouts.master')

@section('title2')
Resultados RxP Empresarial <span>{{$month->month}}</span>  
@endsection

@section('opciones')
<ul class="nav nav-pills nav-fill">
    <li class="nav-item mr-2">
        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Descargar
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="{{ route('reporte.rxp.file',['type'=>'xls', 'id'=>$month->id]) }}">Reporte RxP {{$month->month}}.xls</a>
            <a class="dropdown-item" href="{{ route('reporte.rxp.file',['type'=>'xlsx', 'id'=>$month->id]) }}">Reporte RxP {{$month->month}}.xlsx</a>
            <a class="dropdown-item" href="{{ route('reporte.rxp.file',['type'=>'csv', 'id'=>$month->id]) }}">Reporte RxP {{$month->month}}.csv</a>
        </div>
    </li>
    <li class="nav-item mr-2">
        <div class="btn-group dropleft">
            <a type="button" class="btn btn-sm btn-outline-primary" href="/individual/{{$month->id}}">
                Individuales
            </a>
        </div>
    </li>
    <li class="nav-item mr-2">
        <div class="btn-group dropleft">
            <a type="button" class="btn btn-sm btn-outline-success" href="/colectivo/{{$month->id}}">
                Colectivos
            </a>
        </div>
    </li>
</ul>
@endsection

@section('content')

<table class="table text-center table-sm table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">Indicador</th>
            <th scope="col">Remuneración del Indicador</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                Empresarial
            </td>
            <td>
                {{$business->porcentaje}}
            </td>
            <td>
                <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#empresarialModal">
                    Actualizar
                </button>
            </td>
        </tr>
    </tbody>
</table>
@include('rxp._actempresarial')
@endsection