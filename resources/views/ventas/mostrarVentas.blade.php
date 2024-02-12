@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')
<style>
.recuadro-blanco {
    background-color: #fff;
    padding: 20px;
    border: 2px solid #3498db;
    border-radius: 8px;
    margin-bottom: 20px;
    max-width: 600px;
    text-align: left;
}

.recuadro-blanco h4, .recuadro-blanco p {
    margin: 10px 0;
}

.recuadro-blanco h4 {
    font-size: 18px;
}

.recuadro-blanco p {
    font-size: 16px;
}
</style>
@foreach ($datos as $item)
<div class="recuadro-blanco">
    <h4>Descripción de venta:</h4>

    @if($item->nombre_cliente === null)
    <p>Vendido a: Venta rápida el {{ $item->fecha }}</p>
    @else
        <p>Vendido a: {{ $item->nombre_cliente }} el {{ $item->fecha }}</p>
    @endif


        @php
        // Dividir la descripción en un array usando el caracter "*"
        $lineas_descripcion = explode('*', $item->descripccionVenta);
        $cantidad_elementos = count($lineas_descripcion);
        @endphp
        @foreach ($lineas_descripcion as $linea)
        <p>{{ $linea }}</p>
        @endforeach


    <p style="color: green; font-weight: bold;">Ganancia total: {{ $item->precio_final }}</p>


</div>
@endforeach


@endsection
