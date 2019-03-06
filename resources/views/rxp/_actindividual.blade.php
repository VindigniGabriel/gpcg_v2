<div class="modal fade" id="actValoresIndividuales" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Actualizar Indicadores Individuales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('individual.update', $month->id)}}" method="post">
            @method('patch')
            @csrf
        <input type="hidden" name="personal_id" id="personal_id">
        <div class="modal-body">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" id="name"></h5>
                    <h6 class="card-subtitle mb-2 text-muted" id="p00"></h6>
                    <p class="card-text" id="rol"></p>
                    <p class="card-text" id="oficina"></p>
                </div>
            </div>

            <div class="container">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr class="th">
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="td">
                            </tr>
                            <tr class="time">
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