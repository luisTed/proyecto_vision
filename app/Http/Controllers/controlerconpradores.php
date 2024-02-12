<?php

namespace App\Http\Controllers;
use App\Models\cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class controlerconpradores extends Controller
{

    public function index()
    {
        // Obtiene todos los datos de la tabla 'cliente'
        $datos = cliente::simplePaginate(8);
    
        // Devuelve la vista 'clientes.vistacliente' con los datos obtenidos
        return view("clientes.vistacliente", compact('datos'));
    }
    
    public function create()
    {
        // Devuelve la vista 'clientes.agregarcliente' para mostrar el formulario de creación
        return view('clientes.agregarcliente');
    }
    
    public function store(Request $request)
    {
        // Crea un nuevo registro en la base de datos con los datos proporcionados en el formulario de creación
        $trabajador = new cliente();
        $trabajador->nombre = $request->input('nombre');
        $trabajador->edad = $request->input('edad');
        $trabajador->telefono = $request->input('telefono');
        $trabajador->correo = $request->input('correo');
        $trabajador->save();
        $nombreM = $request->input('nombre');
    
        // Redirige a la vista de index y muestra un mensaje de éxito
        return redirect()->route("cliente.index")->with("success", "Cliente $nombreM agregado con éxito!");
    }
    
    public function show(Request $request)
    {
        // Obtiene el nombre del cliente desde la solicitud
        $nombreC = $request->input('clienteNombre');
    
        // Busca registros en la tabla 'cliente' donde 'nombre' sea similar a $nombreC
        $datos = cliente::where('nombre', 'LIKE', '%' . $nombreC . '%')->simplePaginate(8);
    
        // Devuelve la vista 'clientes.vistacliente' con los datos obtenidos
        return view('clientes.vistacliente', compact('datos'));
    }
    
    public function edit(string $id)
    {
        // Obtiene un registro específico de la tabla 'cliente' por su ID para editar
        $buscar = cliente::find($id);
    
        // Devuelve la vista 'clientes.editarcliente' con los datos del registro
        return view("clientes.editarcliente", compact('buscar'));
    }
    
    public function update(Request $request, $id)
    {
        // Actualiza un registro existente en la base de datos con los datos proporcionados en el formulario de edición
        $editarC = cliente::find($id);
        $editarC->nombre = $request->post('nombre');
        $editarC->edad = $request->post('edad');
        $editarC->telefono = $request->post('telefono');
        $editarC->correo = $request->post('correo');
        $editarC->adeudo = $request->post('adeudo');
        $editarC->save();
        $nombreM = $request->input('nombre');
    
        // Redirige a la vista de index y muestra un mensaje de éxito
        return redirect()->route("cliente.index")->with("success", "Cliente $nombreM editado con éxito!");
    }
    
    public function destroy($id)
    {
        // Elimina un registro específico de la tabla 'cliente' por su ID
        $destruir = cliente::find($id);
        $nombreM = $destruir->nombre;
        $destruir->delete();
    
        // Redirige a la vista de index y muestra un mensaje de éxito
        return redirect()->route("cliente.index")->with("success", "Cliente $nombreM eliminado con éxito!");
    }
    
}
