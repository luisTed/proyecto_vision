@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")
<!--  -->
@section('contenido')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <!-- Botones adicionales -->
            <div class="mb-3">
                <a href="{{route('ventas.ventasdeldia')}}" class="btn btn-primary btn-sm">
                    Ventas del día
                </a>
                <a href="{{route('ventas.ventassincliente')}}" class="btn btn-primary btn-sm">
                    Ventas rápidas
                </a>
                <!-- Botón 3 con modal -->
                <a href="{{route('ventas.reportesCliente')}}" class="btn btn-primary btn-sm">
                    Ventas a clientes
                </a>
            </div>
            <!-- Fin de los botones adicionales -->

            <form id="formVentas" action="{{ route('ventas.show') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de inicio:</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha de fin:</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                </div>
                <button id="btnBuscar" class="btn btn-primary btn-sm mt-4" type="button">
                    <span class="fas fa-search"></span> Buscar
                </button>
            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById('btnBuscar').addEventListener('click', function() {
        var fechaInicio = document.getElementById('fecha_inicio').value;
        var fechaFin = document.getElementById('fecha_fin').value;

        if (fechaInicio === '' || fechaFin === '') {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: 'Por favor, complete ambas fechas.',
                showConfirmButton: false,
                timer: 1500
            });
            return false; // Detener el envío del formulario
        }

        if (fechaInicio >= fechaFin) {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: 'La fecha de inicio debe ser menor que la fecha de fin.',
                showConfirmButton: false,
                timer: 1500
            });
            return false; // Detener el envío del formulario
        }

        document.getElementById('formVentas').submit();
    });
</script>

@endsection
