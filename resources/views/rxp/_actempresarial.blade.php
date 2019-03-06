<!-- Modal Empresarial-->
<div class="modal fade" id="empresarialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{route('empresarial.update', $month->id)}}" method="post">
            @method('patch')
            @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Indicador Empresarial</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <input type="hidden" value="{{$indicador->id}}" name="id">
            <div class="form-group">
                <label for="direccion">Seleccione Resultado Empresarial</label>
                <select class="custom-select custom-select-sm mt-4" name="ajuste">
                    <option selected>Seleccione Ajuste</option>
                    <option value="1">Sin logro</option>
                    <option value="2">Meta Mínima</option>
                    <option value="3">Meta media</option>
                    <option value="4">Meta Máxima</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
            Procesar
        </button>
      </div>
    </div>
    </form>
  </div>
</div>