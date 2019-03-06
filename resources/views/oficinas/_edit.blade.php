<!-- Modal Editar Oficina-->
<div class="modal fade" id="editOficina" tabindex="-1" role="dialog" aria-labelledby="newOficina" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title" id="">Editar Oficina</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
  
        <div class="modal-body">
          
          <form action="{{route('oficinas.update', 'o')}}" method="post">
            @method('patch')
            {{ csrf_field() }}
            <div class="form-row">
              <input type="hidden" id="id" name="id">
              <div class="form-group col-md-8">
                <label for="name">Nombre de la Oficina</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
              <div class="form-group col-md-4">
                <label for="alias">Código de la Oficina</label>
                <input type="text" class="form-control" id="alias" name="alias">
              </div>
            </div>
  
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="direcccion">Dirección Comercial</label>
                <select id="direccionEdit" class="form-control" name="direccion_id" @isset($oficina) disabled @endisset>
                  <option selected value="0">Seleccione Dir...</option>
                    @foreach ($direcciones as $dir)
                  <option value="{{$dir->id}}">{{$dir->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="gerencia">Gerencia Comercial</label>
                <select id="gerenciaEdit" class="form-control" name="gerencia_id" @isset($oficina) disabled @endisset>
                  <option selected value="0">Seleccione Ger...</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="oficina_tipo_id">Tipo de Oficina</label>
                  <select id="oficina_tipo_id" class="form-control" name="oficina_tipo_id">
                    <option selected>Seleccione Tip...</option>
                      @foreach ($oficinaTipos as $oficinaTipo)
                    <option value="{{$oficinaTipo->id}}">{{$oficinaTipo->name}}</option>
                      @endforeach
                  </select>
              </div>
            </div>
  
            <div class="form-group">
              <label for="ubicacion">Ubicación</label>
              <input type="text" class="form-control" id="ubicacion" placeholder="" name="ubicacion">
            </div>
    
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  