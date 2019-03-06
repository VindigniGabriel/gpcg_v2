@extends('layouts.master')

@section('title2')
    Resultados RxP por Mes
@endsection

@section('opciones')
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#newMes">
      Nuevo Mes RxP
    </button>
  </div>
@endsection

@section('content')
@include('notificaciones._notificaciones')
<div class="container text-center">
    
    <table class="table table-striped mt-4" id="table">
            <thead>
              <tr>
                <th scope="col">Mes</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @forelse ($months as $month)
                    <tr>
                        <td>{{$month->month}}</td> 
                        <td>
                          <a type="button" class="btn btn-sm btn-outline-primary" href="/individual/{{$month->id}}">
                              Individuales
                          </a>
                        </td>
                        <td>
                          <a type="button" class="btn btn-sm btn-outline-success" href="/colectivo/{{$month->id}}">
                              Colectivos
                          </a>
                        </td> 
                        <td>
                          <a type="button" class="btn btn-sm btn-outline-dark" href="/empresarial/{{$month->id}}">
                              Empresarial
                          </a>
                        </td>
                        <td>
                          <a type="button" class="btn btn-sm btn-outline-dark" href="/report/{{$month->id}}">
                            Detalle por Oficina
                          </a>
                        </td>
                        <td>
                          <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Descargar
                          </button>
                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                              <a class="dropdown-item" href="{{ route('reporte.rxp.file',['type'=>'xls', 'id'=>$month->id]) }}">Reporte RxP {{$month->month}}.xls</a>
                              <a class="dropdown-item" href="{{ route('reporte.rxp.file',['type'=>'xlsx', 'id'=>$month->id]) }}">Reporte RxP {{$month->month}}.xlsx</a>
                              <a class="dropdown-item" href="{{ route('reporte.rxp.file',['type'=>'csv', 'id'=>$month->id]) }}">Reporte RxP {{$month->month}}.csv</a>
                          </div>
                        </td> 
                        <td>
                            <form action="/month/{{$month->id}}" method="post">
                              {{method_field('DELETE')}}
                              {{ csrf_field() }}
                              <button type="button" class="btn btn-sm btn-outline-danger btn-delete" >Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <p>No existe data para mostrar</p>
                    @endforelse
            </tbody>
          </table>
    
</div>
   
@include('configurarmes._newmes')
@endsection

