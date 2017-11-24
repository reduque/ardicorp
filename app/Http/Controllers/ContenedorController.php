<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Contenedor;
use App\Cliente;
use App\DocumentoTipo;
use App\ContenedorDocumento;

use App\PlantaProcesadora;
use App\Naviera;
use App\Agentes;
use App\Permiso;
use App\Origen;
use App\Producto;


class ContenedorController extends Controller
{
    public function index()
    {
        $contenedores=Contenedor::orderby('created_at','desc')->paginate(20);
        return view('contenedores.index')->with('contenedores',$contenedores)->with('seccion','contenedores');
    }

    public function create()
    {
        $clientes=Cliente::where("activo",1)->orderby("nombre")->get();
        $plantas=PlantaProcesadora::where("activo",1)->orderby("nombre")->get();
        $navieras=Naviera::where("activo",1)->orderby("nombre")->get();
        $agentes=Agentes::where("activo",1)->orderby("nombre")->get();
        $permisos=Permiso::orderby("fechaexpiracion","desc")->get();
        $origenes=Origen::orderby("nombre")->get();
        $productos=Producto::get();
        return view('contenedores.create')
        ->with("clientes",$clientes)
        ->with("plantas",$plantas)
        ->with("navieras",$navieras)
        ->with("agentes",$agentes)
        ->with("permisos",$permisos)
        ->with("origenes",$origenes)
        ->with("productos",$productos)
        ->with('seccion','contenedores');
    }

    public function store(Request $request)
    {
        $rules = [
            'bl' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $year=date('Y');
            $producto=Producto::find($request->producto_id1);
            if($year==$producto->id_ano){
                $id_numero=$producto->id_numero+1;
                $producto->update(['id_numero'=>$id_numero]);
            }else{
                $id_numero=1;
                $producto->update(['id_ano'=>$year,'id_numero'=>$id_numero]);
            }

            $contenedor=Contenedor::create([
                'bl' => $request->bl,
                'cliente_id' => $request->cliente_id,
                'user_id' => Auth::user()->id,
                'plantasprocesadora_id' => $request->plantasprocesadora_id,
                'naviera_id' => $request->naviera_id,
                'agentesaduanal_id' => $request->agentesaduanal_id,
                'ncontenedor' => $request->ncontenedor,
                'precinto' => $request->precinto,
                'fecha_reconocimiento' => $request->fecha_reconocimiento,
                'fecha_estimada_salida' => $request->fecha_estimada_salida,
                'fecha_entrada_puerto' => $request->fecha_entrada_puerto,
                'etd' => $request->etd,
                'eta' => $request->eta,
                'carga' => $request->carga,
                'cajas' => $request->cajas,
                'permiso_id' => $request->permiso_id,
                'producto_id1' => $request->producto_id1,
                'producto_id2' => $request->producto_id2,
                'producto_id3' => $request->producto_id3,
                'origen_id' => $request->origen_id,
                'gastos_exportacion_bs' => $request->gastos_exportacion_bs,
                'gastos_exportacion_usd' => $request->gastos_exportacion_usd,
                'fecha_pago_gastos_exportacion' => $request->fecha_pago_gastos_exportacion,
                'gastos_bolipuertos_bs' => $request->gastos_bolipuertos_bs,
                'gastos_bolipuertos_usd' => $request->gastos_bolipuertos_usd,
                'factura' => $request->factura,
                'monto_factura_usd' => $request->monto_factura_usd,
                'anticipo' => $request->anticipo,
                'fecha_pago_anticipo' => $request->fecha_pago_anticipo,
                'pago_final' => $request->pago_final,
                'fecha_pago_final' => $request->fecha_pago_final,
                'flete' => $request->flete,
                'comisiones' => $request->comisiones,
                'observaciones' => $request->observaciones,
                'id_ano' => $year,
                'id_numero' => $id_numero,
            ]);

            $documentos=DocumentoTipo::where('activo',1)->get(['id']);
            foreach ($documentos as $documento) {
                ContenedorDocumento::create([
                    'documentostipo_id' => $documento->id,
                    'contenedor_id' => $contenedor->id,
                ]);
            }

            return redirect()->route('contenedores.index');

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $contenedor=Contenedor::find(decodifica($id));

        $clientes=Cliente::where("activo",1)->orderby("nombre")->get();
        $plantas=PlantaProcesadora::where("activo",1)->orderby("nombre")->get();
        $navieras=Naviera::where("activo",1)->orderby("nombre")->get();
        $agentes=Agentes::where("activo",1)->orderby("nombre")->get();
        $permisos=Permiso::orderby("fechaexpiracion","desc")->get();
        $origenes=Origen::orderby("nombre")->get();
        $productos=Producto::get();
        return view('contenedores.edit')
        ->with('contenedor',$contenedor)
        ->with("clientes",$clientes)
        ->with("plantas",$plantas)
        ->with("navieras",$navieras)
        ->with("agentes",$agentes)
        ->with("permisos",$permisos)
        ->with("origenes",$origenes)
        ->with("productos",$productos)
        ->with('seccion','contenedores');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'bl' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
// OJO -------- Faltan campos
            $data=[
                'id_numero' => $request->id_numero,



                'bl' => $request->bl,
                'cliente_id' => $request->cliente_id,
                'user_id' => Auth::user()->id,
                'plantasprocesadora_id' => $request->plantasprocesadora_id,
                'naviera_id' => $request->naviera_id,
                'agentesaduanal_id' => $request->agentesaduanal_id,
                'ncontenedor' => $request->ncontenedor,
                'precinto' => $request->precinto,
                'fecha_reconocimiento' => $request->fecha_reconocimiento,
                'fecha_estimada_salida' => $request->fecha_estimada_salida,
                'fecha_entrada_puerto' => $request->fecha_entrada_puerto,
                'etd' => $request->etd,
                'eta' => $request->eta,
                'carga' => $request->carga,
                'cajas' => $request->cajas,
                'permiso_id' => $request->permiso_id,
                'producto_id1' => $request->producto_id1,
                'producto_id2' => $request->producto_id2,
                'producto_id3' => $request->producto_id3,
                'origen_id' => $request->origen_id,
                'gastos_exportacion_bs' => $request->gastos_exportacion_bs,
                'gastos_exportacion_usd' => $request->gastos_exportacion_usd,
                'fecha_pago_gastos_exportacion' => $request->fecha_pago_gastos_exportacion,
                'gastos_bolipuertos_bs' => $request->gastos_bolipuertos_bs,
                'gastos_bolipuertos_usd' => $request->gastos_bolipuertos_usd,
                'factura' => $request->factura,
                'monto_factura_usd' => $request->monto_factura_usd,
                'anticipo' => $request->anticipo,
                'fecha_pago_anticipo' => $request->fecha_pago_anticipo,
                'pago_final' => $request->pago_final,
                'fecha_pago_final' => $request->fecha_pago_final,
                'flete' => $request->flete,
                'comisiones' => $request->comisiones,
                'observaciones' => $request->observaciones,
            ];
            Contenedor::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('contenedores.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function contenedores_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        Contenedor::find($id)->update($data);
        return back();
    }
}
