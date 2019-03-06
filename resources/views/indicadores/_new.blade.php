<!-- Modal Nuevo Indicador -->
<div class="modal fade" id="newIndicador" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Crear Indicador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <form action="{{route('indicadores.store')}}" method="post">
        {{ csrf_field() }}
        <div class="modal-body">
        <div class="form-row text-center">
            <div class="form-group col-md-3">
              <label for="name">Nombre (Alias)</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
            </div>
            <div class="form-group col-md-3">
              <label for="min">Meta Min.</label>
              <input type="number" class="form-control" id="min" name="min" min="0" step=".5">
            </div>
            <div class="form-group col-md-3">
              <label for="med">Meta Med.</label>
              <input type="number" class="form-control" id="med" name="med" min="0" step=".5">
            </div>
            <div class="form-group col-md-3">
                <label for="max">Meta Max.</label>
                <input type="number" class="form-control" id="max" name="max" min="0" step=".5">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <div class="form-group">
                <label for="description">Descripción del Indicador</label>
                <textarea class="form-control" name="description" id="description" rows="2"></textarea>
              </div>
            </div>
          </div>

          <div class="form-group">
        
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
      </div>
    </div>
  </div>