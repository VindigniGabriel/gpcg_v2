<!-- Modal Editar Horario-->
<div class="modal fade" id="editHorario" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            
                <div class="modal-header">
                <h5 class="modal-title" id="">Editar Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-4 text-center">
                                <span>Día(s)</span>
                            </div>
                            <div class="col-4 text-center">
                                <span>Apertura</span>
                            </div>
                            <div class="col-4 text-center">
                                <span>Cierre</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-4 col-form-label text-center">Lunes:</label>
                            <div class="col-4">
                                <input class="form-control" type="time" value="{{$oficina->lunes_in}}" id="lunes_in">
                            </div>
                            <div class="col-4">
                                <input class="form-control" type="time" value="{{$oficina->lunes_out}}" id="lunes_out">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-4 col-form-label text-center">Martes a Viernes:</label>
                            <div class="col-4">
                                <input class="form-control" type="time" value="{{$oficina->martesviernes_in}}" id="lunes_in">
                            </div>
                            <div class="col-4">
                                <input class="form-control" type="time" value="{{$oficina->martesviernes_out}}" id="lunes_out">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-4 col-form-label text-center">Sábado:</label>
                            <div class="col-4">
                                <input class="form-control" type="time" value="{{$oficina->sabados_in}}" id="lunes_in">
                            </div>
                            <div class="col-4">
                                <input class="form-control" type="time" value="{{$oficina->sabados_out}}" id="lunes_out">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
      