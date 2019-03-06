<div class="modal fade" id="desincorporar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('management.update', 'null')}}" method="post">
        @csrf
        @method('patch')
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Desincorporar Trabajador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Nombre: <span id="name"></span></p>
            <p>P00: <span id="p00"></span></p>
            <input type="hidden" id="personal" name="personal">
            <div class="form-group">
                <label for="fecha">Fecha de Retiro</label>
                <input type="date" name="fecha" id="fecha" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Procesar</button>
        </div>
        </div>
    </div>
    </form>
</div>