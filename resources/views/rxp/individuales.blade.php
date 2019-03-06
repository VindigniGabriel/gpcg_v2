@extends('layouts.master')

@section('title2')
Resultados RxP Individuales <span>{{$month->month}}</span>  
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
            <a type="button" class="btn btn-sm btn-outline-success" href="/colectivo/{{$month->id}}">
                Colectivos
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
            <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ajustes Indicadores Individuales
            </button>
            <div class="dropdown-menu">
            <a class="dropdown-item btn ajusteRoles" data-toggle="modal" data-target="#ajusteGlobal">
                Filtro Roles
            </a>
            <a class="dropdown-item btn ajusteIndividuales" data-toggle="modal" data-target="#ajusteGlobal">
                Filtro Indicadores
            </a>
            <div class="dropdown-divider"></div>
            @foreach ($settings as $setting)
            <a class="dropdown-item btn" onclick="submitform(this.id)" id="{{$setting->goal_id}}">
                {{$setting->name}}
            </a>  
            @endforeach
           
            </div>
        </div>
    </li>
</ul>
@endsection

@section('content')
@include('notificaciones._notificaciones')
<form action="{{route('ajustes.update', $month->id)}}" method="post" id="selectCheck">
        @method('patch')
        @csrf
        <input type="hidden" id="ajustePersonalizado" name="ajuste">
<table class="table text-center table-sm table-striped mt-4" id="table">
    <thead>
        <tr>
            <th></th>
            <th scope="col">P00</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Oficina</th>
            @foreach ($indicadorsIndividuals as $indicador)
                <th>{{$indicador->name}}</th>
            @endforeach
            <th>% Logro</th>
            <th>% Pago</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($personals as $personal)
       <tr>
            <td>
                <input type="checkbox" class="form-check-input" name="history[]" value="{{$personal->id}}">
            </td>
            <td>
                {{$personal->personal->p00}}
            </td>
            <td>{{$personal->personal->name}}</td>
            <td>{{$personal->rol->name}}</td>
            <td>{{$personal->oficina->name}}</td>
            @foreach ($indicadorsIndividuals as $indicador)
                @if (in_array($indicador->id, $personal->rol->indicadors->pluck('id')->toArray()))
                    @forelse ($personal->esquemaRxp->where('indicador_id', $indicador->id)->where('month_id', $month->id) as $porcentaje)
                        <td>{{$porcentaje->porcentaje}}</td>
                    @empty
                        <td>S/V</td>
                    @endforelse
                @else
                    <td>-</td>
                @endif
            @endforeach
                <td>
                    {{$personal->esquemaRxp->where('history_id', $personal->id)->where('month_id', $month->id)->sum('porcentaje') + $rxpcollectiverols->where('rol_id', $personal->rol->id)->whereIn('rxp_collective_id', $collective->where('oficina_id', $personal->oficina->id)->pluck('id'))->sum('porcentaje_value') + $empresarial}}
                </td>
                <td>
                    {{$personal->rol->sumaesquema($personal->rol->id, $personal->esquemaRxp->where('history_id', $personal->id)->where('month_id', $month->id)->sum('porcentaje') + $rxpcollectiverols->where('rol_id', $personal->rol->id)->whereIn('rxp_collective_id', $collective->where('oficina_id', $personal->oficina->id)->pluck('id'))->sum('porcentaje_value') + $empresarial)}}
                </td>
                <td>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#actValoresIndividuales" data-mes="{{$month->id}}" data-personal="{{$personal->personal->id}}">
                        Act.
                    </button>
                </td>
            </tr>
    @endforeach
    </tbody>
</table>
</form>
@include('rxp._actindividual')
@include('rxp._ajusteindividual')
@endsection

@section('scripts')
    <script src="{{ asset('vendor/indicadoresTimer.js')}}"></script>
    <script type="text/javascript">
        function submitform(value)
        {
            $('#ajustePersonalizado').val(value);
            $( "#selectCheck" ).submit();
        }
    </script>
@endsection
