@extends('layouts.master')

@section('title2')
    Detalle del Trabajador
@endsection

@section('opciones')
    
@endsection

@section('content')
@include('notificaciones._notificaciones')
<div class="card border-dark mb-3">
    <div class="card-header d-flex justify-content-between">
        <span class="lead">
            {{$personal->history->where('active', 1)->first()->oficina->name}}
        </span>
        <span class="lead">
            {{$personal->p00}}
        </span>
    </div>
    <div class="card-body text-dark">
        <div class="row">
            <div class="col-md-6">
            <p>Oficina: {{$personal->history->where('active', 1)->first()->oficina->name}}</p>
            <p>Cargo: {{$personal->history->where('active', 1)->first()->rol->description}}</p>
            <p> Desde: {{$personal->history->where('active', 1)->first()->date_rol_in}}</p>

            </div>
            <div class="col-md-6">
                <p>Fecha de Ingreso: {{$personal->date_in}}</p>
                <p>Fecha de Egreso: {{$personal->date_out}}</p>
                <p>Correo Corporativo: {{$personal->email}}</p>
            </div>
        </div>
        <h5 class="card-title mt-4">
            Historial de Cambios
        </h5>
        <table class="table text-center table-striped">
                <thead>
                  <tr>
                    <th scope="col">Oficina</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Desde</th>
                    <th scope="col">Hasta</th>
                    <th scope="col">Actualizado al</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
        @forelse ($personal->history->where('active', 0) as $history)
                    <tr>
                    <td>{{$history->oficina->name}}</td>
                    <td>{{$history->rol->name}}</td>
                    <td>{{$history->date_rol_in}}</td>
                    <td>{{$history->date_rol_out}}</td>
                    <td>{{$history->updated_at}}</td>
                    <td>
                        <form action="/history/{{$history->id}}" method="post">
                            {{method_field('DELETE')}}
                            {{ csrf_field() }}
                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete" >Eliminar</button>
                        </form>
                    </td>
                    </tr>
                
        @empty
            <td colspan="5">No hay datos para mostrar</td>
        @endforelse
    </tbody>
</table>
    </div>
</div>
@endsection




