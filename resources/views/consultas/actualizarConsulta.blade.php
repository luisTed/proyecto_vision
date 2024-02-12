@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')
<div class="card">
    <h5 class="card-header">Reagendar</h5>
    <div class="card-body">
        <p class="card-text">
            <form action="{{ route('consulta.update', $cons->nombre) }}" method="POST">
                @csrf
                @method("PUT")
                <label for="">nombre</label>
                <input type="text" name="nombre" class="form-control" required value="{{$cons->nombre}}">
                <label for="">fecha</label>
                <input type="text" name="fecha" class="form-control" required value="{{$cons->fecha}}">
                <label for="">hora</label>
                <input type="text" name="hora" class="form-control" required value="{{$cons->hora}}">
                <br>
                <a href="{{ route("consultas.index") }}" class="btn btn-info" >
                    <span class="fas fa-undo-alt"></span> Regresar
                </a>
                <button class="btn btn-warning">
                    <span class="fas fa-user-edit"></span> Actualizar
                </button>
                
            </form>
        </p>
        
    </div>
</div>
@endsection