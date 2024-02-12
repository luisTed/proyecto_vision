@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")
<!--  -->
@section('contenido')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

@if ($mensaje = Session::get('success'))
<script>
    @if($mensaje === "Seleccione un nombre")
        setTimeout(function() {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "{{$mensaje}}",
                showConfirmButton: false,
                timer: 3000
            });
        }, 100);
    @else
        setTimeout(function() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{$mensaje}}",
                showConfirmButton: false,
                timer: 3000
            });
        }, 100);
    @endif                
</script>
@endif

<div class="text-center">
    <h5>Ingresa el nombre completo del cliente para buscar sus ventas</h5>
</div>

<div class="container mt-4">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <form action="{{ route('encontrar.verificarpersonas3') }}" method="GET">
                @csrf
                <div class="input-group">
                    <select name="id_cliente" id="id_cliente" class="form-control selectpicker" data-live-search="true" data-size="3" title="Ingrese un nombre">
                        <option disabled selected>Elija un nombre</option>
                        @foreach ($todos as $item)
                            <option value="{{$item->ID_cliente}}">{{$item->nombre}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit">
                        <span class="fas fa-search"></span> <!-- Ícono de lupa -->
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endsection