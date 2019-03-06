@extends('layouts.master')

@section('title2')
    {{$gerencia->name}}    
@endsection

@section('opciones')
<div class="btn-group" role="group">
  <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Gerencia
  </button>
  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    <a class="dropdown-item" href="{{ route('gerencias.export.file',['type'=>'xls', 'id'=>$gerencia->id]) }}">Excel .xls</a>
    <a class="dropdown-item" href="{{ route('gerencias.export.file',['type'=>'xlsx', 'id'=>$gerencia->id]) }}">Excel .xlsx</a>
    <a class="dropdown-item" href="{{ route('gerencias.export.file',['type'=>'csv', 'id'=>$gerencia->id]) }}">Excel .csv</a>
  </div>
</div>

@endsection

@section('content')
@include('notificaciones._notificaciones')

<div class="row">

    <div class="col-sm-12 text-right"><p>Actualizado al {{$gerencia->updated_at}}</p></div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Nombre del Titular</h5>
          <p class="card-text">{{$gerencia->titular}}</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">EMail</h5>
          <p class="card-text">{{$gerencia->email}}</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Teléfono</h5>
            <p class="card-text">{{$gerencia->phone}}</p>
          </div>
        </div>
      </div>

      <div class="col-sm-12 mt-2">
        <div class="card">
          <div class="card-body">
              <div class="d-flex bd-highlight mb-3">
                  <h5 class="card-title p-2 bd-highlight">Oficinas Comercial</h5>
                  
                  <div class="ml-auto p-2 bd-highlight">
                      <button class="btn btn-sm btn-outline-success" type="button" data-toggle="modal" data-target="#newOficina">
                          Agregar
                      </button>
                  </div>

                </div>

                <table class="table table-striped mt-4" id="table">
                    <thead>
                      <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Código</th>
                        <th scope="col">Tipo</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($gerencia->oficinas as $oficina)
                        <tr>
                        <th scope="row">{{$oficina->name}}</th>
                        <td>{{$gerencia->direccion->name}}</td>
                        <td>{{$oficina->alias}}</td>
                        <td>{{$oficina->oficinatipo->name}}</td>
                        <td><a type="button" class="btn btn-sm btn-outline-info" href="/oficinas/{{$oficina->id}}">Detalle</a></td>
                        <td><a type="button" class="btn btn-sm btn-outline-success"  data-toggle="modal" data-target="#editOficina" data-name="{{$oficina->name}}" data-alias="{{$oficina->alias}}" data-titular="{{$oficina->titular}}" data-phone="{{$oficina->phone}}" data-email="{{$oficina->email}}" data-id="{{$oficina->id}}" data-direccion="{{$oficina->gerencia->direccion_id}}" data-gerencia="{{$oficina->gerencia->id}}" data-tipo="{{$oficina->oficina_tipo_id}}" data-ubicacion="{{$oficina->ubicacion}}">Editar</a></td>
                        <td>
                        <form action="/oficinas/{{$oficina->id}}" method="post">
                          {{method_field('DELETE')}}
                          {{ csrf_field() }}
                          <button type="button" class="btn btn-sm btn-outline-danger btn-delete" >Eliminar</button>
                        </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
          </div>
        </div>
      </div>

</div>


<!-- Modal Nueva Oficina-->
<div class="modal fade" id="newOficina" tabindex="-1" role="dialog" aria-labelledby="newOficina" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear Oficina</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
  
        <div class="modal-body">
        <form action="{{route('oficinas.store')}}" method="post">
            {{ csrf_field() }}
            <div class="form-row">
        <div class="form-group col-md-8">
            <label for="name">Nombre de la Oficina</label>
            <input type="text" class="form-control" id="name" name="name" placeholder=" Ej. Metrocenter" value="{{ old('name') }}" >
          </div>
  
          <div class="form-group col-md-4">
              <label for="alias">Código de la Oficina</label>
              <input type="text" class="form-control" id="alias" name="alias" placeholder="Ej. OC20" value="{{ old('alias') }}" >
            </div>
  
  
            </div>
    <div class="form-row">
      <div class="form-group col-md-4">
          <label for="direcccion">Dirección Comercial</label>
          <select id="direccion" class="form-control" name="direccion_id">
          <option selected value="{{$gerencia->direccion->id}}">{{$gerencia->direccion->name}}</option>
          </select>
      </div>
      <div class="form-group col-md-4">
          <label for="gerencia">Gerencia Comercial</label>
          <select id="gerencia" class="form-control" name="gerencia_id">
            <option selected value="{{$gerencia->id}}">{{$gerencia->name}}</option>
          </select>
      </div>
      <div class="form-group col-md-4">
          <label for="oficina_tipo_id">Tipo de Oficina</label>
          <select id="oficina_tipo_id" class="form-control" name="oficina_tipo_id">
            @foreach ($oficinaTipos as $oficinaTipo)
                <option value="{{$oficinaTipo->id}}">{{$oficinaTipo->name}}</option>
            @endforeach
          </select>
      </div>
    </div>
  
      <div class="form-group">
        <label for="ubicacion">Ubicación</label>
        <input type="text" class="form-control" id="ubicacion" placeholder="" name="ubicacion" value="{{ old('ubicacion') }}" >
      </div>
      
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  
    </div>
  </div>
</div>

@include('oficinas._edit')

@endsection