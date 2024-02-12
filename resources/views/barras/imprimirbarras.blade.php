@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')
<form action=" {{route('armazones.imprimir_codigos')}} " method="GET">
    @csrf
    <div class="card">
        <h5 class="card-header">Código de barras de armazones</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                </div>
            </div>
            <p>
                <button type="submit" class="btn btn-primary">
                Generar códigos de barrra
                </button>
            </p>

            <hr>
            <p class="card-text">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <th>proveedor</th>
                            <th>marca</th>
                            <th>modelo</th>
                            <th>codigo de barras</th>
                            <th>seleccionar</th>
                        </thead>

                        <tbody>
                            @foreach ($datos as $item)
                                <tr>
                                    <td>{{ $item->proveedor }}</td>
                                    <td>{{ $item->marca_proveedor }}</td>
                                    <td>{{ $item->modelo_proveedor }}</td>
                                    <td>{{ $item->codigo_barras }}</td>
                                    <td>
                                        <input type="checkbox" name="codigos_barras[]" value="{{ $item->codigo_barras }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </p>
        </div>
    </div>
</form>


@endsection