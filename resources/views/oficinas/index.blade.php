@extends('layouts.master')
@section('title2')
    Oficinas
@endsection

@section('opciones')
<div class="btn-group mr-2">
  <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#newOficina">Nueva</button>
</div>
<div class="btn-group" role="group">
  <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Oficinas
  </button>
  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    <a class="dropdown-item" href="{{ route('oficinas.export.file',['type'=>'xls']) }}">Excel .xls</a>
    <a class="dropdown-item" href="{{ route('oficinas.export.file',['type'=>'xlsx']) }}">Excel .xlsx</a>
    <a class="dropdown-item" href="{{ route('oficinas.export.file',['type'=>'csv']) }}">Excel .csv</a>
  </div>
</div>
@endsection
@section('content')
@include('notificaciones._notificaciones')
<table class="table table-striped mt-4 table-sm" id="table">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Gerencia</th>
            <th scope="col">Dirección</th>
            <th scope="col">Código</th>
            <th scope="col">Tipo</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($oficinas as $ofi)
            <tr>
            <th scope="row">{{$ofi->name}}</th>
            <td>{{$ofi->gerencia->name}}</td>
            <td>{{$ofi->gerencia->direccion->name}}</td>
            <td>{{$ofi->alias}}</td>
            <td>{{$ofi->oficinatipo->name}}</td>
            <td><a type="button" class="btn btn-sm btn-outline-info" href="/oficinas/{{$ofi->id}}">Detalle</a></td>
            <td><a type="button" class="btn btn-sm btn-outline-success"  data-toggle="modal" data-target="#editOficina" data-name="{{$ofi->name}}" data-alias="{{$ofi->alias}}" data-titular="{{$ofi->titular}}" data-phone="{{$ofi->phone}}" data-email="{{$ofi->email}}" data-id="{{$ofi->id}}" data-direccion="{{$ofi->gerencia->direccion_id}}" data-gerencia="{{$ofi->gerencia->id}}" data-tipo="{{$ofi->oficina_tipo_id}}" data-ubicacion="{{$ofi->ubicacion}}">Editar</a></td>
              <td>
                <form action="/oficinas/{{$ofi->id}}" method="post">
                  {{method_field('DELETE')}}
                  {{ csrf_field() }}
                  <button type="button" class="btn btn-sm btn-outline-danger btn-delete" >Eliminar</button>
                </form>
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>

@include('oficinas._edit')
@include('oficinas._new')

@endsection

@section('scripts')
<script>
    var cleave = new Cleave('.input-phone-new', {
      phone: true,
      phoneRegionCode: 'VE'
    });

    var cleave = new Cleave('.input-phone-edit', {
      phone: true,
      phoneRegionCode: 'VE'
    });
</script>
@endsection