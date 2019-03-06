<!-- Modal Editar Gerencia -->
<div class="modal fade" id="editGerencia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Gerencia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <form action="{{route('gerencias.update', 'o')}}" method="post">
        @method('patch')
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-row">
            <input type="hidden" id="id" name="id" value="">
            <div class="form-group col-md-8">
              <label for="name">Nombre de la Gerencia Comercial</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group col-md-4">
              <label for="alias">Alias</label>
              <input type="text" class="form-control" id="alias" name="alias">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="titular">Titular</label>
              <input type="text" class="form-control" id="titular" name="titular">
            </div>
            <div class="form-group col-md-4">
              <label for="phone">Teléfono</label>
              <input type="text" class="form-control input-phone-edit" id="phone" placeholder="0416 6XXXXXX" name="phone">
            </div>
            <div class="form-group col-md-4">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="" name="email">
            </div>
          </div>
          <div class="form-group" @isset($direccion) hidden @endisset>
            <label for="direccion">Pertenece a la Dirección Comercial</label>
            <select class="form-control" id="direccion" name="direccion_id">
              @foreach ($direcciones as $direccion)
            <option value="{{$direccion->id}}">{{$direccion->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
      </div>
    </div>
  </div>