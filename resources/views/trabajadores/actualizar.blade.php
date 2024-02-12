@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')

<div class="card">
    <h5 class="card-header">Actualizar trabajador</h5>
    <div class="card-body">
        <p class="card-text">
            <!-- Formulario para actualizar la información de una persona -->
            <form action="{{ route('usuarios.update', $trabajador->ID_trabajo) }}" method="POST" id="guardarNuevo">

                <!-- Token de seguridad CSRF -->
                @csrf
                <!-- Método de envío PUT para la actualización -->
                @method("PUT")

                <!-- Campo para ingresar el nombre del trabajador (requerido) con valor actual -->
                <div class="form-group">
                    <label for="nombre">Nombre del producto:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$trabajador->nombre}}">
                </div>

                <!-- Campo para ingresar el puesto del trabajador (requerido) con valor actual -->
                <div class="form-group">
                    <label for="puesto">Puesto:</label>
                    <input type="text" class="form-control" id="puesto" name="puesto" value="{{$trabajador->puesto}}">
                </div>

                <!-- Campo para ingresar la contraseña del trabajador (requerido) con valor actual -->
                <div class="form-group">
                    <label for="contraseña">Contraseña:</label>
                    <input type="text" class="form-control" id="contraseña" name="contraseña" value=""><!-- {{$trabajador->contraseña}} -->
                </div>

                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="text" class="form-control" id="correo" name="correo" value="{{$trabajador->correo}}">
                </div>
                <!-- Botón para regresar a la lista de trabajadores -->
                <a href="{{ route("usuarios.index") }}" class="btn btn-secondary"> Regresar</a>

                <!-- Botón para actualizar la información del trabajador -->
                <button type="submit" class="btn btn-warning" id="btnActualizar" >
                    <span class="fas fa-user-edit"></span> Actualizar
                </button>
            </form>
        </p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnActualizar').addEventListener('click', function(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();

            // Obtén los valores de los campos
            var nombre = document.getElementById('nombre').value;
            var puesto = document.getElementById('puesto').value;
            var contraseña = document.getElementById('contraseña').value;
            var correo = document.getElementById('correo').value;
            // Realiza la validación
            if       (nombre.trim() === '') {
                mostrarError('El campo nombre no puede estar vacío.');
            }else if (puesto.trim() === '' ) {
                mostrarError('El campo puesto no puede estar vacío.');
            }else if (contraseña.trim() === '') {
                mostrarError('El campo contraseña no puede estar vacío.');
            }else if (correo.trim() === '' ) {//|| parseInt(edad) === 0
                mostrarError('El campo correo no puede estar vacío.');
            }else {
                // Si pasa la validación, envía el formulario
                document.getElementById('guardarNuevo').submit();
            }
        });

        function mostrarError(mensaje) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: mensaje,
                confirmButtonText: 'OK'
            });
        }
    });
</script>

@endsection