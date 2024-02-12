@extends('layout.admin')
@section('contenido')

<!-- Estructura de la tarjeta para mostrar los empleados de la óptica -->
<div class="card">
    <h5 class="card-header">Empleados óptica</h5>
    <div class="card-body">
        <!-- Sección para mostrar mensajes de éxito -->
        <div class="row">
            <div class="col-sm-12">
            @if ($mensaje = Session::get('success'))
                <script>
                    if ("{{ $mensaje }}" === "Master") {
                        setTimeout(function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "¡¡¡¡El trabajador con ID-1 es imposible de eliminar.!!!!",
                                confirmButtonText: 'OK'
                            });
                        }, 100);
                    } else {
                        // Esperar 2 segundos (2000 milisegundos) antes de mostrar el mensaje de Swal
                        setTimeout(function() {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "{{ $mensaje }}",
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }, 100);
                    }
                </script>
            @endif

            </div>
        </div>
        <!-- Botón para agregar una nueva persona -->
        <p>
            <a href="{{ route("usuarios.create") }}" class="btn btn-primary">
                <span class="fas fa-user-plus"></span> Agregar persona
            </a>
        </p>
        <hr>
        <!-- Sección para mostrar la tabla de empleados -->
        <p class="card-text">
            <div class="table table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>ID trabajador</th>
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th>Correo</th>
                        <th> </th>

                    </thead>
                    <tbody>
                        <!-- Iterar sobre los datos y mostrar cada empleado en una fila de la tabla -->
                        @foreach ($datos as $item)
                            <tr>
                                <td>{{ $item->ID_trabajo }}</td>
                                <td>{{ $item->nombre }}</td>
                                <td>{{ $item->puesto }}</td>
                                <td>{{ $item->correo }}</td>

                                <!-- Botón para editar un empleado -->
                                <td>
                                    <div class="center d-flex justify-content-center">
                                        <form action="{{ route("usuarios.edit", $item->ID_trabajo) }}" method="GET">
                                            <button class="btn btn-warning btn-sm mr-2">
                                                <span class="fas fa-user-edit"></span>
                                            </button>
                                        </form>
                                    <!-- Botón para abrir modal de confirmación de eliminación de empleado -->
                                        <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" 
                                            data-target="#confirmDeleteModalinsumo-{{ $item->ID_trabajo}}">
                                            <span class="fas fa-trash-alt"></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </p>
    </div>
</div>

<!-- Modal para confirmar la eliminación del personal -->
@foreach ($datos as $item)
<div class="modal" id="confirmDeleteModalinsumo-{{ $item->ID_trabajo }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-danger text-white">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación de trabajador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <p>¿Está seguro de que desea eliminar este trabajador?</p>
                <h4>{{ $item->nombre}}</h4>
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('usuarios.destroy', $item->ID_trabajo) }}" method="POST">
                     @csrf
                     @method('DELETE')
                    <button type="submit" class="btn btn-success text-white">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection