<?php

namespace App\Http\Controllers;
use App\Models\almacen_insumos;
use App\Models\almacen_armazones;
use App\Models\venta;
use App\Models\cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;


class VentaController extends Controller
{
    public function verificarpersonas(Request $request)
    {
        $nombreCliente = $request->id_cliente;
        // Realizar la búsqueda por nomb
        $cliente = Cliente::find($nombreCliente);

        // Verificar si se encontró el cliente
        if ($cliente) {
            // Redireccionar con la información del cliente
            // return redirect()->route("vender", ['cliente' => $cliente]);
            $armazonesE = almacen_armazones::where('cantidad', '>', 0)->get();
            $insumosE = almacen_insumos::where('cantidad', '>', 0)->get();
            return view('ventas.ventaSegunda', compact('cliente', 'armazonesE', 'insumosE')); 
        } else {
            // Cliente no encontrado
            return redirect()->route("bucarclienteexistencia")->with("success", "Seleccione un nombre");
        }
    }
    
    public function verificarpersonas2(Request $request)
    {
    
        // Verificar si se encontró el cliente
            // Redireccionar con la información del cliente
            // return redirect()->route("vender", ['cliente' => $cliente]);
            $cliente=null;
            $armazonesE = almacen_armazones::where('cantidad', '>', 0)->get();
            $insumosE = almacen_insumos::where('cantidad', '>', 0)->get();
            return view('ventas.ventaSegunda', compact('cliente','armazonesE', 'insumosE')); 

    }
// verifica las a ventas a un cliente existente
    public function verificarpersonas3(Request $request)
    {
        $nombreCliente = $request->get('id_cliente');
        // dd($nombreCliente);
        // Realizar la búsqueda por nomb
        // $cliente = venta::find($nombreCliente);

        // Verificar si se encontró el cliente
        if ($nombreCliente) {
            // Redireccionar con la información del cliente
            // return redirect()->route("vender", ['cliente' => $cliente]);
            $datos = Venta::where('id_del_cliente', '=', $nombreCliente)->get();
            return view('ventas.mostrarVentas', compact('datos',));
        } else {
            // Cliente no encontrado
            return redirect()->route("bucarventasacliente")->with("success", "Seleccione un nombre");
        }
    }

    public function crearpdf(Request $request ){
        dd($request);
        $datos=$request;
        return view('ventas.pdfMica',compac('datos'));
    }

    public function mandarclientes()
    {
        $todos=cliente::all();
        return view('ventas.buscarcliente',compact('todos'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {        //dd($request);
        $cantidad_total=0;
        $informacion_venta="";
        $clienteid=$request->get('iddelcliente');
        $clientenombre=$request->get('nombreCliente');


        $idarmazones = $request->get('arrayid');
        $barras = $request->get('arrayproducto');
        $cantidadarmazonessobras = $request->get('arraycantidad');
        $cantidadarmazonesvendidos = $request->get('arraycantidadVendidoproducto');
        $subtotalarmazon = $request->get('arraysubtotal');
        $totalarmazon = $request->get('total');
        if ($idarmazones !== null) {
            foreach ($idarmazones as $index => $id) {
                $cantisobra = $cantidadarmazonessobras[$index];
                $canti = $cantidadarmazonesvendidos[$index];
                $cambio = almacen_armazones::find($id);
                $informacion_venta .= $barras[$index] . "-" . $canti . "-" . $subtotalarmazon[$index] . "*";
                    $cambio->cantidad = $cantisobra;
                    $cambio->save();
            }
            $cantidad_total=$cantidad_total+$totalarmazon;
        }

        $idinsumo = $request->get('arrayidInsumo');
        $nombre=$request->get('arrayproductoInsumo');
        $cantidadinsumosobrantes = $request->get('arraycantidadInsumo');
        $cantidadinsumovendidos = $request->get('arraycantidadVendidoproductoInsumo');
        $subtotalinsumo = $request->get('arraysubtotalInsumo');
        $totalinsumo = $request->get('totalI');
        if ($idinsumo !== null) {
            foreach ($idinsumo as $index => $id) {
                $cantisobra = $cantidadinsumosobrantes[$index];
                $cantI = $cantidadinsumovendidos[$index];
                $cambio = almacen_insumos::find($id);
                $informacion_venta .= $nombre[$index] . "-" . $cantI . "-" . $subtotalinsumo[$index] . "*";
                    $cambio->cantidad = $cantisobra;
                    $cambio->save();
            }
            $cantidad_total=$cantidad_total+$totalinsumo;
        }

        $vender = new venta();
        $vender->descripccionVenta =  $informacion_venta;
        $vender->precio_final =       $cantidad_total;
        $vender->fecha = Carbon::now();
        $vender->id_del_cliente=$clienteid;
        $vender->nombre_cliente=$clientenombre;
        $vender->save();
        
        return redirect()->route("bucarclienteexistencia")->with("success", " Venta realizada con exito");
    }

    public function show(Request $request)
    {
        $fechaI=$request->get('fecha_inicio');
        $fechaF=$request->get('fecha_fin');
        $datos = venta::whereBetween('fecha', [$fechaI, $fechaF])->get();
        return view('ventas.mostrarVentas', compact('datos'));
    }

    public function ventasdeldia()
    {
        $fecha = Carbon::now()->startOfDay(); // Fecha actual al inicio del día
        $datos = Venta::whereDate('fecha', $fecha)->get();
        return view('ventas.mostrarVentas', compact('datos'));
    }
    public function ventassincliente()
    {
        $datos = Venta::where('id_del_cliente', '=', 0)->get();
        return view('ventas.mostrarVentas', compact('datos'));
    }

    public function update(Request $request, venta $venta)
    {
        // $fechaI=Carbon::now();
        // $datos = venta::whereBetween('fecha', $fechaI)->get();
        // return view('ventas.mostrarVentas', compact('datos'));
       
    }

    public function reportesCliente()
    {
        $todos=cliente::all();
        return view('ventas.ventasacliente',compact('todos'));
    }
}
