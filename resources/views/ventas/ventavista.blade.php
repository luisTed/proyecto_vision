@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")
<!--  -->
@section('contenido')
<!-- estilo para los titulos y la linea --> 
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">


<style>
/* .recuadro-blanco {
    background-color: #fff; 
    padding: 10px; 
    border: 2px solid #3498db; 
    border-radius: 8px; 
    width: 500px;
} */

.recuadro-blanco {
    background-color: #fff;
    padding: 10px;
    border: 2px solid #3498db;
    border-radius: 8px;
    text-align: center; /* Centrar el texto horizontalmente */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Centrar el texto verticalmente */
    align-items: center; /* Centrar el texto horizontalmente */
}

/* Asegura que los elementos dentro del recuadro no hereden propiedades de alineación */
.recuadro-blanco h4, .recuadro-blanco p {
    margin: 0;
}

</style>
</head>
<body>

@if ($mensaje = Session::get('success'))
    <script>
        // Esperar 2 segundos (2000 milisegundos) antes de mostrar el mensaje de Swal
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "{{$mensaje}}",
                showConfirmButton: false,
                timer: 3000
            });
    </script>
@endif

<form action="{{route('venta.store')}}" method="POST">
    @csrf
    <div class="container mt-4">
        <div class="row gy-4">
 <!-- CONTENIDO -->
    <!-- armazones -->
    <div class="col-md-12">
                <div class="text-white bg-primary p-1 text-center">
                    Detalle de compra
                </div>
                <div class="p-3 border border-3 border-primary">
                    <div class="row">
                        <div class="col-12 mb-2">
                        <h3>Eliga un armazón</h3>
                        <label for="">Codigo de barras/cantidad/precio</label>
                        <select name="armazon_id" id="armazon_id" class="form-control selectpicker" data-live-search="true" data-size="3" title="Busque un producto aquí">
                                @foreach ($armazonesE as $item)
                                <option value="{{$item->id_armazon}}">{{$item->codigo_barras.'/'.$item->cantidad.'/'.$item->precio}}</option>
                                @endforeach
                            </select>
                        </div>
                            <!-----Cantidad---->
                            <div class="col-sm-4 mb-2">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control">
                            </div>

                            <!-- ---Precio de venta-- -->
                            <!-- <div class="col-sm-4 mb-2">
                                <label for="precio" class="form-label">Precio:</label>
                                <input type="number" name="precio" id="precio" class="form-control" step="0.1">
                            </div> -->

                             <!-----Precio de descuento---->
                            <div class="col-sm-4 mb-2">
                                <label for="descuento" class="form-label">% de descuento:</label>
                                <input type="number" name="descuento" id="descuento" class="form-control" step="0.1" value="0">
                            </div>

                            <!-----botón para agregar--->
                            <div class="col-12 mb-4 mt-2 text-end">
                                <button id="btn_agregar" class="btn btn-primary" type="button">Agregar</button>
                            </div>

                            <!-----Tabla para el detalle de la compra--->
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="tabla_detalle" class="table table-hover">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white">#</th>
                                                <th class="text-white">Producto</th>
                                                <th class="text-white">Cantidad</th>
                                                <th class="text-white">Precio</th>
                                                <th class="text-white">total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td><!-- boton borrar -->
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <!-- <tr>
                                                <th></th>
                                                <th colspan="4">Sumas</th>
                                                <th colspan="2"><span id="sumasI">0</span></th>
                                            </tr> -->
                                            <!-- <tr>
                                                <th></th>
                                                <th colspan="4">IGV %</th>
                                                <th colspan="2"><span id="igv2">0</span></th>
                                            </tr> -->
                                            <tr>
                                                <th></th>
                                                <th colspan="4">Total</th>
                                                <th colspan="2"> <input type="hidden" name="total" value="0" id="inputTotal"> <span id="total">0</span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <!--Boton para cancelar compra-->
                            <div class="col-12 mt-2">
                                <button id="cancelar" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Cancelar compra
                                </button>
                            </div>

                    </div>
                </div>
            </div>
    <!-- Venta insumo -->
    <div class="col-md-12">
                <div class="text-white bg-success p-1 text-center">
                    Detalle de compra
                </div>
                <div class="p-3 border border-3 border-success">
                    <div class="row">
                        <div class="col-12 mb-2">
                        <h3>Eliga un insumo</h3>
                        <label for="insumo_id" class="form-label">Producto/Cantidad/Precio:</label><!--cambiel el provedor_id-->
                            <select name="insumo_id" id="insumo_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona" data-size='2'>
                                @foreach ($insumosE as $item)
                                <option value="{{$item->id_insumo}}">{{$item->nombre_producto.'/'.$item->cantidad.'/'.$item->precio}}</option>
                                @endforeach
                            </select>
                        </div>
                            <!-----Cantidad---->
                            <div class="col-sm-4 mb-2">
                                <label for="cantidadI" class="form-label">Cantidad:</label>
                                <input type="number" name="cantidadI" id="cantidadI" class="form-control">
                            </div>

                            <!-- ---Precio de venta-- -->
                            <!-- <div class="col-sm-4 mb-2">
                                <label for="precio" class="form-label">Precio:</label>
                                <input type="number" name="precio" id="precio" class="form-control" step="0.1">
                            </div> -->

                             <!-----Precio de descuentoI---->
                            <div class="col-sm-4 mb-2">
                                <label for="descuentoI" class="form-label">% de descuentoI:</label>
                                <input type="number" name="descuentoI" id="descuentoI" class="form-control" step="0.1" value="0">
                            </div>

                            <!-----botón para agregar--->
                            <div class="col-12 mb-4 mt-2 text-end">
                                <button id="btn_agregarI" class="btn btn-primary" type="button">Agregar</button>
                            </div>

                            <!-----Tabla para el detalle de la compra--->
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="tabla_detalleI" class="table table-hover">
                                        <thead class="bg-success">
                                            <tr>
                                                <th class="text-white">#</th>
                                                <th class="text-white">Producto</th>
                                                <th class="text-white">Cantidad</th>
                                                <th class="text-white">Precio</th>
                                                <th class="text-white">Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td><!-- boton borrar -->
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <!-- <tr>
                                                <th></th>
                                                <th colspan="4">Sumas</th>
                                                <th colspan="2"><span id="sumasI">0</span></th>
                                            </tr> -->
                                            <!-- <tr>
                                                <th></th>
                                                <th colspan="4">IGV %</th>
                                                <th colspan="2"><span id="igv2">0</span></th>
                                            </tr> -->
                                            <tr>
                                                <th></th>
                                                <th colspan="4">Total</th>
                                                <th colspan="2"> <input type="hidden" name="totalI" value="0" id="inputTotalI"> <span id="totalI">0</span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <!--Boton para cancelarI compra-->
                            <div class="col-12 mt-2">
                                <button id="cancelarI" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalI">
                                    Cancelar compra
                                </button>
                            </div>

                    </div>
                </div>
            </div>
 <!-- CONTENIDO -->
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-danger text-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-white">
                    ¿Seguro que quieres cancelar la compra?
                    Se eliminará todo el carrito de armazones.
                </div>
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btnCancelarCompra" type="button" class="btn btn-success text-white" data-bs-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalI" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-danger text-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-white">
                    ¿Seguro que quieres cancelar la compra?
                    Se eliminará todo el carrito de insumos.
                </div>
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btnCancelarCompraI" type="button" class="btn btn-success text-white" data-bs-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4 text-center">
        <button type="submit" class="btn btn-success" id="guardar">Realizar compra</button>
    </div>
</form>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function() {
        $('#btn_agregar').click(function() {
            agregarProducto();
        });

        $('#btnCancelarCompra').click(function() {
            cancelarCompra();
        });
        $('#btn_agregarI').click(function() {
            agregarProductoI();
        });

        $('#btnCancelarCompraI').click(function() {
            cancelarCompraI();
        });

        

        disableButtonsI();

        disableButtons();

        // $('#impuesto').val(impuesto + '%');
    });

    //Variables
    let cont = 0;
    let subtotal = [];
    let sumas = 0;
    let igv = 0;
    let total = 0;

    //Constantes
    // const impuesto = 18;

    function cancelarCompra() {
        //Elimar el tbody de la tabla
        $('#tabla_detalle tbody').empty();

        //Añadir una nueva fila a la tabla
        let fila = 
        '<tr>'+
            '<th></th>'+
            '<td></td>'+
            '<td></td>'+
            '<td></td>'+
            '<td></td>'+
        '</tr>';
        $('#tabla_detalle').append(fila);

        //Reiniciar valores de las variables
        cont = 0;
        subtotal = [];
        sumas = 0;
        igv = 0;
        total = 0;

        //Mostrar los campos calculados
        $('#sumas').html(sumas);
        // $('#igv').html(igv);
        $('#total').html(total);
        // $('#impuesto').val(impuesto + '%');
        $('#inputTotal').val(total);

        limpiarCampos();
        disableButtons();


    }

    function disableButtons(){
        if (total == 0) {
            $('#cancelar').hide();
        } else {
            $('#cancelar').show();
            $('#guardar').show();
        }
    }

    function agregarProducto() {
        //Obtener valores de los campos
        let idProducto = $('#armazon_id').val();
        let nameProducto = ($('#armazon_id option:selected').text()).split('/')[0];
        let cantidad = $('#cantidad').val();
        let precio = ($('#armazon_id option:selected').text()).split('/')[2];
        let descuento = $('#descuento').val();
        let cantidad_maxima = ($('#armazon_id option:selected').text()).split('/')[1];
        // console.log(cantidad_maxima);

        //Validaciones 
        //1.Para que los campos no esten vacíos
        if (nameProducto != '' && nameProducto != undefined && cantidad != '' && precio != '') {

            //2. Para que los valores ingresados sean los correctos
            if (parseInt(cantidad) > 0 && (cantidad % 1 == 0) && parseFloat(precio) > 0 && parseFloat(descuento) >= 0 ) {

                //3. Para que el precio de compra sea menor que el precio de venta
                if (parseFloat(cantidad_maxima) >= parseFloat(cantidad)) {
                    //Calcular valores

                    if (parseFloat(descuento) === 0) {
                        subtotal[cont] = cantidad * precio;
                    } else {
                        // Calcula el descuento en términos de cantidad
                        let descuentoCantidad = (precio * descuento) / 100;
                        // Resta el descuento a la cantidad original
                        let precioConDescuento = precio - descuentoCantidad;
                        // Calcula el subtotal con el precio modificado
                        subtotal[cont] = round(cantidad * precioConDescuento);
                    }

                    // subtotal[cont] = cantidad * precio;
                    sumas += subtotal[cont];
                    // igv = round(sumas / 100 * impuesto);
                    total = sumas;
                    let cantidadFinal=cantidad_maxima-cantidad;
                    //Crear la fila
                    let fila = 
                                '<tr id="fila' + cont + '">' +
                                    '<th><input type="hidden" name="arrayid[]" value="'+idProducto + '">' + idProducto+'</th>'+
                                    '<td><input type="hidden" name="arrayproducto[]" value="'+nameProducto + '">' + nameProducto +'</td>'+
                                    '<td><input type="hidden" name="arraycantidad[]" value="'+cantidadFinal + '">' + cantidad + '</td>' +
                                    '<td><input type="hidden" name="arrayprecio[]" value="'+precio + '">' + precio +'</td>'+
                                    '<td><input type="hidden" name="arraysubtotal[]" value="'+subtotal[cont] + '">' + subtotal[cont] +'</td>' +
                                    '<td><button class="btn btn-danger" type="button" onClick="eliminarProducto(' + cont + ')"><i class="fa fa-trash"></i></button></td>' +
                                '</tr>';

                    // //Acciones después de añadir la fila
                    $('#tabla_detalle').append(fila);
                    limpiarCampos();
                    cont++;
                    disableButtons();

                    // //Mostrar los campos calculados
                    // $('#sumas').html(sumas);
                    // $('#igv').html(igv);
                    $('#total').html(total);
                    // $('#impuesto').val(igv);
                    $('#inputTotal').val(total);

                } 
                else {
                    showModal('No hay suficientes armazones en existencia');
                }

            } else {
                showModal('Agregar solo números positivos');
            }

        } else {
            showModal('Le faltan campos por llenar o cambie de armazón');
        }



    }

    function eliminarProducto(indice) {
        //Calcular valores
        sumas -= round(subtotal[indice]);
        // igv = round(sumas / 100 * impuesto);
        total = round(sumas);

        //Mostrar los campos calculados
        // $('#sumas').html(sumas);
        // $('#igv').html(igv);
        $('#total').html(total);
        // $('#impuesto').val(igv);
        $('#InputTotal').val(total);

        //Eliminar el fila de la tabla
        $('#fila' + indice).remove();

        disableButtons();

    }

    function limpiarCampos() {
        let select = $('#armazon_id');
        select.val('');
        $('#cantidad').val('');
        $('#descuento').val('0');
    }

    function round(num, decimales = 2) {
        var signo = (num >= 0 ? 1 : -1);
        num = num * signo;
        if (decimales === 0) //con 0 decimales
            return signo * Math.round(num);
        // round(x * 10 ^ decimales)
        num = num.toString().split('e');
        num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
        // x * 10 ^ (-decimales)
        num = num.toString().split('e');
        return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
    }
    // Fuente: https://es.stackoverflow.com/questions/48958/redondear-a-dos-decimales-cuando-sea-necesario

    function showModal(message, icon = 'error') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: message
        })
    }
    
    //Variables
    let contI = 0;
    let subtotalI = [];
    let sumasI = 0;
    let igv2 = 0;
    let totalI = 0;

    //Constantes
    // const impuesto = 18;

    function cancelarCompraI() {
        //Elimar el tbody de la tabla
        $('#tabla_detalleI tbody').empty();

        //Añadir una nueva filaI a la tabla
        let filaI = 
        '<tr>'+
            '<th></th>'+
            '<td></td>'+
            '<td></td>'+
            '<td></td>'+
            '<td></td>'+
        '</tr>';
        $('#tabla_detalleI').append(filaI);

        //Reiniciar valores de las variables
        contI = 0;
        subtotalI = [];
        sumasI = 0;
        igv2 = 0;
        totalI = 0;

        //Mostrar los campos calculados
        $('#sumasI').html(sumasI);
        // $('#igv2').html(igv2);
        $('#totalI').html(totalI);
        // $('#impuesto').val(impuesto + '%');
        $('#inputTotalI').val(totalI);

        limpiarCamposI();
        disableButtonsI();


    }

    function disableButtonsI() {
        if (totalI == 0) {
            $('#cancelarI').hide();
            
        } else {
            $('#cancelarI').show();
            $('#guardar').show();
        }

    }

    function agregarProductoI() {
        //Obtener valores de los campos
        let idProductoI = $('#insumo_id').val();
        let nameProductoI = ($('#insumo_id option:selected').text()).split('/')[0];
        let cantidadI = $('#cantidadI').val();
        let precioI = ($('#insumo_id option:selected').text()).split('/')[2];
        let descuentoI = $('#descuentoI').val();
        let cantidad_maximaI = ($('#insumo_id option:selected').text()).split('/')[1];
        // console.log(cantidad_maximaI);

        //Validaciones 
        //1.Para que los campos no esten vacíos
        if (nameProductoI != '' && nameProductoI != undefined && cantidadI != '' && precioI != '') {

            //2. Para que los valores ingresados sean los correctos
            if (parseInt(cantidadI) > 0 && (cantidadI % 1 == 0) && parseFloat(precioI) > 0 && parseFloat(descuentoI) >= 0 ) {

                //3. Para que el precioI de compra sea menor que el precioI de venta
                if (parseFloat(cantidad_maximaI) >= parseFloat(cantidadI)) {
                    //Calcular valores

                    if (parseFloat(descuentoI) === 0) {
                        subtotalI[contI] = cantidadI * precioI;
                    } else {
                        // Calcula el descuentoI en términos de cantidadI
                        let descuentoCantidadI = (precioI * descuentoI) / 100;
                        // Resta el descuentoI a la cantidadI original
                        let precioConDescuentoI = precioI - descuentoCantidadI;
                        // Calcula el subtotalI con el precioI modificado
                        subtotalI[contI] = roundI(cantidadI * precioConDescuentoI);
                    }

                    // subtotalI[contI] = cantidadI * precioI;
                    sumasI += subtotalI[contI];
                    // igv2 = roundI(sumasI / 100 * impuesto);
                    totalI = sumasI;
                    let cantidadFinalI=cantidad_maximaI-cantidadI;
                    //Crear la filaI
                    let filaI = 
                                '<tr id="filaI' + contI + '">' +
                                    '<th><input type="hidden" name="arrayidInsumo[]" value="'+idProductoI + '">' + idProductoI+'</th>'+
                                    '<td><input type="hidden" name="arrayproductoInsumo[]" value="'+nameProductoI + '">' + nameProductoI +'</td>'+
                                    '<td><input type="hidden" name="arraycantidadInsumo[]" value="'+cantidadFinalI + '">' + cantidadI + '</td>' +
                                    '<td><input type="hidden" name="arrayprecioInsumo[]" value="'+precioI + '">' + precioI +'</td>'+
                                    '<td><input type="hidden" name="arraysubtotalInsumo[]" value="'+subtotalI[contI] + '">' + subtotalI[contI] +'</td>' +
                                    '<td><button class="btn btn-danger" type="button" onClick="eliminarProductoI(' + contI + ')"><i class="fa fa-trash"></i></button></td>' +
                                '</tr>';

                    // //Acciones después de añadir la filaI
                    $('#tabla_detalleI').append(filaI);
                    limpiarCamposI();
                    contI++;
                    disableButtonsI();

                    // //Mostrar los campos calculados
                    // $('#sumasI').html(sumasI);
                    // $('#igv2').html(igv2);
                    $('#totalI').html(totalI);
                    // $('#impuesto').val(igv2);
                    $('#inputTotalI').val(totalI);

                } 
                else {
                    showModalI('No hay suficientes insumos en existencia');
                }

            } else {
                showModalI('Agregar solo números positivos');
            }

        } else {
            showModalI('Le faltan campos por llenar o cambie de armazón');
        }



    }

    function eliminarProductoI(indice) {
        //Calcular valores
        sumasI -= roundI(subtotalI[indice]);
        // igv2 = roundI(sumasI / 100 * impuesto);
        totalI = roundI(sumasI);

        //Mostrar los campos calculados
        // $('#sumasI').html(sumasI);
        // $('#igv2').html(igv2);
        $('#totalI').html(totalI);
        // $('#impuesto').val(igv2);
        $('#InputTotal').val(totalI);

        //Eliminar el filaI de la tabla
        $('#filaI' + indice).remove();

        disableButtonsI();

    }

    function limpiarCamposI() {
        let selectI = $('#insumo_id');
        selectI.val('');
        $('#cantidadI').val('');
        $('#descuentoI').val('0');
    }

    function roundI(num, decimales = 2) {
        var signoI = (num >= 0 ? 1 : -1);
        num = num * signoI;
        if (decimales === 0) //con 0 decimales
            return signoI * Math.roundI(num);
        // roundI(x * 10 ^ decimales)
        num = num.toString().split('e');
        num = Math.roundI(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
        // x * 10 ^ (-decimales)
        num = num.toString().split('e');
        return signoI * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
    }
    // Fuente: https://es.stackoverflow.com/questions/48958/redondear-a-dos-decimales-cuando-sea-necesario

    function showModalI(message, icon = 'error') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: message
        })
    }


</script>

@endsection
