@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')
<div class="card">
  <h5 class="card-header">Agregar armazón</h5>
  <div class="card-body">
    <p class="card-text">
      <!-- ruta del controlador de agregar nuevo armazon -->
      <form action="{{ route('armazones.store') }}" method="POST" id="guardarNuevo">
        @csrf
        <!-- formulario de datos de armazon -->
        <div class="form-group">
          <label for="proveedor">Proveedor:</label>
          <input type="text" class="form-control" name="proveedor" id="proveedor" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
          <label for="marca">Marca:</label>
          <input type="text" class="form-control" name="marca" id="marca" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
          <label for="modelo">Modelo:</label>
          <input type="text" class="form-control" name="modelo" id="modelo" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
          <label for="tamaño">Tamaño:</label>
          <input type="text" class="form-control" name="tamaño" id="tamaño" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
          <label for="tipo">Tipo:</label>
          <input type="text" class="form-control" name="tipo" id="tipo" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="">
            <small id="helpId" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="">
            <small id="helpId" class="form-text text-muted"></small>
        </div>

        <input type="hidden" name="codigoDeBarras" id="codigoDeBarrasInput">
        
        <a href="{{ route('armazones.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary" id="agregar" >Agregar</button>
      </form>
    </p>
  </div>
</div>
<h3 class="text-center">Código de barras</h3>
<!-- variable donde se guarde el codigo de barras -->
<div class="form-group d-flex justify-content-center text-center">
    <label for="codigoDeBarras"></label>
    <canvas id="codigoDeBarras"></canvas>
    <input type="hidden" name="codigoDeBarras" id="codigoDeBarrasInput">
</div>


<!-- generar el codigo de barras y bloqueo del boton agregar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.5/JsBarcode.all.min.js"></script>
<script>
  const proveedor = document.getElementById('proveedor');
  const marca = document.getElementById('marca');
  const modelo = document.getElementById('modelo');
  const tamaño = document.getElementById('tamaño');
  const tipo = document.getElementById('tipo');
  const precio = document.getElementById('precio');
  const cantidad = document.getElementById('cantidad');
  //const codigoDeBarras = document.getElementById('codigoDeBarras');

  function generarCodigo() {
    const datos = `${proveedor.value} ${marca.value} ${modelo.value} ${tamaño.value} ${tipo.value}`;
    JsBarcode(codigoDeBarras, datos, { format: 'CODE128' });
    document.getElementById('codigoDeBarrasInput').value = datos;
}

  [proveedor, marca, modelo, tamaño, tipo, precio].forEach((campo) => {
    campo.addEventListener('keyup', () => {
      if (proveedor.value && marca.value && modelo.value && tamaño.value && tipo.value && precio.value) {
        generarCodigo();
      }
    });
  });

  // [proveedor, marca, modelo, tamaño, tipo,precio,cantidad].forEach((campo) => {
  //   campo.addEventListener('keyup', () => {
  //     if (proveedor.value && marca.value && modelo.value && tamaño.value && tipo.value && precio.value && cantidad.value) {
  //       agregar.disabled = false;
  //     } else {
  //       agregar.disabled = true;
  //     }
  //   });
  // });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('agregar').addEventListener('click', function(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();

            // Obtén los valores de los campos
            var proveedor = document.getElementById('proveedor').value;
            var marca = document.getElementById('marca').value;
            var modelo = document.getElementById('modelo').value;
            var tamaño = document.getElementById('tamaño').value;
            var tipo = document.getElementById('tipo').value;
            var precio = document.getElementById('precio').value;
            var cantidad = document.getElementById('cantidad').value;

            // Realiza la validación
            if (proveedor.trim() === '') {
                mostrarError('El campo proveedor no puede estar vacío.');
            }else if (marca.trim() === '' ) {
                mostrarError('El campo marca no puede estar vacío.');
            }else if (modelo.trim() === '' ) {
                mostrarError('El campo modelo no puede estar vacío.');
            }else if (tamaño.trim() === '' ) {
                mostrarError('El campo tamaño no puede estar vacío.');
            }else if (tipo.trim() === '' ) {
                mostrarError('El campo tipo no puede estar vacío.');
            }else if (precio.trim() === '' || parseInt(precio) < 0) {
                mostrarError('El campo precio no puede estar vacío o tener números negativos.');
            }else if (cantidad.trim() === '' || parseInt(cantidad) < 0) {//|| parseInt(edad) === 0
                mostrarError('El campo cantidad no puede estar vacío o tener números negativos.');
            } else {
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