<?php
//namespace App\Models\almacen_insumos;
namespace App\Http\Controllers;

use App\Models\trabajadores;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function index()
    {
        //pagina de inicio 
        $datos=trabajadores::all();
        return view('trabajadores.index', compact('datos')); //descomentar despues
    }

    public function create()
    {
        //el formulario donde 
        //nosotros agregamos datos
        return view('trabajadores.agregar');
    }

    public function store(Request $request)
    {
        //sirve para guardar datos en la bd
        $trabajador = new trabajadores();
        $trabajador->nombre = $request->input('nombre');
        $trabajador->puesto = $request->input('puesto');
        $trabajador->contraseña = md5($request->input('contraseña'));
        $trabajador->correo =$request->input('correo');
        $trabajador->save();
        $nombreM= $request->input('nombre');
        return redirect()->route("usuarios.index")->with("success", "Trabajador $nombreM agregado con exito!");
    }

 
    public function edit($ID_trabajo)
    {
        //este metodo nos sirve para traer los datos que se van a editar
        //y los coloca en un formulario
        
        $trabajador = trabajadores::find($ID_trabajo);
        return view("trabajadores.actualizar" , compact('trabajador'));
        
    }


    public function update(Request $request, $ID_trabajo)
    {
        //este metodo actualiza los datos en la bd
        $trabajador = trabajadores::find($ID_trabajo);
        $trabajador->nombre = $request->post('nombre');
        $trabajador->puesto = $request->post('puesto');
        $trabajador->contraseña =md5($request->post('contraseña'));
        $trabajador->correo = $request->post('correo');
        $trabajador->save();
        $nombreM= $request->input('nombre');
        return redirect()->route("usuarios.index")->with("success", "Trabajador $nombreM actualizado con exito!");
        
    }

    public function destroy($ID_trabajo)
    {
        $borrarI = $ID_trabajo;
        if ($borrarI == 1) {
            return redirect()->route("usuarios.index")->with("success", "Master");
        } else {
            $trabajador = trabajadores::find($ID_trabajo);
            $nombreM = $trabajador->nombre;
            $trabajador->delete();
    
            return redirect()->route("usuarios.index")->with("success", "Trabajador $nombreM eliminado con éxito!");
        }
    }
    
    public function verificarEntrada(Request $request)
    {
        $trabajador = $request->get('nombre');
        $contra = md5($request->get('contraseña'));
        
        // Busca el trabajador por su nombre
        $datos = almacen_armazones::where('nombre', 'LIKE', '%' . $trabajador . '%')->first();
        
        // Verifica si se encontró el trabajador
        if($datos === null) {
            return redirect()->route("Entradaprincipal")->with("success", "Nombre incorrecto, intente de nuevo.");
        }
        
        // Obtén la contraseña almacenada
        $contraseñaAlmacenada = $datos->contraseña;
        
        // Verifica la contraseña
        if($contraseñaAlmacenada === $contra) {
            return view('consultas.calendario');
        } else {
            return redirect()->route("Entradaprincipal")->with("success", "Contraseña incorrecta.");
        }
    }
    
}
