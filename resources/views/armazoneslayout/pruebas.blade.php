@extends('layout.admin')

@section("tituloPagina", "Crear un nuevo registro")

@section('contenido')
<!-- dd($datos); -->
<form action="{{route('mica.crearpdf')}}"  method="POST">
        @csrf
        <div class="container mt-5">
            <!-- Datos del Material -->
            <div class="seccion">
                <div class="titulo">Datos del Material</div>
                <div class="linea"></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="material1">Tipo de lente(OD):</label>
                    <select class="form-control" id="material1" name="material1">
                    <option value="opcion1">Opción 1</option>
                    <option value="opcion2">Opción 2</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="material2">Diseño:</label>
                    <select class="form-control" id="material2" name="material2">
                        <!-- Opciones para el segundo combobox -->
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="material3">Material:</label>
                    <select class="form-control" id="material3" name="material3">
                        <!-- Opciones para el tercer combobox -->
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="material11">Tipo de lente(OI):</label>
                    <select class="form-control" id="material11" name="material11">
                        <!-- Opciones para el primer combobox -->
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="material22">Diseño:</label>
                    <select class="form-control" id="material22" name="material22">
                        <!-- Opciones para el segundo combobox -->
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="material33">Material 3:</label>
                    <select class="form-control" id="material33" name="material33">
                        <!-- Opciones para el tercer combobox -->
                    </select>
                </div>
            </div>

            <div class="seccion">
                <div class="titulo">Datos del armazon</div>
                <div class="linea"></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="material1">Tipo de lente(OD):</label>
                    <select class="form-control" id="material1" name="material1">
                    <option value="opcion1">Opción 1</option>
                    <option value="opcion2">Opción 2</option>
                    </select>
                </div>
                <div class="form-group col-md-8">
                <label for="descripcion">Descripción del armazon</label>
                <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-3">
                        <label for="DBL" class="form-label">DBL</label>
                        <input type="number" class="form-control" name="DBL" id="DBL" placeholder="">
                        <small id="helpId" class="form-text text-muted">Puente</small>
                    </div>
                    <div class="col-md-3">
                        <label for="A" class="form-label">A</label>
                        <input type="number" class="form-control" name="A" id="A" placeholder="">
                        <small id="helpId" class="form-text text-muted">Tamaño del armazon</small>
                    </div>
                    <div class="col-md-3">
                        <label for="B" class="form-label">B</label>
                        <input type="number" class="form-control" name="B" id="B" placeholder="">
                        <small id="helpId" class="form-text text-muted">Ancho de la mica</small>
                    </div>
                    <div class="col-md-3">
                        <label for="E" class="form-label">E</label>
                        <input type="number" class="form-control" name="E" id="E" placeholder="">
                        <small id="helpId" class="form-text text-muted">Tamaño del armazon</small>
                    </div>
                </div>
            </div>
        <!-- termina datos del armazon -->
        <div class="seccion">
                <div class="linea"></div>
            </div>
            <br>

            <!-- Servicios y Tratamientos (Tabs) -->
        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" id="servicios-tab" data-toggle="tab" href="#servicios">Servicios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tratamientos-tab" data-toggle="tab" href="#tratamientos">Tratamientos</a>
            </li>
        </ul>

        <div class="tab-content mt-2">
            <!-- Contenido de la pestaña Servicios -->
            <div class="tab-pane fade show active" id="servicios">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>APL</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>rinoplastia</td>
                            <td>
                                <!-- Formulario de APL -->
                                <input type="checkbox" class="form-check-input" name="apl">
                            </td>
                            <td>
                                <!-- Formulario de Cantidad (solo acepta números) -->
                                <input type="number" class="form-control" name="cantidad" min="0" step="1">
                            </td>
                            <td>
                                <!-- Formulario de Precio (solo acepta números) -->
                                <input type="number" class="form-control" name="precio" min="0" step="0.01">
                            </td>
                            <td>
                                <!-- Campo de Total (no editable, muestra la multiplicación) -->
                                <input type="text" class="form-control" name="total" readonly>
                            </td>
                        </tr>
                        <!-- Puedes agregar más filas según sea necesario -->
                    </tbody>
                </table>
            </div>

            <!-- Contenido de la pestaña Tratamientos -->
            <div class="tab-pane fade" id="tratamientos">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th scope="col">DESCRIPCIÓN</th>
                            <th scope="col">APL</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">PRECIO UNITARIO</th>
                            <th scope="col">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
                <!-- FINAL DE LA TABLA TRATAMIENTOS -->
            </div>
        </div>

                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="materiales" class="form-label">Total materiales</label>
                                <input type="number" class="form-control" name="materiales" id="materiales" placeholder="" readonly>
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>
                            <div class="col-md-3">
                                <label for="serviciosTotal" class="form-label">Total servicios</label>
                                <input type="number" class="form-control" name="serviciosTotal" id="serviciosTotal" placeholder="" readonly>
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>
                            <div class="col-md-3">
                                <label for="tratamientostotal" class="form-label">Total tratamiento</label>
                                <input type="number" class="form-control" name="tratamientostotal" id="tratamientostotal" placeholder="" readonly>
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>
                            <div class="col-md-3">
                                <label for="Totalprecio" class="form-label">Precio final</label>
                                <input type="number" class="form-control" name="Totalprecio" id="Totalprecio" placeholder="" readonly>
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div><br>

        </div>
        <button type="submit">Enviar</button>
    <!-- FINAL DE LA TABLA mica -->
</form>
@endsection