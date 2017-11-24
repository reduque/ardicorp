<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;
use App\Pais;


class ClienteController extends Controller
{
    public function index()
    {
        $clientes=Cliente::paginate(20);
        return view('clientes.index')->with('clientes',$clientes)->with('seccion','clientes');
    }

    public function create()
    {
        $paises=Pais::orderby("pais")->get();
        return view('clientes.create')->with('paises',$paises)->with('seccion','clientes');
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'rif' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            Cliente::create([
                'nombre' => $request->nombre,
                'rif' => $request->rif,
                'telefono' => $request->telefono,
                'pais_id' => $request->pais_id,
                'ciudad' => $request->ciudad,
                'direccion' => $request->direccion,
                'nombre1' => $request->nombre1,
                'area1' => $request->area1,
                'telefono1' => $request->telefono1,
                'nombre2' => $request->nombre2,
                'area2' => $request->area2,
                'telefono2' => $request->telefono2,
                'nombre3' => $request->nombre3,
                'area3' => $request->area3,
                'telefono3' => $request->telefono3,
            ]);
            return redirect()->route('clientes.index');

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
        $cliente=Cliente::find(decodifica($id));
        $paises=Pais::orderby("pais")->get();
        return view('clientes.edit')->with('cliente',$cliente)->with("paises",$paises)->with('seccion','clientes');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nombre' => 'required',
            'rif' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $data=[
                'nombre' => $request->nombre,
                'rif' => $request->rif,
                'telefono' => $request->telefono,
                'pais_id' => $request->pais_id,
                'ciudad' => $request->ciudad,
                'direccion' => $request->direccion,
                'nombre1' => $request->nombre1,
                'area1' => $request->area1,
                'telefono1' => $request->telefono1,
                'nombre2' => $request->nombre2,
                'area2' => $request->area2,
                'telefono2' => $request->telefono2,
                'nombre3' => $request->nombre3,
                'area3' => $request->area3,
                'telefono3' => $request->telefono3,
            ];
            Cliente::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('clientes.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function clientes_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        Cliente::find($id)->update($data);
        return back();
    }
}
