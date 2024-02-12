@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')
<div class="card">
    <h5 class="card-header">Agregar trabajador</h5>
    <div class="card-body">
        
        <p class="card-text">
            <!-- Formulario para agregar nuevo trabajador -->
            <form action="{{ route('usuarios.store') }}" method="POST" id="guardarNuevo">

                <!-- Token de seguridad CSRF -->
                @csrf

                <!-- Campo para ingresar el nombre del trabajador (requerido) -->
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="">
                </div>
                <!-- Campo para ingresar el puesto del trabajador (requerido) -->
                <div class="form-group">
                    <label for="puesto">Puesto:</label>
                    <input type="text" class="form-control" id="puesto" name="puesto" value="">
                </div>
                <!-- Campo para ingresar la contraseña del trabajador (requerido) -->
                <div class="form-group">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" class="form-control" id="contraseña" name="contraseña" value="">
                </div>
                <div class="form-group">
                    <label for="contraseña2">Rectifique la cotraseña:</label>
                    <input type="password" class="form-control" id="contraseña2" name="contraseña2" value="">
                </div>
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="text" class="form-control" id="correo" name="correo" value="">
                </div>
<br>
                <!-- Botón para regresar a la lista de trabajadores -->
                <a href="{{ route("usuarios.index") }}" class="btn btn-secondary">Cancelar</a>

                <!-- Botón para agregar nuevo trabajador (se desactivará si el formulario no está lleno) -->
                <button class="btn btn-primary" id="agregar" >
                    <span class="fas fa-user-plus"></span> Agregar
                </button>
            </form>
        </p>
    </div>
</div>

<!-- Script para desactivar el botón si el formulario no está lleno -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('agregar').addEventListener('click', function(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();

            // Obtén los valores de los campos
            var nombre = document.getElementById('nombre').value;
            var puesto = document.getElementById('puesto').value;
            var contraseña = document.getElementById('contraseña').value;
            var contraseña2 = document.getElementById('contraseña2').value;
            var correo = document.getElementById('correo').value;
            // Realiza la validación
            if       (nombre.trim() === '') {
                mostrarError('El campo nombre no puede estar vacío.');
            }else if (puesto.trim() === '' ) {
                mostrarError('El campo puesto no puede estar vacío.');
            }else if (contraseña.trim() === '') {
                mostrarError('El campo contraseña no puede estar vacío.');
            }else if (contraseña2.trim() === '' ) {//|| parseInt(edad) === 0
                mostrarError('El campo contraseña no puede estar vacío.');
            }else if (contraseña2 !== contraseña) {//|| parseInt(edad) === 0
                mostrarError('No coinciden las contraseñas');
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