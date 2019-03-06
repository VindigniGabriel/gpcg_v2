<!-- Modal Nuevo Personal Listado-->
<div class="modal fade" id="newPersonalList" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Agregar Personal a Oficina {{$oficina->name}} desde Archivo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <form action="{{url('import-file')}}" method="post" enctype="multipart/form-data">
          <div class="modal-body">
              <input type="hidden" name="oficina_id" id="oficina" value="{{$oficina->id}}">
              {{ csrf_field() }}
              <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span class="badge badge-primary badge-pill">1</span>
                    Crear una hoja de Excel con los campos P00, Nombre, Correo, Fecha_ingreso, Fecha_cargo 
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span class="badge badge-primary badge-pill">2</span>
                    Llenar los registros en cada columna
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span class="badge badge-primary badge-pill">3</span>
                    Guardar en formato .csv separador coma (',')
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span class="badge badge-primary badge-pill">4</span>
                      Elija el Rol a Asignar
                      <div class="form-row">
                      <select class="custom-select" name="rol_id" id="rol">
                          <option value="" selected>Seleccione un Rol...</option>
                      @foreach ($oficina->oficinaTipo->rols as $rol)
                          <option value="{{$rol->id}}">{{$rol->name}}</option>
                      @endforeach
                      </select>
                      </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span class="badge badge-primary badge-pill">5</span>
                      <div class="form-row">
                        <input type="file" value="" name="personal" id="file" class="form-control">
                      </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span class="badge badge-primary badge-pill">6</span>
                    Clic en el botón Guardar
                  </li>
                </ul>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        </form>
      </div>
    </div>
  </div>