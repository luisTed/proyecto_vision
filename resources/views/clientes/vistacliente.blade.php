@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')

<div class="card">
    <h5 class="card-header">Mis clientes</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">


@if ($mensaje = Session::get('success'))
    <script>
        // Esperar 2 segundos (2000 milisegundos) antes de mostrar el mensaje de Swal
        setTimeout(function() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{$mensaje}}",
                showConfirmButton: false,
                timer: 3000
            });
        }, 100);
    </script>
@endif


            </div>
        </div>

            <div class="container mt-3">

                <!-- Botón para agregar cliente nuevo -->
                        <a href="{{ route('cliente.create') }}" class="btn btn-primary"><!-- btn-lg para hacer el botón más grande si se agrega -->
                            <!-- mr-2 para agregar un poco de espacio a la derecha del icono-->
                            <span class="fas fa-user-plus mr-2"></span> Agregar cliente
                        </a>

                <!-- Botón para buscar cliente -->
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#Busqueda_cliente">
                        <span class="fas fa-search"></span> Buscar cliente
                    </button>


            </div>

        <hr>
        <p class="card-text">
            <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                    <thead>
                        <!-- titulos de tabla -->
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Adeudo</th>

                    <th></th>
                    </thead>

                    <tbody>
                    
                        @foreach ($datos as $item)
                            <tr>
                                <!-- informacion de los clientes -->
                                <td>{{ $item->nombre}}</td>
                                <td>{{ $item->telefono}}</td>
                                <td><div class="center d-flex justify-content-center">{{ $item->adeudo}}</div></td>
                                <td>   
                                    <div class="center d-flex justify-content-center">
                                        <!-- boton editar cliente -->
                                        <form action="{{route('cliente.edit', $item -> ID_cliente)}}" method="GET">
                                            <button class="btn btn-warning btn-sm mr-2">
                                                <span class="fas fa-user-edit"></span>
                                            </button>
                                        </form>

                                        <!-- boton eliminar cliente -->
                                        <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" 
                                            data-target="#confirmDeleteModalinsumo-{{ $item->ID_cliente}}">
                                            <span class="fas fa-trash-alt"></span>
                                        </button>

                                        <!-- boton para agendar cita -->
                                        <form action="" method="GET">
                                            <button type="button" class="btn btn-primary btn-sm agenda-cita-btn mr-2" data-toggle="modal" data-target="#verModal-{{$item->ID_cliente}}">
                                            <span class="libreta-icon"></span> Agendar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </p>
        {{$datos->links()}}
    </div>
</div>
<!-- Modal para confirmar la eliminación del cliente -->
@foreach ($datos as $item)
<div class="modal" id="confirmDeleteModalinsumo-{{ $item->ID_cliente }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-danger text-white">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación de cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white"> <!-- Aplicar fondo blanco al cuerpo del modal -->
                <p>¿Está seguro de que desea eliminar este cliente?</p>
                <h4>{{ $item->nombre}}</h4>
            </div>
            <div class="modal-footer bg-white"> <!-- Aplicar fondo blanco al pie del modal -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('cliente.destroy', $item->ID_cliente) }}" method="POST">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-success text-white">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach



<!-- Modal de búsqueda de cliente -->
<div class="modal" id="Busqueda_cliente" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-primary text-white">
            <div class="modal-header">
                <h5 class="modal-title text-white">Busqueda de cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white"> <!-- Aplicar el fondo blanco al cuerpo del modal -->
                <form id="busquedacliente" action="{{ route('cliente.show') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="clienteNombre">Ingrese el nombre del cliente</label>
                        <input type="text" class="form-control" name="clienteNombre" id="clienteNombre" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer  bg-white">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="botonBuscarcliente">Buscar</button>
            </div>
        </div>
    </div>
</div>

<!-- modal para buscar la cita -->

    <!-- modal para cuando se preicona la fecha -->
    @foreach ($datos as $item)
    <div class="modal" id="verModal-{{$item->ID_cliente}}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary" >
        <h5 class="modal-title text-white">Consulta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- formulario para recoleccion de datos -->
        <form id="busquedacliente-{{$item->ID_cliente}}" action="{{ route('consulta.consultacliente',$item->ID_cliente) }}" method="POST">
        @csrf
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="POST">


            <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="" value="2023-11-04">
            <small id="helpId" class="form-text text-muted">Ejemplo: 2023-11-04</small>
          </div>

          <div class="form-group">
            <label for="hora">Hora</label>
            <input type="time" class="form-control" name="hora" id="hora" aria-describedby="helpId" placeholder="" value="12:00">
            <small id="helpId" class="form-text text-muted">Ejemplo: 12:00</small>
          </div>


          <div class="form-group">
            <label for="descripccion">Descripción</label>
            <textarea class="form-control" name="descripccion" id="descripccion" rows="3"></textarea>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>

      </div> 
        </div>
    </div>
  </div>
</div>
@endforeach

<!-- pasar informacion del modal al controlador -->
<script>
    document.getElementById('botonBuscarcliente').addEventListener('click', function() {
        document.getElementById('busquedacliente').submit();
    });
</script>


@endsection