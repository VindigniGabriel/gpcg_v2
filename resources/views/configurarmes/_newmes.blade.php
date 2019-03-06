<div class="modal fade" id="newMes" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Crear Mes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('configurarmes.store')}}" method="post">
        @csrf
      <div class="modal-body">
      <div class="container text-center">
              <div class="alert alert-warning mt-2" role="alert">
                  Advertencia: Se creará un mes con la información actual del personal.
              </div>
              <div class="mt-4">
                  <span>Seleccione mes </span><input type="month" name="month">
              </div>
      </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
              Procesar
          </button>
      </div>
    </form>
    </div>
  </div>
</div>