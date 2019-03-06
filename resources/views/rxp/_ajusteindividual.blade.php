<div class="modal fade" id="ajusteGlobal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajuste Global</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('ajustes.update', $month->id)}}" method="post">
            @method('patch')
            @csrf
        <div class="modal-body">
        <div class="container">
            <div class="mt-2 d-flex justify-content-between">
                <span class="lead">Seleccione Oficina(s)</span>
                <div class="custom-control custom-checkbox col-4 text-left">
                    <input type="checkbox" class="custom-control-input" id="allOficinas" value="allOficinas">
                    <label class="custom-control-label" for="allOficinas">Todas las Oficinas</label>
                </div>
            </div>
            <div class="mt-4">
                @foreach ($direccions as $direccion)
                    <p class="text-uppercase font-weight-bold">{{$direccion->name}}</p>
                    <div class="row my-2">
                    @forelse ($direccion->oficinas as $oficina)
                        <div class="custom-control custom-checkbox col-2 text-left ml-4">
                            <input type="checkbox" class="custom-control-input checkOficinas" id="{{$oficina->name}}" name="ajusteOficina[]" value="{{$oficina->name}}">
                            <label class="custom-control-label" for="{{$oficina->name}}">{{$oficina->name}}</label>
                        </div>
                    @empty
                        <p>No hay Oficinas para esta Dirección</p>
                    @endforelse
                    </div>
                @endforeach
            </div>
            <div class="d-none" id="ajusteRoles">
                <div class="mt-2  d-flex justify-content-between">
                    <span class="lead">Seleccione Rol(es)</span>
                    <div class="custom-control custom-checkbox col-4 text-left">
                        <input type="checkbox" class="custom-control-input" id="allRoles" value="allRoles">
                        <label class="custom-control-label" for="allRoles">Todos los Roles</label>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($rols as $rol)
                        <div class="custom-control custom-checkbox col-2 text-left ml-4">
                            <input type="checkbox" class="custom-control-input checkRoles" id="{{$rol->name}}" name="ajusteRoles[]" value="{{$rol->name}}">
                            <label class="custom-control-label" for="{{$rol->name}}">{{$rol->name}}</label>
                        </div> 
                    @endforeach
                </div>  
            </div>
            <div class="d-none" id="ajusteIndividuals">
                <div class="mt-2  d-flex justify-content-between">
                    <span class="lead">Seleccione Indicador(es) Individual(es)</span>
                    <div class="custom-control custom-checkbox col-4 text-left">
                        <input type="checkbox" class="custom-control-input" id="allIndividuals" value="allIndividuals">
                        <label class="custom-control-label" for="allIndividuals">Todos los Indicadores</label>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($indicadorsIndividuals as $indicador)
                        <div class="custom-control custom-checkbox col-2 text-left ml-4">
                            <input type="checkbox" class="custom-control-input checkIndividuales" id="s{{$indicador->name}}" name="ajusteIndividuales[]" value="{{$indicador->name}}">
                            <label class="custom-control-label" for="s{{$indicador->name}}">{{$indicador->name}}</label>
                        </div> 
                    @endforeach
                </div>
            </div>
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
                Procesar Ajuste
            </button>
        </div>
        </form>
        </div>
    </div>
</div>