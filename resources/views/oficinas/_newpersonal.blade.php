<!-- Modal Nuevo Personal -->
<div class="modal fade" id="newPersonal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Agregar Personal a Oficina {{$oficina->name}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <form action="{{route('personal.store')}}" method="post">
          <div class="modal-body">
              {{ csrf_field() }}
              <input type="hidden" name="oficina_id" id="oficina">
                <div class="form-row">
                  <div class="form-group col-md-4">
                      <label for="p00">P00</label>
                      <input type="text" name="p00" id="p00" class="form-control" value="{{ old('p00') }}">
                  </div>
                  <div class="form-group col-md-8">
                      <label for="name">Nombre</label>
                      <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                  </div>
                </div>
    
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="phone">Télefono</label>
                        <input type="text" name="phone" id="phone" class="form-control input-phone-new-personal" value="{{ old('phone') }}" placeholder="0416 6XXXXXX">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="email">E-Mail</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="rol">Rol</label>
                        <select class="custom-select" name="rol_id" id="rol">
                                <option value="" selected>Seleccione un Rol...</option>
                            @foreach ($oficina->oficinaTipo->rols as $rol)
                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ingreso">Fecha de Ingreso</label>
                        <input type="date" name="date_in" id="ingreso" class="form-control" value="{{ old('date_in') }}" onchange="fecha(this.value)">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_rol_in">Fecha Asignación Rol</label>
                        <input type="date" name="date_rol_in" id="date_rol_in" min="" class="form-control date_rol_in" disabled>
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