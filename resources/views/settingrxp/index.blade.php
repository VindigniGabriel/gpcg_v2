@extends('layouts.master')

@section('title2')
Configuraciones RxP   
@endsection

@section('content')
@include('notificaciones._notificaciones')
<div class="row">
    <div class="col-md-12">
        <div class="card border-dark mb-3">
            <div class="card-header d-flex justify-content-between">Ajustes Personalizadas (max. 4)
            <div>
                <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#ajustesPersonalizados" {{(count($settings) > 3) ? 'disabled' : ''}}>
                    Agregar
                </button>
                <button class="btn btn-sm btn-outline-success"  onclick="submitform()">
                    Actualizar
                </button>
            </div>
            </div>
            <div class="card-body text-dark">
                <table class="table text-center table-striped table-sm">
                    <thead>
                      <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ajuste Establecido</th>
                        <th></th>
                      </tr>
                    </thead>
                    <form action="{{route('settingrxp.update', '1' )}}" method="post" id="actualizarAjustesPersonalizados">
                            @method('patch')
                            @csrf
                        @forelse ($settings as $setting)
                            <tr>
                                <td>
                                    <input type="hidden" name="id[]" value="{{$setting->id}}">
                                    {{$setting->name}}
                                </td>
                                <td>
                                    <select class="custom-select custom-select-sm" name="goal_id[]">
                                        <option value="1" {{($setting->goal_id === 1) ? 'selected': ''}}>Sin logro</option>
                                        <option value="2" {{($setting->goal_id === 2) ? 'selected': ''}}>Meta Mínima</option>
                                        <option value="3" {{($setting->goal_id === 3) ? 'selected': ''}}>Meta Media</option>
                                        <option value="4" {{($setting->goal_id === 4) ? 'selected': ''}}>Meta Máxima</option>
                                    </select>
                                </td>
                                <td>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteAjuste(this.id)" id="{{$setting->id}}" type="button">
                                    Eliminar
                                </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">
                                    No hay Ajustes Personalizados
                                </td>
                            </tr>
                        @endforelse
                    </form>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('settingrxp._add')
@endsection

@section('scripts')
    <script type="text/javascript">
        function submitform()
        {
            $( "#actualizarAjustesPersonalizados" ).submit();
        }
        function deleteAjuste(value)
        {
            if(confirm('¿Esta seguro que desea eliminar este ajuste?')){
                axios.delete('/settingrxp/' + value)
                location.reload()
            }
        }
    </script>
@endsection