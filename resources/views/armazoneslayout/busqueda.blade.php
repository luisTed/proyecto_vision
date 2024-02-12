@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')

<div class="card">
    <h5 class="card-header">Almacén de armazones</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <!-- resive un mensaje de confirmacion -->
                @if ($mensaje = Session::get('success'))
                    <script>
                        // Esperar 2 segundos (2000 milisegundos) antes de mostrar el mensaje de Swal
                        setTimeout(function() {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "{{$mensaje}}",
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }, 100);
                    </script>
                @endif
            </div>
        </div>

            <!-- Botón para Buscar por marca -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Busqueda_armazon_1" >
                <span class="fas fa-search"></span> Buscar por marca.
            </button>

            <!-- Botón para Buscar por código de barras -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Busqueda_armazon_2" >
                <span class="fas fa-search"></span> Buscar por código de barras.
            </button>

<br>
<br>
        <p>
            <a href="{{ route("armazones.create") }}" class="btn btn-primary"><!-- btn-lg para hacer el botón más grande si se agrega -->
                <!-- mr-2 para agregar un poco de espacio a la derecha del icono-->
                <span class="fas fa-user-plus mr-2"></span> Agregar armazón.
            </a>
        </p>

        <hr>
        <p class="card-text">
            <div class="table table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <!-- titulos de la tabla -->
                    <th>Proveedor</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Código de barras</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th> </th>
                    </thead>

                    <tbody>
                    <!-- muestra de la informacion de la base de datos -->
                        @foreach ($datos as $item)
                            <tr>
                                <td>{{ $item->proveedor}}</td>
                                <td>{{ $item->marca_proveedor}}</td>
                                <td>{{ $item->modelo_proveedor}}</td>
                                <td>{{ $item->codigo_barras}}</td>
                                <td> <div class="center d-flex justify-content-center">{{ $item->precio }}</div></td>
                                <td><div class="center d-flex justify-content-center">{{ $item->cantidad }}</div></td>


                                <td>
                                    <div class="center d-flex justify-content-center">
                                        <!-- boton editar  -->
                                        
                                        <form action="{{ route('armazones.edit', $item->id_armazon) }}" method="GET">
                                            <button class="btn btn-warning btn-sm mr-2">
                                                <span class="fas fa-user-edit"></span>
                                            </button>
                                        </form>
                                        <!-- boton eliminar  -->
                                        <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" 
                                            data-target="#confirmDeleteModalArmazon-{{ $item->id_armazon }}">
                                            <span class="fas fa-trash-alt"></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$datos->links()}}
        </p>
    </div>
</div>
<!-- Modal para confirmar la eliminación del armazon -->
@foreach ($datos as $item)
<div class="modal" id="confirmDeleteModalArmazon-{{ $item->id_armazon }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-danger text-white">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación de armazon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white"> <!-- Aplicar fondo blanco al cuerpo del modal -->
                <p>¿Está seguro de que desea eliminar este armazon?</p>
                <h4>{{ $item->codigo_barras}}</h4>
            </div>
            <div class="modal-footer bg-white"> <!-- Aplicar fondo blanco al pie del modal -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('armazones.destroy', $item->id_armazon) }}" method="POST">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-success text-white">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach

<!-- Modal de búsqueda armazón por marca -->
<div class="modal" id="Busqueda_armazon_1" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-primary text-white">
            <div class="modal-header">
                <h5 class="modal-title text-white">Busqueda de armazón</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <form id="busquedaArmazonForm_1" action="{{ route('armazones.show') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="armazonInfo_1">Ingresa la marca del producto</label>
                        <input type="text" class="form-control" name="armazonInfo" id="armazonInfo_1" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="botonBuscarArmazon_1">Buscar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de búsqueda armazón por barras -->
<div class="modal" id="Busqueda_armazon_2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-primary text-white">
            <div class="modal-header">
                <h5 class="modal-title text-white">Busqueda de armazón</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <form id="busquedaArmazonForm_2" action="{{ route('armazones2.show2') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="armazonInfo_2">Ingresa el codigo de barras</label>
                        <input type="text" class="form-control" name="armazonInfo" id="armazonInfo_2" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="botonBuscarArmazon_2">Buscar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Agregar un evento para manejar el clic en el botón de búsqueda por marca
    document.getElementById('botonBuscarArmazon_1').addEventListener('click', function() {
        // Ahora puedes enviar el formulario
        document.getElementById('busquedaArmazonForm_1').submit();
    });

    // Agregar un evento para manejar el clic en el botón de búsqueda por barras
    document.getElementById('botonBuscarArmazon_2').addEventListener('click', function() {
        // Ahora puedes enviar el formulario
        document.getElementById('busquedaArmazonForm_2').submit();
    });
</script>


@endsection