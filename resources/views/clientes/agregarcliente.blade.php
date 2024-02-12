@extends('layout.admin')

@section("agregar insumo", "Crear un nuevo insumo")

@section('contenido')
<div class="card">
  <h5 class="card-header">Agregar cliente</h5>
  <div class="card-body">
    <p class="card-text">
      <!-- ruta para agregar un nuevo cliente -->
      <form action="{{ route('cliente.store') }}" method="POST" id="formNuevoCliente">
        @csrf
        <!-- formulario de informacion del cliente -->
        <div class="form-group">
          <label for="nombre">Nombre del cliente:</label>
          <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
          <label for="edad">Edad:</label>
          <input type="text" class="form-control" name="edad" id="edad" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
          <label for="telefono">Teléfono:</label>
          <input type="number" class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="" maxlength="10">
          <small id="helpId" class="form-text text-muted">Por favor, ingresa un número de teléfono de 10 dígitos.</small>
        </div>

        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="text" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="">
            <small id="helpId" class="form-text text-muted"></small>
        </div>


        <a href="{{ route('cliente.index') }}" class="btn btn-secondary">Regresar</a>
        <button type="button" class="btn btn-primary" id="guardarNuevo">Agregar</button>
      </form>
    </p>
  </div>
</div>
<!-- verificar informacion del formulario -->
<!-- que no acepte espacios en blanco -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Escuchar el evento input en el campo de nombre
        document.getElementById('nombre').addEventListener('input', function(event) {
            // Convertir el texto a mayúsculas
            this.value = this.value.toUpperCase();
        });

        document.getElementById('guardarNuevo').addEventListener('click', function(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();

            // Obtén los valores de los campos
            var nombre = document.getElementById('nombre').value;
            var edad = document.getElementById('edad').value;
            var telefono = document.getElementById('telefono').value;
            var correo = document.getElementById('correo').value;

            // Realiza la validación
            if (nombre.trim() === '') {
                mostrarError('El campo nombre no puede estar vacío.');
            } else if (edad.trim() === '' || parseInt(edad) < 0) { 
                mostrarError('El campo edad no puede estar vacía o tener numeros negativos.');
            } else if (telefono.trim() === '' || parseInt(telefono) < 0) {
                mostrarError('El campo telefono no puede estar vacío o tener números negativos.');
            } else if (!validarCorreo(correo)) {
                mostrarError('Por favor, ingrese un correo electrónico válido.');
            } else {
                // Si pasa la validación, envía el formulario
                document.getElementById('formNuevoCliente').submit();
            }
        });

        function validarCorreo(correo) {
        // Expresión regular para validar un correo electrónico
        var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regexCorreo.test(correo);
}

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
