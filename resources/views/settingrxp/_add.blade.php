<!-- Modal add Ajustes personalizados-->
<div class="modal fade" id="ajustesPersonalizados" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Ajuste Personalizado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <form class="form-inline d-flex justify-content-between" action="{{route('settingrxp.store')}}" method="post">
                    @csrf
                <div class="form-group mb-2 mr-2">
                    <input type="text" class="form-control" placeholder="Nombre" name="name">
                </div>
                <div class="form-group mb-2 mr-2">
                    <select class="custom-select" name="goal_id">
                        <option selected value="">Seleccione Ajuste</option>
                        <option value="1">Sin logro</option>
                        <option value="2">Meta Mínima</option>
                        <option value="3">Meta Media</option>
                        <option value="4">Meta Máxima</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Agregar</button>
            </form>
           
      </div>
    </div>
  </div>
</div>