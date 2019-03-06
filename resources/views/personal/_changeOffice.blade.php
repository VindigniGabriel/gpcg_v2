<div class="modal fade" id="changeOffice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('management.store')}}" method="post">
        @csrf
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Transferencia de Oficina</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="personalId" name="personalId">
            <div class="form-group">
                <label for="oficina">Transferencia desde Oficina <span id="oficinaSalida" class="text-primary font-weight-bold"> </span> a <span id="oficinaEntrada" class="text-success font-weight-bold"> </span></label>
                <select id="oficina" class="form-control" name="oficina">
                <option value="" selected>Seleccione Oficina</option>
                    @foreach ($oficinas as $oficina)
                <option value="{{$oficina->id}}">{{$oficina->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rol">Transferencia con el Rol</label>
                <select id="rol" class="form-control" name="rol">
                </select>
            </div>
            <div class="form-group">
                <label for="ingreso">Fecha de Transferencia</label>
                <input type="date" name="fecha" id="ingreso" class="form-control" value="{{ old('date_in') }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Procesar</button>
        </div>
        </div>
    </div>
    </form>
</div>