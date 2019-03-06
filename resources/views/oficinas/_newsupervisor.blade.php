<!-- Modal Nuevo Supervisor -->
<div class="modal fade" id="newSupervisor" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Supervisor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{route('supervisor.store')}}" method="post">
      <div class="modal-body">
          {{ csrf_field() }}
          <input type="hidden" name="oficina_id" value="{{$oficina->id}}">
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
                    <input type="text" name="phone" id="phone" class="form-control input-phone-new" value="{{ old('phone') }}" placeholder="0416 6XXXXXX">
                </div>
                <div class="form-group col-md-5">
                    <label for="email">E-Mail</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="turno">Turno</label>
                    <select class="custom-select" name="turno_id" id="turno">
                        @foreach ($turnos as $turno)
                            <option value="{{$turno->id}}">{{$turno->name}}</option>
                        @endforeach
                    </select>
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