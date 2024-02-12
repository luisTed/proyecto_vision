@extends('layout.admin')

@section("agregar insumo", "Crear un nuevo insumo")

@section('contenido')
<div class="card">
  <h5 class="card-header">Agregar insumo</h5>
  <div class="card-body">
    <p class="card-text">
      <!-- ruta para agregar un nuevo unsumo -->
      <form action="{{ route('insumo.store') }}" method="POST" id="guardarNuevo">
        @csrf
        <!-- formulario para crear nuevo insumo -->
            <div class="form-group">
              <label for="nombre">Nombre del insumo:</label>
              <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="">
              <small id="helpId" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
              <label for="marca">Marca:</label>
              <input type="text" class="form-control" name="marca" id="marca" aria-describedby="helpId" placeholder="">
              <small id="helpId" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="" step="1">
                <small id="helpId" class="form-text text-muted"></small>
            </div>


            <!-- area de botones -->
            <a href="{{ route('insumo.index') }}" class="btn btn-secondary">cancelar</a>
            <button type="submit" class="btn btn-primary" id="agregar" >Agregar</button>
     </form>
    </p>
  </div>
</div>
<!-- verificacion de formulario -->
<!-- que no acepte espacios en blanco -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('agregar').addEventListener('click', function(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();

            // Obtén los valores de los campos
            var nombre = document.getElementById('nombre').value;
            var marca = document.getElementById('marca').value;
            var precio = document.getElementById('precio').value;
            var cantidad = document.getElementById('cantidad').value;
            // Realiza la validación
            if       (nombre.trim() === '') {
                mostrarError('El campo nombre no puede estar vacío.');
            }else if (marca.trim() === '' ) {
                mostrarError('El campo marca no puede estar vacío.');
            }else if (precio.trim() === '' || parseInt(precio) < 0) {
                mostrarError('El campo precio no puede estar vacío o tener números negativos.');
            }else if (cantidad.trim() === '' || parseInt(cantidad) < 0) {//|| parseInt(edad) === 0
                mostrarError('El campo cantidad no puede estar vacío o tener números negativos.');
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