@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')

<div class="card">
    <h5 class="card-header">Almacén de insumos</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
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

        <a href="{{ route('insumo.create') }}" class="btn btn-primary"><!-- btn-lg para hacer el botón más grande si se agrega -->
                <!-- mr-2 para agregar un poco de espacio a la derecha del icono-->
                <span class="fas fa-user-plus mr-2"></span> Agregar insumo  
            </a>

        <td><!-- boton para ir a la vista para agregar un unsumo nuevo  -->
        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#Busqueda_insumo">
            <span class="fas fa-search"></span> Buscar insumo
        </button>
        </td>


        <hr>
        <p class="card-text">
            <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                    <thead>
                        <!-- titulo de columnas -->
                    <th>Insumo</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th> </th>
                    </thead>

                    <tbody>
                    
                        @foreach ($datos as $item)
                            <tr>
                                <!-- informacion mostrada -->
                                <td>{{ $item->nombre_producto}}</td>
                                <td>{{ $item->marca}}</td>
                                <td><div class="center d-flex justify-content-center">{{ $item->precio}}</div></td>
                                <td><div class="center d-flex justify-content-center">{{ $item->cantidad}}</div></td>
                                <td>
                                    <div class="center d-flex justify-content-center">
                                        <!-- boton editar -->
                                        <form action="{{route('insumo.edit', $item -> id_insumo)}}" method="GET">
                                            <button class="btn btn-warning btn-sm mr-2">
                                                <span class="fas fa-user-edit"></span>
                                            </button>
                                        </form>
                                        
                                        <!-- boton de eliminar insumo -->
                                        <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" 
                                            data-target="#confirmDeleteModalinsumo-{{ $item->id_insumo}}">
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
<div class="modal" id="confirmDeleteModalinsumo-{{ $item->id_insumo }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-danger text-white">
            <div class="modal-header ">
                <h5 class="modal-title">Confirmar Eliminación de insumo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <p>¿Está seguro de que desea eliminar este insumo?</p>
                <h4>{{ $item->nombre_producto}}</h4>
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('insumo.destroy', $item->id_insumo) }}" method="POST">
                     @csrf
                     @method('DELETE')
                    <button type="submit" class="btn btn-success text-white">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach



<!-- Modal de búsqueda de insumo -->
<div class="modal" id="Busqueda_insumo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-primary text-white">
            <div class="modal-header">
                <h5 class="modal-title">Busqueda de armazon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                <form id="busquedainsumo" action="{{ route('insumo.show') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="insumoNombre">Ingrese el nombre del insumo</label>
                        <input type="text" class="form-control" name="insumoNombre" id="insumoNombre" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="botonBuscarinsumo">Buscar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Este script se ejecuta cuando se hace clic en el botón con el id 'botonBuscarinsumo'
document.getElementById('botonBuscarinsumo').addEventListener('click', function() {
    // Envía el formulario con el id 'busquedainsumo' cuando se hace clic en el botón
    document.getElementById('busquedainsumo').submit();
});

</script>


@endsection