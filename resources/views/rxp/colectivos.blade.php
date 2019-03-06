@extends('layouts.master')

@section('title2')
Resultados RxP Colectivo <span>{{$month->month}}</span>  
@endsection

@section('opciones')
<ul class="nav nav-pills nav-fill">
    <li class="nav-item mr-2">
        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Descargar
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="{{ route('reporte.rxp.file',['type'=>'xls', 'id'=>$month->id]) }}">Reporte RxP {{$month->month}}.xls</a>
            <a class="dropdown-item" href="{{ route('reporte.rxp.file',['type'=>'xlsx', 'id'=>$month->id]) }}">Reporte RxP {{$month->month}}.xlsx</a>
            <a class="dropdown-item" href="{{ route('reporte.rxp.file',['type'=>'csv', 'id'=>$month->id]) }}">Reporte RxP {{$month->month}}.csv</a>
        </div>
    </li>
    <li class="nav-item mr-2">
        <div class="btn-group dropleft">
            <a type="button" class="btn btn-sm btn-outline-primary" href="/individual/{{$month->id}}">
                Individuales
            </a>
        </div>
    </li>
    <li class="nav-item mr-2">
        <div class="btn-group dropleft">
            <a type="button" class="btn btn-sm btn-outline-dark" href="/empresarial/{{$month->id}}">
                Empresarial
            </a>
        </div>
    </li>
    <li class="nav-item mr-2">
        <div class="btn-group dropleft">
            <button type="button" class="btn btn-outline-success btn-sm ajusteColectivos" data-toggle="modal" data-target="#ajusteGlobal">
            Ajustes Indicadores Colectivos
            </button>
        </div>
    </li>
</ul>
@endsection

@section('content')

<table class="table text-center table-sm table-striped mt-4"  id="table">
    <thead>
        <tr>
            <th scope="col">Oficina</th>
            <th scope="col">Rol</th>
            @foreach ($collective->unique('indicador_id') as $indicador)
                <th>{{$indicador->indicador->name}}</th>
            @endforeach
            <th></th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($collective->unique('oficina_id') as $oficina) <!-- Collective (filtro por mes id), filtrar por Oficina  -->
            

            <tr>
                <td rowspan="{{count($oficina->rols)}}"> <!-- Conteo roles asociados a la Oficina  -->
                    {{$oficina->oficina->name}} <!-- Nombre de la Oficina -->
                </td>
                @foreach ($oficina->rols as $rol) <!-- Recorre los roles asociados a la Oficina  -->
                <td>
                    {{$rol->name}}    <!-- Nombre del Rol -->
                </td> 

                @foreach ($collective->unique('indicador_id') as $indicador) <!-- Collective (filtro por mes id), filtrar por Indicador  -->


                <!-- Collective (filtro por mes id), Selección por Oficina e Indicador. Si exite agrega el valor del %  -->

                    @foreach ($collective->where('oficina_id', $oficina->oficina_id)->where('indicador_id', $indicador->indicador_id) as $rxp_id)
                        
                        @forelse ($rxpcollectiverols->where('rol_id', $rol->id)->where('rxp_collective_id', $rxp_id->id) as $resultado)
                            <td>
                                {{$resultado->porcentaje_value}}
                            </td>
                        @empty
                            <td>
                                -
                            </td>
                        @endforelse
                        
                    @endforeach
                   

                @endforeach
                    
                @if ($loop->first)
                    <td rowspan="{{count($oficina->rols)}}">
                        <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#actValoresColectivos" data-mes="{{$month->id}}" data-oficina="{{$oficina->oficina->id}}">
                           Actualizar Indicadores
                        </button>
                    </td>
                @endif
                
            </tr>
                
            @endforeach
          
        @endforeach
    </tbody>
</table>

@include('rxp._actcolectivo')
@include('rxp._ajustecolectivo')
@endsection

@section('scripts')
    <script>
            $('#actValoresColectivos').on('show.bs.modal', function (e) {

                var button = $(e.relatedTarget)
                var mes = button.data('mes')
                var oficina = button.data('oficina')
                var modal = $(this)
                $('.th').html('')
                $('.td').html('')
                $('#oficina_id').val(oficina)
            
                axios.get('/collective/' + oficina + '/month/' + mes, {
                        params: {
                            prueba: 12345
                        }
                    })
                    .then(function (response) {
                        $.each(response.data, function (index, value) {
                            $('.th').append('<td>' + value.indicador + '</td>')
                            $('.td').append('<td><input type="number" class="form-control text-center" name="' + value.indicador + '" min="0" step=".5" value="' + value.value + '"></td>')
                            $('#name').html(value.name)
                        });
            
            
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            
            })
    </script> 
@endsection