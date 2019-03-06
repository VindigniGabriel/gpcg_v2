@extends('layouts.master')

@section('title2')
    Modificar Personal de {{ $office->name}} en el RxP {{ $month->month }}
@endsection

@section('content')
@include('notificaciones._notificaciones')
<table class="table text-center table-striped mt-4 table-sm" id="table">
    <thead>
        <tr>
            <th scope="col">P00</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($personalOc->unique('history_id') as $personal)
            <tr>
                <td>
                    {{ $personal->history->personal->p00 }}
                </td>
                <td>
                    {{ $personal->history->personal->name }}
                </td>
                <td>
                    {{ $personal->history->rol->name }}
                </td>
                <td>
                    <button class="btn btn-outline-success btn-sm" type="button" data-month="{{ $month->id }}" data-p00="{{$personal->history->personal->p00}}" data-id="{{$personal->history->personal->id}}" data-name="{{$personal->history->personal->name}}" data-phone="{{$personal->history->personal->phone}}" data-email="{{$personal->history->personal->email}}" data-rol="{{$personal->history->rol_id}}" data-ingreso="{{$personal->history->personal->date_in}}" data-rolin="{{$personal->history->date_rol_in}}" data-toggle="modal" data-target="#editPersonal">
                        Editar
                    </button>
                </td>
                <td>
                <button class="btn btn-sm btn-outline-primary" type="button" data-month="{{ $month->id }}" data-oficinaid="{{$office->id}}" data-oficina="{{ $office->name }}" data-personal="{{  $personal->history->personal->id }}" data-toggle="modal" data-target="#changeOffice">
                        Transf. Oficina
                    </button>
                </td>
                <td>
                    <button class="btn btn-outline-danger btn-sm" type="button" data-name="{{$personal->history->personal->name}}" data-p00="{{$personal->history->personal->p00}}" data-personal="{{$personal->history->personal->id}}" data-toggle="modal" data-target="#desincorporar">
                        Desincorporar
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('statuspersonalrxp._changeOffice')
@include('statuspersonalrxp._editpersonal')
@include('statuspersonalrxp._exit')
@endsection

@section('scripts')
    
    <script>
        $('#changeOffice').on('show.bs.modal', function (e) {

            var button = $(e.relatedTarget)
            var oficina = button.data('oficina')
            var id = button.data('oficinaid')
            var personal = button.data('personal')
            var month = button.data('month')

            var modal = $(this)
            modal.find('.modal-body #oficinaSalida').html(oficina)
            modal.find('.modal-body #month').val(month)
            document.getElementById("oficina").options[id].disabled = true;
            $('#personalId').val(personal)
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

        $('#editPersonal').on('show.bs.modal', function (e) {

            var button = $(e.relatedTarget)
            var name = button.data('name')
            var phone = button.data('phone')
            var email = button.data('email')
            var id = button.data('id')
            var p00 = button.data('p00')
            var rol = button.data('rol')
            var ingreso = button.data('ingreso')
            var rolin = button.data('rolin')
            var month = button.data('month')

            var modal = $(this)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #phone').val(phone)
            modal.find('.modal-body #email').val(email)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #p00').val(p00)
            modal.find('.modal-body #rol').val(rol)
            modal.find('.modal-body #ingreso').val(ingreso)
            modal.find('.modal-body #date_rol_in').val(rolin)
            modal.find('.modal-body #month').val(month)

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
        
    </script>

@endsection