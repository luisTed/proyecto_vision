<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\consultas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClienteController extends Controller
{

    public function index()
    {
        // Devuelve la vista 'consultas.calendario'
        return view('consultas.calendario');
    }
    
    public function create()
    {
        
    }
    
    public function store(Request $request)
    {
        // Valida los datos según las reglas definidas en el modelo Consultas
        request()->validate(consultas::$rules);
        
        // Crea una nueva consulta en la base de datos
        $con = consultas::create($request->all());
        return response()->json(['message' => 'Cita agendada con éxito']);
    }
    
    public function consultacliente(Request $request, $id)
    {
        // Busca la información del cliente por su ID
        $informacion = cliente::find($id);
    
        // Crea una nueva consulta con la información proporcionada y la asocia al cliente
        $generar = new consultas();
        $generar->nombre = $informacion->nombre;
        $generar->fecha = $request->input('fecha');
        $generar->hora = $request->input('hora');
        $generar->contacto = $informacion->telefono;
        $generar->descripccion = $request->input('descripccion');
        $generar->id_cliente = $id;
    
        $generar->save();
    
        // Redirige a la vista de clientes con un mensaje de éxito
        return redirect()->route("cliente.index")->with("success", "Cita agendada");
    }
    
    public function show()
    {
        // Obtiene todas las consultas
        $consultas = Consultas::all();
    
        // Prepara los datos para el calendario en formato JSON
        $eventos = [];
    
        foreach ($consultas as $consulta) {
            $eventos[] = [
                'id'    => $consulta->id,
                'title' => $consulta->nombre, // Ajusta según tus columnas de la tabla
                'start' => $consulta->fecha . ' ' . $consulta->hora, // Combina fecha y hora según tus columnas
                'contacto' => $consulta->contacto,
                'descripcion' => $consulta->descripccion,
            ];
        }
    
        return response()->json($eventos);
    }
    
    // Para buscar y editar una consulta
    public function edit($id)
    {
        // Obtiene la consulta por su ID y devuelve los datos en formato JSON
        $cons = consultas::find($id);
        return response()->json($cons);
    }
    
    
    // Actualiza una consulta
    public function update(Request $request, consultas $consulta)
    {
        // Valida los datos según las reglas definidas en el modelo Consultas
        $request->validate(consultas::$rules);
        
        // Actualiza los datos de la consulta en la base de datos
        $consulta->update($request->all());
        
        // Devuelve la consulta actualizada en formato JSON
        return response()->json(['message' => 'Cita modificada con exito']);
    }
    
    
    // Elimina una consulta
    public function destroy($id)
    {
        // Elimina la consulta por su ID y devuelve la consulta eliminada en formato JSON
        $cons = consultas::find($id);
        $cons->delete();
        return response()->json(['message' => 'Cita eliminada con éxito']);
    }
    
    
}
