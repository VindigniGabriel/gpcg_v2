<!-- Modal Editar Supervisor -->
<div class="modal fade" id="editSupervisor" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{route('supervisor.update', 'o')}}" method="post">
      <div class="modal-body">
          @method('patch')
          {{ csrf_field() }}
          <input type="hidden" name="id" id="id">
          <div class="form-row">
              <div class="form-group col-md-4">
                  <label for="p00">P00</label>
                  <input type="text" name="p00" id="p00" class="form-control">
              </div>
              <div class="form-group col-md-8">
                  <label for="name">Nombre</label>
                  <input type="text" name="name" id="name" class="form-control">
              </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="phone">Télefono</label>
                    <input type="text" name="phone" id="phone" class="form-control input-phone-edit" placeholder="0416 6XXXXXX">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">E-Mail</label>
                <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group col-md-2">
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