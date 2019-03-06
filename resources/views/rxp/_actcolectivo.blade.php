<div class="modal fade" id="actValoresColectivos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Actualizar Indicadores Colectivos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('colectivo.update', $month->id)}}" method="post">
            @method('patch')
            @csrf
        <input type="hidden" name="oficina_id" id="oficina_id">
        <div class="modal-body">
            <span>Oficina: </span><span class="lead" id="name"></span>

            <div class="container">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr class="th">
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="td">
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
                Actualizar Indicadores
            </button>
        </div>
        </form>
        </div>
    </div>
</div>