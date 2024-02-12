@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')
<!-- reglas del formulario -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Escucha el clic en el botón de confirmación del modal
        document.getElementById('confirmarActualizacion').addEventListener('click', function() {
            // Envía el formulario si el usuario confirma
            document.getElementById('formActualizacion').submit();
        });
        generarCodigo();
    });
</script>

<div class="card">
    <h5 class="card-header">Actualizar armazon</h5>
    <div class="card-body">
        <p class="card-text">
            <form action="{{ route('armazones.update', $armazon->id_armazon) }}" method="POST" id="formActualizacion">                
                @csrf
                @method("PUT")
<!-- muestra la informacion para despues editarla -->
                <div class="form-group">
                    <label for="proveedor">proveedor</label>
                    <input type="text" class="form-control" id="proveedor" name="proveedor" value="{{$armazon->proveedor}}">
                </div>
                
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" value="{{$armazon->marca_proveedor}}">
                </div>

                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" value="{{$armazon->modelo_proveedor}}">
                </div>
                
                <div class="form-group">
                    <label for="tamaño">Tamaño</label>
                    <input type="text" class="form-control" id="tamaño" name="tamaño" value="{{$armazon->tamaño}}">
                </div>
                
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" value="{{$armazon->tipo}}">
                </div>

                <div class="form-group">
                    <label for="precio">Precio (no modifica el codigo de barras)</label>
                    <input type="number" class="form-control" id="precio" name="precio" value="{{$armazon->precio}}">
                </div>

                <div class="form-group">
                    <label for="cantidad">Cantidad (no modifica el codigo de barras)</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{$armazon->cantidad}}">
                </div>

                <input type="hidden" name="codigoDeBarras" id="codigoDeBarrasInput">

                <br>
                <a href="{{ route("armazones.index") }}" class="btn btn-secondary"> cancelar</a>
                
                <button type="button" class="btn btn-warning"  id="actualizarArmazon">
                    <span class="fas fa-user-edit"></span> Actualizar
                </button>
            </form>
        </p>
    </div>
</div>
<h3 class="text-center">código de barras</h3>

<!-- Modal de confirmación de actualización de código de barras -->
<div class="modal fade" id="confirmacionModal" tabindex="-1" role="dialog" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="confirmacionModalLabel">Confirmación de actualización</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <p>El código de barras se modificará. ¿Estás seguro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-warning" id="confirmarActualizacion">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!-- guarda el codigo de barras -->
<div class="form-group d-flex justify-content-center text-center">
    <label for="codigoDeBarras"></label>
    <canvas id="codigoDeBarras"></canvas>
    <input type="hidden" name="codigoDeBarras" id="codigoDeBarrasInput">
</div>

<!-- genera el codigo de barras y bloquea el boton confirmar -->
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

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('actualizarArmazon').addEventListener('click', function(event) {
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
            }else if (precio.trim() === '' || parseInt(cantidad) < 0) {
                mostrarError('El campo precio no puede estar vacío o tener números negativos.');
            }else if (cantidad.trim() === ''|| parseInt(cantidad) < 0 ) {//|| parseInt(edad) === 0
                mostrarError('El campo cantidad no puede estar vacío tener números negativos.');
            } else {
                // Si pasa la validación, envía el formulario
                $('#confirmacionModal').modal('show');
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