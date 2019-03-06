@extends('layouts.master')

@section('title2')
    Direcciones Comerciales
@endsection

@section('opciones')
<div class="btn-group mr-2">
    <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#newDireccion">Nueva</button>
  </div>
  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Direcciones
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="{{ route('direcciones.export.file',['type'=>'xls']) }}">Excel .xls</a>
      <a class="dropdown-item" href="{{ route('direcciones.export.file',['type'=>'xlsx']) }}">Excel .xlsx</a>
      <a class="dropdown-item" href="{{ route('direcciones.export.file',['type'=>'csv']) }}">Excel .csv</a>
    </div>
  </div>
@endsection

@section('content')

@include('notificaciones._notificaciones')

<table class="table table-striped mt-4" id="table">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Titular</th>
            <th scope="col">Télefono</th>
            <th scope="col">E-Mail</th>
            <th scope="col">Alias</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($direcciones as $direccion)
            <tr>
            <th scope="row">{{$direccion->name}}</th>
                  <td>{{$direccion->titular}}</td>
                  <td>{{$direccion->phone}}</td>
                  <td>{{$direccion->email}}</td>
                  <td>{{$direccion->alias}}</td>
            <td><a type="button" class="btn btn-sm btn-outline-info" href="/direcciones/{{$direccion->id}}">Detalle</a></td>
            <td><a type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#editDireccion" data-name="{{$direccion->name}}" data-alias="{{$direccion->alias}}" data-titular="{{$direccion->titular}}" data-phone="{{$direccion->phone}}" data-email="{{$direccion->email}}" data-id="{{$direccion->id}}" >Editar</a></td>
            <td>
            <form action="/direcciones/{{$direccion->id}}" method="post">
                {{method_field('DELETE')}}
                {{ csrf_field() }}
                <button type="button" class="btn btn-sm btn-outline-danger btn-delete" >Eliminar</button>
              </form>
            </td>
            </tr>
            @endforeach
        </tbody>
      </table>


<!-- Modal Nueva Dirección -->
<div class="modal fade" id="newDireccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Dirección</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{route('direcciones.store')}}" method="post">
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="name">Nombre de la Dirección Comercial</label>
            <input type="text" class="form-control input-element" id="name" placeholder="Dir. Nombre de la Dirección" name="name" value="{{ old('name') }}" >
          </div>
          <div class="form-group col-md-4">
            <label for="alias">Alias</label>
            <input type="text" class="form-control" id="alias" placeholder="Abrev. Nombre de la Dirección" name="alias" value="{{ old('alias') }}" >
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="titular">Titular</label>
            <input type="text" class="form-control" id="titular" name="titular" value="{{ old('titular') }}" >
          </div>
          <div class="form-group col-md-4">
            <label for="phone">Teléfono</label>
            <input class="form-control input-phone-new" id="phone" placeholder="0416 6XXXXXX" name="phone" value="{{ old('phone') }}" >
          </div>
          <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{ old('email') }}" >
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>


<!-- Modal Editar Dirección -->
<div class="modal fade" id="editDireccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Dirección</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{route('direcciones.update', 'o')}}" method="post">
      @method('patch')
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-row">
          <input type="hidden" id="id" name="id" value="">
          <div class="form-group col-md-8">
            <label for="name">Nombre de la Dirección Comercial</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group col-md-4">
            <label for="alias">Alias</label>
            <input type="text" class="form-control" id="alias" name="alias">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="titular">Titular</label>
            <input type="text" class="form-control" id="titular" name="titular">
          </div>
          <div class="form-group col-md-4">
            <label for="phone">Teléfono</label>
            <input class="form-control input-phone-edit" id="phone" placeholder="0416 6XXXXXX" name="phone">
          </div>
          <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="ff" name="email">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>    
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