<?php

namespace App\Http\Controllers;

use App\Models\almacen_armazones;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class AlmacenArmazonesController extends Controller
{
    public function prueba()
    {
        // Devuelve la vista 'armazoneslayout.pruebas'
        return view('armazoneslayout.pruebas');
    }
    
    public function index()
    {
        // Recupera todos los datos de la tabla almacen_armazones
        // $datos = almacen_armazones::paginate(3);

        $datos = almacen_armazones::simplePaginate(8);
        // Devuelve la vista 'armazoneslayout.busqueda' con los datos recuperados
        return view('armazoneslayout.busqueda', compact('datos'));
    }

    public function Generarbarras()
    {
        // Recupera todos los datos de la tabla almacen_armazones
        // $datos = almacen_armazones::paginate(3);

        $datos = almacen_armazones::all();
        // Devuelve la vista 'armazoneslayout.busqueda' con los datos recuperados
        return view('barras.imprimirbarras', compact('datos'));
    }

    public function imprimir_codigos(Request $request)
    {
        $datos=$request->codigos_barras;
        // dd($datos);
        $pdf = PDF::loadView('barras.pdfBarras',compact('datos'));
        return $pdf->download('codigodebarras.pdf');
    }

    public function create()
    {
        // Devuelve la vista 'armazoneslayout.agregararmazon' para mostrar el formulario de creación
        return view('armazoneslayout.agregararmazon');
    }
    
    public function store(Request $request)
    {
        // Crea un nuevo registro en la base de datos con los datos proporcionados en el formulario de creación
        $trabajador = new almacen_armazones();
        $trabajador->proveedor = $request->input('proveedor');
        $trabajador->marca_proveedor = $request->input('marca');
        $trabajador->modelo_proveedor = $request->input('modelo');
        $trabajador->tamaño = $request->input('tamaño');
        $trabajador->codigo_barras = $request->input('codigoDeBarras');
        $trabajador->tipo = $request->input('tipo');
        $trabajador->precio = $request->input('precio');
        $trabajador->cantidad = $request->input('cantidad');
        $trabajador->save();
        $marcaN=$request->input('marca');
        // Redirige a la vista de index y muestra un mensaje de éxito
        return redirect()->route("armazones.index")->with("success", "Agregado $marcaN con éxito!");
    }
    // por nombre
    public function show(Request $request)
    {
        // Recibe datos del formulario de búsqueda y realiza una búsqueda en la base de datos
        $marca = $request->input('armazonInfo');

            $datos = almacen_armazones::where('marca_proveedor', 'LIKE', '%' . $marca . '%')->simplePaginate(8);
            return view('armazoneslayout.busqueda', compact('datos'));
    }
    //por barras
    public function show2(Request $request)
    {
        // Recibe datos del formulario de búsqueda y realiza una búsqueda en la base de datos
        $marca = $request->input('armazonInfo');

            $datos = almacen_armazones::where('codigo_barras', 'LIKE', '%' . $marca . '%')->simplePaginate(8);
            return view('armazoneslayout.busqueda', compact('datos'));
        
    }
    
    public function edit($codigo_barras)
    {
        // Recupera un registro específico de la base de datos para editar
        $armazon = almacen_armazones::find($codigo_barras);
    
        // Devuelve la vista 'armazoneslayout.actualizararmazon' con los datos del registro
        return view('armazoneslayout.actualizararmazon', compact('armazon'));
    }
    
    public function update(Request $request, $armazon)
    {
        // Actualiza un registro existente en la base de datos con los datos proporcionados en el formulario de edición
        $armazon = almacen_armazones::find($armazon);
        $armazon->proveedor = $request->post('proveedor');
        $armazon->marca_proveedor = $request->post('marca');
        $armazon->modelo_proveedor = $request->post('modelo');
        $armazon->tamaño = $request->post('tamaño');
        $armazon->codigo_barras = $request->input('codigoDeBarras');
        $armazon->tipo = $request->post('tipo');
        $armazon->precio = $request->post('precio');
        $armazon->cantidad = $request->post('cantidad');
        $armazon->save();
        $marcaN=$request->input('marca');
    
        // Redirige a la vista de index y muestra un mensaje de éxito
        return redirect()->route("armazones.index")->with("success", "Armazon $marcaN editado con éxito!");   
    }
    
    public function destroy($armazon)
    {
        // Elimina un registro específico de la base de datos
        $trabajador = almacen_armazones::find($armazon);
        $marcaN=$trabajador->marca_proveedor;
        $trabajador->delete();
    
        // Redirige a la vista de index y muestra un mensaje de éxito
        return redirect()->route("armazones.index")->with("success", "Armazon $marcaN eliminado con éxito!");
    }
    
}
