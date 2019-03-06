@extends('layouts.master')

@section('title2')
    {{$direccion->name}}
@endsection

@section('opciones')
  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dirección
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="{{ route('direcciones.export.file',['type'=>'xls', 'id'=>$direccion->id])}}">Excel .xls</a>
      <a class="dropdown-item" href="{{ route('direcciones.export.file',['type'=>'xlsx', 'id'=>$direccion->id])}}">Excel .xlsx</a>
      <a class="dropdown-item" href="{{ route('direcciones.export.file',['type'=>'csv', 'id'=>$direccion->id])}}">Excel .csv</a>
    </div>
  </div>
@endsection

@section('content')

@include('notificaciones._notificaciones')

<div class="row">

    <div class="col-sm-12 text-right"><p>Actualizado al {{$direccion->updated_at}}</p></div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Nombre del Titular</h5>
          <p class="card-text">{{$direccion->titular}}</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">EMail</h5>
          <p class="card-text">{{$direccion->email}}</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Teléfono</h5>
            <p class="card-text">{{$direccion->phone}}</p>
          </div>
        </div>
      </div>

      <div class="col-sm-12 mt-2">
        <div class="card">
          <div class="card-body">
              <div class="d-flex bd-highlight mb-3">
                  <h5 class="card-title p-2 bd-highlight">Gerencias Comercial</h5>
                  
                  <div class="ml-auto p-2 bd-highlight">
                      <button class="btn btn-sm btn-outline-success" type="button" data-toggle="modal" data-target="#newGerencia">
                          Agregar
                      </button>
                  </div>

                </div>

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
                        @foreach ($direccion->gerencias as $gerencia)
                        <tr>
                        <th scope="row">{{$gerencia->name}}</th>
                              <td>{{$gerencia->titular}}</td>
                              <td>{{$gerencia->phone}}</td>
                              <td>{{$gerencia->email}}</td>
                              <td>{{$gerencia->alias}}</td>
                        <td><a type="button" class="btn btn-sm btn-outline-info" href="/gerencias/{{$gerencia->id}}">Detalle</a></td>
                        <td><a type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#editGerencia" data-name="{{$gerencia->name}}" data-alias="{{$gerencia->alias}}" data-titular="{{$gerencia->titular}}" data-phone="{{$gerencia->phone}}" data-email="{{$gerencia->email}}" data-id="{{$gerencia->id}}" data-direccion="{{$gerencia->direccion_id}}">Editar</a></td>
                        <td>
                            <form action="/gerencias/{{$gerencia->id}}" method="post">
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



      <!-- Modal Nueva Gerencia -->
      <div class="modal fade" id="newGerencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Crear Gerencia</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form action="{{route('gerencias.store')}}" method="post">
            {{ csrf_field() }}
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="name">Nombre de la Gerencia Comercial</label>
                  <input type="text" class="form-control" id="name" placeholder="Ger. Nombre de la Gerencia" name="name" value="{{ old('name')}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="alias">Alias</label>
                  <input type="text" class="form-control" id="alias" placeholder="Abrev. Nombre de la Gerencia" name="alias" value="{{ old('alias')}}">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="titular">Titular</label>
                  <input type="text" class="form-control" id="titular" name="titular" value="{{ old('titular')}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="phone">Teléfono</label>
                  <input type="text" class="form-control input-phone-new" id="phone" placeholder="0416 6XXXXXX" name="phone" value="{{ old('phone')}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{ old('email')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="direccion">Pertenece a la Dirección Comercial</label>
                <select class="form-control" id="direccion" name="direccion_id">
                  <option value="{{$direccion->id}}" selected>{{$direccion->name}}</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
          </div>
        </div>
      </div>

      @include('gerencias._edit')
   
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