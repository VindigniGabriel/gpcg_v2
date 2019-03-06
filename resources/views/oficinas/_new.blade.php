<!-- Modal Nueva Oficina-->
<div class="modal fade" id="newOficina" tabindex="-1" role="dialog" aria-labelledby="newOficina" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="">Crear Oficina</h5>
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
            <input type="text" class="form-control" id="name" name="name" placeholder=" Ej. Metrocenter" value="{{old('name')}}">
            </div>
            <div class="form-group col-md-4">
              <label for="alias">Código de la Oficina</label>
              <input type="text" class="form-control" id="alias" name="alias" placeholder="Ej. OC20" value="{{old('alias')}}">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="direcccion">Dirección Comercial</label>
              <select id="direccion" class="form-control" name="direccion_id">
                <option selected value="">Seleccione Dir...</option>
                  @foreach ($direcciones as $dir)
                <option value="{{$dir->id}}">{{$dir->name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="gerencia">Gerencia Comercial</label>
              <select id="gerencia" class="form-control" name="gerencia_id">
                <option selected value="">Seleccione Ger...</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="oficina_tipo_id">Tipo de Oficina</label>
                <select id="oficina_tipo_id" class="form-control" name="oficina_tipo_id">
                  <option value="" selected>Seleccione Tip...</option>
                    @foreach ($oficinaTipos as $oficinaTipo)
                  <option value="{{$oficinaTipo->id}}">{{$oficinaTipo->name}}</option>
                    @endforeach
                </select>
            </div>
          </div>

          <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <input type="text" class="form-control" id="ubicacion" placeholder="" name="ubicacion" value="{{old('ubicacion')}}">
          </div>
          <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>