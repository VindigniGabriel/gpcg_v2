@extends('layouts.master')
@section('title2')
    {{$oficina->name}} <span class="font-weight-bold">{{$oficina->alias}}</span>
@endsection
@section('opciones')
  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Oficina
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="{{ route('oficinas.export.file',['type'=>'xls', 'id'=>$oficina->id]) }}">Excel .xls</a>
      <a class="dropdown-item" href="{{ route('oficinas.export.file',['type'=>'xlsx', 'id'=>$oficina->id]) }}">Excel .xlsx</a>
      <a class="dropdown-item" href="{{ route('oficinas.export.file',['type'=>'csv', 'id'=>$oficina->id]) }}">Excel .csv</a>
    </div>
  </div>
@endsection
@section('content')
@include('notificaciones._notificaciones')
<div class="row">
  <div class="col-sm-12 text-right"><p>Actualizado al {{$oficina->updated_at}}</p></div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Dirección Comercial</h5>
        @foreach ($direcciones as $direccion)
              @if ($direccion->id == $oficina->gerencia->direccion_id)
                  <p class="card-text">{{$direccion->name}}</p>
              @endif
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Gerencia Comercial</h5>
        <p class="card-text">{{$oficina->gerencia->name}}</p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 mt-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Ubicación</h5>
          {{ $oficina -> ubicacion}}
        </div>
      </div>
    </div>
    <div class="col-sm-6 mt-2">
      <div class="card">
        <div class="card-body">
            <div class="d-flex bd-highlight mb-1">
                <h5 class="card-title p-2 bd-highlight">Horario</h5>
                
                <div class="ml-auto p-2 bd-highlight">
                    <button class="btn btn-sm btn-outline-success" type="button" data-target="#editHorario" data-toggle="modal">
                        Actualizar
                    </button>
                </div>

              </div>
          <ul class="list-group list-group-flush">
              <li class="list-group-item">Lunes: {{$oficina->lunes_in}} a {{$oficina->lunes_out}}</li>
              <li class="list-group-item">Martes a Viernes: {{$oficina->martesviernes_in}} a {{$oficina->martesviernes_out}}</li>
              <li class="list-group-item">Sábados: {{$oficina->sabados_in}} a {{$oficina->sabados_out}}</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-sm-12 mt-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex bd-highlight mb-1">
                    <h5 class="card-title p-2 bd-highlight">Ficha Operativa</h5>
                    
                    <div class="ml-auto p-2 bd-highlight">
                        <button class="btn btn-sm btn-outline-success" data-target="#editFicha" data-toggle="modal" type="button">
                            Actualizar
                        </button>
                    </div>

                  </div>

                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Pto. At. (front)</th>
                        <th scope="col">Pto. Op. (front)</th>
                        <th scope="col">Pto. At. (recep)</th>
                        <th scope="col">Pto. Op. (recep)</th>
                        <th scope="col">Plantilla Ejecutivo</th>
                        <th scope="col">Dispo. Ejecutivo</th>
                        <th scope="col">Dispo. Especialista</th>
                        <th scope="col">Dispo. Supervisores</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$oficina->plantilla_e}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
          </div>
    </div>

        <div class="col-sm-12 mt-2">
          <div class="card">
            <div class="card-body">
                <div class="d-flex bd-highlight mb-3">
                    <h5 class="card-title p-2 bd-highlight">Supervisores</h5>
                    
                    <div class="ml-auto p-2 bd-highlight">
                        <button class="btn btn-sm btn-outline-success" data-target="#newSupervisor" data-toggle="modal" type="button">
                            Agregar
                        </button>
                    </div>

                  </div>
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">P00</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Teléfono</th>
                      <th scope="col">Correo</th>
                      <th scope="col">Turno</th>
                      <th></th>
                      <th></th>
                      <th>Última Act.</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($oficina->supervisors as $supervisor)
                      <tr>
                        <th scope="row">{{$supervisor->p00}}</th>
                        <th>{{$supervisor->name}}</th>
                        <td>{{$supervisor->phone}}</td>
                        <td>{{$supervisor->email}}</td>
                        <td>{{$supervisor->turno->name}}</td>
                        <td>
                          <button class="btn btn-outline-success btn-sm" type="button" data-p00="{{$supervisor->p00}}" data-id="{{$supervisor->id}}" data-name="{{$supervisor->name}}" data-phone="{{$supervisor->phone}}" data-email="{{$supervisor->email}}" data-turno="{{$supervisor->turno_id}}" data-toggle="modal" data-target="#editSupervisor">
                            Actualizar
                          </button>
                        </td>
                        <td>
                        <form action="/supervisor/{{$supervisor->id}}" method="post">
                          {{method_field('DELETE')}}
                          {{ csrf_field() }}
                          <button type="button" class="btn btn-sm btn-outline-danger btn-delete" >Eliminar</button>
                        </form>
                        </td>
                        <td>{{$supervisor->updated_at}}</td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-sm-12 mt-2">
        <div class="d-flex bd-highlight mb-3">
          <span class="card-title p-2 bd-highlight h4">Personal de {{$oficina->name}}</span>
          <div class="mr-auto p-2 bd-highlight">
              <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Agregar
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" data-toggle="modal" href="#newPersonal" data-oficina="{{$oficina->id}}">Agregar Personal</a>
                    <a class="dropdown-item" data-toggle="modal" href="#newPersonalList" data-oficina="{{$oficina->id}}">Listado desde Archivo</a>
                  </div>
                </div>
          </div>
        </div>
        </div>

      @foreach ($rols as $rol)
        @foreach ($rol->oficinatipos->where('id', $oficina->oficina_tipo_id ) as $tipo)
          <div class="col-sm-12 mt-2">
            <div class="card">
              <div class="card-body">
                  <div class="d-flex bd-highlight mb-3">
                      <h5 class="card-title p-2 bd-highlight">{{$rol->description}} ({{$rol->name}})</h5>
                  </div>
              
                  <table class="table text-center table-striped table-sm">
                    <thead>
                      <tr>
                        <th scope="col">P00</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Correo</th>
                        <th></th>
                        <th></th>
                        <th>Última Act.</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                      @forelse ($oficina->history->where('rol_id', $rol->id)->where('active', 1)  as $history)

                        <tr>
                            <th scope="row">{{$history->personal->p00}}</th>
                            <td>{{$history->personal->name}}</td>
                            <td>{{$history->personal->phone}}</td>
                            <td>{{$history->personal->email}}</td>
                            <td>
                                <button class="btn btn-outline-success btn-sm" type="button" data-p00="{{$history->personal->p00}}" data-id="{{$history->personal->id}}" data-name="{{$history->personal->name}}" data-phone="{{$history->personal->phone}}" data-email="{{$history->personal->email}}" data-rol="{{$history->rol_id}}" data-ingreso="{{$history->personal->date_in}}" data-rolin="{{$history->date_rol_in}}" data-toggle="modal" data-target="#editPersonal">
                                    Actualizar
                                </button>
                            </td>
                            <td>
                              <a href="{{route('history.show', $history->personal_id)}}" class="btn btn-outline-info btn-sm" type="button">
                                Detalle
                              </a>
                            </td>
                            <td>{{$history->personal->updated_at}}</td>
                            <td>
                              <form action="/personal/{{$history->personal_id}}" method="post">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete" >Eliminar</button>
                              </form>
                            </td>
                          </tr>
                  @empty
                  <tr>
                    <td colspan="7">
                      No hay personal con rol {{$rol->name}} para la Oficina {{$oficina->name}}
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              </div>
            </div>
          </div>

        @endforeach
      @endforeach

</div>

@include('oficinas._horario')
@include('oficinas._ficha')
@include('oficinas._editpersonal')
@include('oficinas._editsupervisor')
@include('oficinas._newsupervisor')
@include('oficinas._newpersonal')
@include('oficinas._newlistpersonal')
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

    var cleave = new Cleave('.input-phone-new-personal', {
      phone: true,
      phoneRegionCode: 'VE'
    });

    var cleave = new Cleave('.input-phone-edit-personal', {
      phone: true,
      phoneRegionCode: 'VE'
    });

    function fecha(value){
      $('.date_rol_in').prop('disabled', false);
      $('.date_rol_in').attr({
        "min" : value
      });
      $('.date_rol_in').val(value);
      };
</script>
@endsection