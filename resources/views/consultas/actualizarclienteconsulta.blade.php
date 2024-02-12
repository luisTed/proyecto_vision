@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')
<div class="card">
    <h5 class="card-header">Reagendar</h5>
    <div class="card-body">
        <p class="card-text">
            <form action="{{ route('consultacliente.update2', $clientes->ID_cliente) }}" method="POST">
                @csrf
                @method("PUT")

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="text" id="fecha" name="fecha" class="form-control datepicker" required value="{{ $clientes->fecha }}">
                </div>

                <br>
                <a href="{{ route("consultas.index") }}" class="btn btn-info">
                    <span class="fas fa-undo-alt"></span> Regresar
                </a>
                <button type="submit" class="btn btn-warning">
                    <span class="fas fa-user-edit"></span> Actualizar
                </button>
            </form>
        </p>
    </div>
</div>

<!-- Bootstrap JS (bundle incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A6lZBZ1i8t4q1hpLlZ5TgNYJpIY0PzI0FfF2KcifcC8euCeI1pz+TKXs3S8N5zJj" crossorigin="anonymous"></script>

<!-- Bootstrap Datepicker JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js" integrity="sha384-Sge2s3H6ZGLRMCUXLm/AQnXShi7N61de7khoTsfBh/xZCqA+a/0CK5PQG7yOPqcd" crossorigin="anonymous"></script>

<!-- Script para activar el selector de fecha -->
<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>
@endsection
