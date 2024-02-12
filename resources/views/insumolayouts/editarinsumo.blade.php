@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')

<div class="card">
    <h5 class="card-header">Actualizar insumo</h5>
    <div class="card-body">
        <!-- ruta para redireccionar al controlador -->
        <form action="{{ route('insumo.update', $insu->id_insumo) }}" method="POST" id="guardarNuevo">                
            @csrf
            @method("PUT")

            <!-- formulario para edirar la informacion -->
            <div class="form-group">
                <label for="nombre">Nombre del producto:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$insu->nombre_producto}}">
            </div>
            
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca" value="{{$insu->marca}}">
            </div>
            
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio" value="{{$insu->precio}}">
            </div>

            <div class="form-group">
              <label for="cantidad">Cantidad:</label>
              <input type="number" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" value="{{$insu->cantidad}}">
            </div>
            <br>
            <a href="{{ route('insumo.index') }}" class="btn btn-secondary"> Regresar</a>

            <button type="submit" class="btn btn-warning" id="agregar">
                <span class="fas fa-user-edit"></span> Actualizar
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener para el campo de entrada 'cantidad'
        document.getElementById('cantidad').addEventListener('input', function() {
            // Reemplazar cualquier carácter que no sea un número entero
            this.value = this.value.replace(/[^0-9]/g, '');
        });

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
