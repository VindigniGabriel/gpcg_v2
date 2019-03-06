<!doctype html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  </head>
  <body>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
                <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">{{ config('app.name')}}</a>
                @guest
                
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Salir') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
              </nav>
          
              <div class="container-fluid">
                <div class="row">
                  <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>DATA</span>
                            <a class="d-flex align-items-center text-muted" href="#">
                              <span data-feather="plus-circle"></span>
                            </a>
                          </h6>
                      <ul class="nav flex-column">
                        <li class="nav-item">
                        <a class="nav-link {{ setActive('direcciones.index') }}" href="{{route('direcciones.index')}}">
                            <span data-feather="settings"></span>
                            Direcciones
                          </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ setActive('gerencias.index') }}" href="{{route('gerencias.index')}}">
                              <span data-feather="trending-up"></span>
                              Gerencias
                            </a>
                          </li>
                        <li class="nav-item">
                          <a class="nav-link  {{ setActive('oficinas.index') }}" href="{{route('oficinas.index')}}">
                            <span data-feather="list"></span>
                            Oficinas
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link  {{ setActive('management.index') }}" href="{{route('management.index')}}">
                            <span data-feather="list"></span>
                            Personal
                          </a>
                        </li>
                       
                        
                      </ul>
          
          
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>RxP</span>
                        </h6>
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link  {{ setActive('indicadores.index') }}" href="{{route('indicadores.index')}}">
                            <span data-feather="align-justify"></span>
                            Indicadores
                          </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link  {{ setActive('indicadorrols.index') }}" href="{{route('indicadorrols.index')}}">
                            <span data-feather="users"></span>
                            Indicadores - Roles
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link  {{ setActive('configurarmes.index') }}" href="{{route('configurarmes.index')}}">
                            <span data-feather="git-merge"></span>
                            Mes-RxP
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link  {{ setActive('settingrxp.index') }}" href="{{route('settingrxp.index')}}">
                            <span data-feather="git-merge"></span>
                            Configuraciones
                          </a>
                        </li>
                      </ul>
          
                    </div>
                  </nav>
          
                  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title2')</h1>
                      <div class="btn-toolbar mb-2 mb-md-0">
                        @yield('opciones')
                      </div>
                    </div>

                    <div class="container">
                        @yield('content')
                    </div>
          
                  </main>
                </div>
              </div>
      <script src="/js/app.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.4.7/cleave.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.4.7/addons/cleave-phone.ve.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      @yield('scripts')
      <script>

        $(document).ready( function () {
            $('#table').DataTable({
                "language": { 
                    "info":  "Mostrando _START_ a _END_ de _TOTAL_ registros",   
                    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Inicio",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Previa"
                    },
                }
            });
        });
  
          $('#editSupervisor').on('show.bs.modal', function (e) {

            var button = $(e.relatedTarget)
            var name = button.data('name')
            var phone = button.data('phone')
            var email = button.data('email')
            var id = button.data('id')
            var p00 = button.data('p00')
            var turno = button.data('turno')

            var modal = $(this)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #phone').val(phone)
            modal.find('.modal-body #email').val(email)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #p00').val(p00)
            modal.find('.modal-body #turno').val(turno)

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

              var modal = $(this)
              modal.find('.modal-body #name').val(name)
              modal.find('.modal-body #phone').val(phone)
              modal.find('.modal-body #email').val(email)
              modal.find('.modal-body #id').val(id)
              modal.find('.modal-body #p00').val(p00)
              modal.find('.modal-body #rol').val(rol)
              modal.find('.modal-body #ingreso').val(ingreso)
              modal.find('.modal-body #date_rol_in').val(rolin)

            })

            $('#newPersonal').on('show.bs.modal', function(e){

              var button = $(e.relatedTarget)
              var oficina = button.data('oficina')

              var modal = $(this)
              modal.find('.modal-body #oficina').val(oficina)

            })

            $('#editDireccion').on('show.bs.modal', function (e) {

              var button = $(e.relatedTarget)
              var name = button.data('name')
              var phone = button.data('phone')
              var email = button.data('email')
              var alias = button.data('alias')
              var titular = button.data('titular')
              var id = button.data('id')

              var modal = $(this)
              modal.find('.modal-body #name').val(name)
              modal.find('.modal-body #phone').val(phone)
              modal.find('.modal-body #email').val(email)
              modal.find('.modal-body #alias').val(alias)
              modal.find('.modal-body #titular').val(titular)
              modal.find('.modal-body #id').val(id)

            })


                $('#editGerencia').on('show.bs.modal', function (e) {

                var button = $(e.relatedTarget)
                var name = button.data('name')
                var phone = button.data('phone')
                var email = button.data('email')
                var alias = button.data('alias')
                var titular = button.data('titular')
                var direccion = button.data('direccion')
                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #name').val(name)
                modal.find('.modal-body #phone').val(phone)
                modal.find('.modal-body #email').val(email)
                modal.find('.modal-body #alias').val(alias)
                modal.find('.modal-body #titular').val(titular)
                modal.find('.modal-body #direccion').val(direccion)
                modal.find('.modal-body #id').val(id)

              })

              $('#editIndicador').on('show.bs.modal', function (e) {

                var button = $(e.relatedTarget)
                var name = button.data('name')
                var min = button.data('min')
                var med = button.data('med')
                var max = button.data('max')
                var description = button.data('description')
                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #name').val(name)
                modal.find('.modal-body #min').val(min)
                modal.find('.modal-body #med').val(med)
                modal.find('.modal-body #max').val(max)
                modal.find('.modal-body #description').val(description)
                modal.find('.modal-body #id').val(id)

              })

              $('#editOficina').on('show.bs.modal', function (e) {

                var button = $(e.relatedTarget)
                var name = button.data('name')
                var phone = button.data('phone')
                var email = button.data('email')
                var alias = button.data('alias')
                var titular = button.data('titular')
                var direccion_id = button.data('direccion')
                var gerencia_id = button.data('gerencia')
                var tipo = button.data('tipo')
                var ubicacion = button.data('ubicacion')
                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #name').val(name)
                modal.find('.modal-body #phone').val(phone)
                modal.find('.modal-body #email').val(email)
                modal.find('.modal-body #alias').val(alias)
                modal.find('.modal-body #titular').val(titular)
                modal.find('.modal-body #direccionEdit').val(direccion_id)
                modal.find('.modal-body #oficina_tipo_id').val(tipo)
                modal.find('.modal-body #ubicacion').val(ubicacion)
                modal.find('.modal-body #id').val(id)

                $.get('/selectgerencia/' +direccion_id, function(data){
                  $('#gerenciaEdit').empty();
                  $('#gerenciaEdit').append(' <option value="0">Seleccione Ger...</option>');
                  $.each(data, function(index, gerencia){
                    if(gerencia.id == gerencia_id){
                      $('#gerenciaEdit').append(' <option value="'+gerencia.id+'" selected>'+gerencia.name+'</option>');
                    }else{
                      $('#gerenciaEdit').append(' <option value="'+gerencia.id+'">'+gerencia.name+'</option>');
                    }
                  })
                })

                modal.find('.modal-body #gerenciaEdit').val(gerencia_id)

              })

          $('#direccion').on('change', function(e){
            var direccion_id = e.target.value;
            $.get('/selectgerencia/' +direccion_id, function(data){
              $('#gerencia').empty();
              $('#gerencia').append(' <option selected value="0">Seleccione Ger...</option>');
              $.each(data, function(index, gerencia){
                $('#gerencia').append(' <option value="'+gerencia.id+'">'+gerencia.name+'</option>');
              })
            })
          })

          $('#direccionEdit').on('change', function(e){
            var direccion_id = e.target.value;
            $.get('/selectgerencia/' +direccion_id, function(data){
              $('#gerenciaEdit').empty();
              $('#gerenciaEdit').append(' <option selected value="0">Seleccione Ger...</option>');
              $.each(data, function(index, gerencia){
                $('#gerenciaEdit').append(' <option value="'+gerencia.id+'">'+gerencia.name+'</option>');
              })
            })
          })

          $('.btn-delete').on('click', function(e){
            if(confirm('¿Esta seguro que desea borrar este registro?')){
                $(this).parents('form:first').submit();
            }
          });

          $(".ajusteRoles").click(function () {
              $("input:checkbox").prop("checked", false);
              $("#ajusteRoles").removeClass('d-none');
              $("#ajusteIndividuals").addClass('d-none');
          });

          $(".ajusteIndividuales").click(function () {
              $("input:checkbox").prop("checked", false);
              $("#ajusteRoles").addClass('d-none');
              $("#ajusteIndividuals").removeClass('d-none');
          });

          $("#allOficinas").click(function () {
              $(".checkOficinas").prop('checked', $(this).prop('checked'));
          });

          $("#allRoles").click(function () {
              $(".checkRoles").prop('checked', $(this).prop('checked'));
          });

          $("#allIndividuals").click(function () {
              $(".checkIndividuales").prop('checked', $(this).prop('checked'));
          });
          
          $("#allCollectives").click(function () {
            $(".checkColectivos").prop('checked', $(this).prop('checked'));
          });


      </script>
  </body>
</html>