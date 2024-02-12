<?php

namespace App\Http\Controllers;

use App\Models\almacen_insumos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlmacenInsumosController extends Controller
{
    public function index()
    {
        // Obtiene todos los datos de almacen_insumos
        $datos = almacen_insumos::simplePaginate(8);
    
        // Devuelve la vista 'insumolayouts.insumosvista' con los datos obtenidos
        return view('insumolayouts.insumosvista', compact('datos')); 
    }
    
    public function create()
    {
        // Devuelve la vista 'insumolayouts.agregarinsumo' para mostrar el formulario de creación
        return view('insumolayouts.agregarinsumo');
    }
    
    public function store(Request $request)
    {
        // Crea un nuevo registro en la base de datos con los datos proporcionados en el formulario de creación
        $trabajador = new almacen_insumos();
        $trabajador->nombre_producto = $request->input('nombre');
        $trabajador->marca = $request->input('marca');
        $trabajador->precio = $request->input('precio');
        $trabajador->cantidad = $request->input('cantidad');
        $trabajador->save();
        $nombreM=$request->input('nombre');
        // Redirige a la vista de index y muestra un mensaje de éxito
        return redirect()->route("insumo.index")->with("success", "$nombreM agregado con éxito!");
    }
    
    public function show(Request $request)
    {
        // Obtiene el nombre del producto desde la solicitud
        $nombreProducto = $request->input('insumoNombre');
    
        // Busca registros en almacen_insumos donde 'nombre_producto' sea similar a $nombreProducto
        $datos = almacen_insumos::where('nombre_producto', 'LIKE', '%' . $nombreProducto . '%')->simplePaginate(8);
    
        // Devuelve la vista 'insumolayouts.insumosvista' con los datos obtenidos
        return view('insumolayouts.insumosvista', compact('datos'));
    }
    
    public function edit($id)
    {
        // Obtiene un registro específico de almacen_insumos por su ID para editar
        $insu = almacen_insumos::find($id);
    
        // Devuelve la vista 'insumolayouts.editarinsumo' con los datos del registro
        return view('insumolayouts.editarinsumo', compact('insu'));
    }
    
    public function update(Request $request, $id)
    {
        // Actualiza un registro existente en la base de datos con los datos proporcionados en el formulario de edición
        $cambio = almacen_insumos::find($id);
        $cambio->nombre_producto = $request->post('nombre');
        $cambio->marca = $request->post('marca');
        $cambio->precio = $request->post('precio');
        $cambio->cantidad = $request->post('cantidad');
        $cambio->save();
        $nombreM=$request->input('nombre');
        // Redirige a la vista de index y muestra un mensaje de éxito
        return redirect()->route("insumo.index")->with("success", "$nombreM actualizado con éxito!");
    }
    
    public function destroy($id)
    {
        // Elimina un registro específico de almacen_insumos por su ID
        $insu = almacen_insumos::find($id);
        $nombreM=$insu->nombre_producto;
        $insu->delete();
    
        // Redirige a la vista de index y muestra un mensaje de éxito
        return redirect()->route("insumo.index")->with("success", "$nombreM eliminado con éxito!");
    }
    
}
