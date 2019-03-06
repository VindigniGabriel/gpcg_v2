@extends('layouts.master')

@section('title2')
Resultados RxP   
@endsection

@section('content')
<table class="table text-center table-sm">
    <thead>
        <tr>
            <th scope="col">P00</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Oficina</th>
            @foreach ($indicadors as $indicador)
                <th>{{$indicador->name}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach ($oficinas as $oficina)
            @foreach ($oficina->personals as $personal)
                <tr>
                <td>{{$personal->p00}}</td>
                <td>{{$personal->name}}</td>
                <td>{{$personal->rol->name}}</td>
                <td>{{$oficina->name}}</td>
                    @foreach ($indicadors as $indicador)
                        @if (in_array($indicador->id, $personal->rol->indicadors->pluck('id')->toArray()))
                            @forelse ($personal->esquemaRxp->where('indicador_id', $indicador->id) as $porcentaje)
                                <td>{{$porcentaje->porcentaje}}</td>
                            @empty
                                <td>S/V</td>
                            @endforelse
                        @else
                            <td>-</td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
    @endforeach
    </tbody>
</table>
@endsection