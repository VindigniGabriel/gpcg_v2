<!-- Modal Editar Personal -->
<div class="modal fade" id="editPersonal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <form action="{{route('personal.update', $oficina->id)}}" method="post">
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
                        <input type="text" name="phone" id="phone" class="form-control input-phone-edit-personal">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="email">E-Mail</label>
                    <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="rol">Rol</label>
                        <select class="custom-select" name="rol_id" id="rol">
                            @foreach ($oficina->oficinaTipo->rols as $rol)
                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ingreso">Fecha de Ingreso</label>
                        <input type="date" name="date_in" id="ingreso" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_rol_in">Fecha Asignación Rol</label>
                        <input type="date" name="date_rol_in" id="date_rol_in" class="form-control">
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