@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')

<div class="card">
    <h5 class="card-header">Actualizar cliente</h5>
    <div class="card-body">
        <!-- ruta al controlador cliente -->
        <form action="{{ route('cliente.update', $buscar->ID_cliente) }}" method="POST" id="formActualizacion">                
            @csrf
            @method("PUT")
            <!-- formulario de informacion -->
            <div class="form-group">
                <label for="nombre">Nombre del cliente:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$buscar->nombre}}">
            </div>
            
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="text" class="form-control" id="edad" name="edad" value="{{$buscar->edad}}">
            </div>
            
            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="numeric" class="form-control" id="telefono" name="telefono" value="{{$buscar->telefono}}">
            </div>

            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="text" class="form-control" id="correo" name="correo" value="{{$buscar->correo}}">
            </div>


            <div class="form-group">
                <label for="adeudo">Adeudo:</label>
                <input type="numeric" class="form-control" id="adeudo" name="adeudo" value="{{$buscar->adeudo}}">
            </div>
            <br>
            <a href="{{ route('cliente.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
            <button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#confirmacionModal">
                <span class="fas fa-user-edit"></span> Actualizar
            </button>
        </form>
    </div>
</div>
<!-- comprobacion de la informacion del formulario -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener referencia al campo de nombre
        const campoNombre = document.getElementById('nombre');

        // Escuchar el evento input en el campo de nombre
        campoNombre.addEventListener('input', function(event) {
            // Convertir el texto a mayúsculas
            this.value = this.value.toUpperCase();
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
    // Escuchar el evento click en el botón de enviar formulario
    document.querySelector('button[type="submit"]').addEventListener('click', function(event) {
        // Evitar el envío automático del formulario
        event.preventDefault();

        // Obtener el valor del campo de correo electrónico
        var correo = document.getElementById('correo').value;

        // Realizar la validación del correo electrónico
        if (!validarCorreo(correo)) {
            // Mostrar un mensaje de error si el correo electrónico no es válido
            mostrarError('Por favor, ingrese un correo electrónico válido.');
        } else {
            // Si pasa la validación, enviar el formulario
            document.getElementById('formActualizacion').submit();
        }
    });
});

function validarCorreo(correo) {
    // Expresión regular para validar el formato de correo electrónico
    var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regexCorreo.test(correo);
}

function mostrarError(mensaje) {
    // Mostrar un mensaje de error utilizando SweetAlert2
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: mensaje,
        confirmButtonText: 'OK'
    });
}

</script>

@endsection
