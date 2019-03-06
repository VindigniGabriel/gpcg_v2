@extends('layouts.master')
@section('title2')
    Gestión del Personal Activo
@endsection

@section('opciones')

@endsection
@section('content')
@include('notificaciones._notificaciones')
<table class="table table-striped mt-4 text-center table-sm" id="table">
    <thead>
      <tr>
        <th>P00</th>
        <th>Nombre</th>
        <th>Rol</th>
        <th>Oficina</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
        @forelse ($oficinas as $oficina)
            @foreach ($oficina->history->where('active', 1) as $personal)
                <tr>
                    <td>
                        {{$personal->personal->p00}}
                    </td>
                    <td>
                        {{$personal->personal->name}}
                    </td>
                    <td>
                        {{$personal->rol->name}}
                    </td>
                    <td>
                        {{$oficina->name}}
                    </td>
                    <td>
                        <a href="{{route('history.show', $personal->personal->id)}}" class="btn btn-outline-info btn-sm" type="button">
                            Detalle
                        </a>
                    </td>
                    <td>
                    <button class="btn btn-outline-dark btn-sm" type="button" data-oficina="{{$oficina->name}}" data-oficinaid="{{$oficina->id}}" data-personal="{{$personal->personal->id}}" data-toggle="modal" data-target="#changeOffice">
                            Cambio de Oficina
                        </button>
                    </td>
                    <td>
                    <button class="btn btn-outline-danger btn-sm" type="button" data-name="{{$personal->personal->name}}" data-p00="{{$personal->personal->p00}}" data-personal="{{$personal->personal->id}}" data-toggle="modal" data-target="#desincorporar">
                        Desincorporar
                    </button>                         
                    </td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="6">
                    No hay registros para mostrar.
                </td>
            </tr>
        @endforelse
        
    <tbody>
    </tbody>
</table>

@include('personal._changeOffice')
@include('personal._exit')

@endsection

@section('scripts')
    
    <script>
        $('#changeOffice').on('show.bs.modal', function (e) {

            var button = $(e.relatedTarget)
            var oficina = button.data('oficina')
            var id = button.data('oficinaid')
            var personal = button.data('personal')

            var modal = $(this)
            modal.find('.modal-body #oficinaSalida').html(oficina)
            document.getElementById("oficina").options[id].disabled = true;
            $('#personalId').val(personal)
        })

        $('#desincorporar').on('show.bs.modal', function (e) {

            var button = $(e.relatedTarget)
            var personal = button.data('personal')
            var name = button.data('name')
            var p00 = button.data('p00')
            var modal = $(this)
            modal.find('.modal-body #name').html(name)
            modal.find('.modal-body #p00').html(p00)
            $('#personal').val(personal)
        })


        $('#oficina').on('change', event => {
            $('#rol').empty()
            $('#oficinaEntrada').html($('#oficina').find('option:selected').text())
            axios({
                method:'get',
                url:'/oficinarol/'+event.target.value,
                responseType:'json'
            })
                .then(function (response) {
                    console.log(response.data)
                    $.each(response.data, function (index, value) {
                        var option = document.createElement("option");
                        option.value = value.id
                        option.text = value.name
                        $('#rol').append(option)
                    })


            });
        })
    </script>

@endsection
