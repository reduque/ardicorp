<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Agentes;


class AgenteController extends Controller
{
    public function index()
    {
        $agentes=Agentes::paginate(20);
        return view('agentes.index')->with('agentes',$agentes)->with('seccion','agentes');
    }

    public function create()
    {
        return view('agentes.create')->with('seccion','agentes');
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
            Agentes::create([
                'nombre' => $request->nombre,
                'rif' => $request->rif,
                'telefono' => $request->telefono,
                'contacto' => $request->contacto,
                'direccion' => $request->direccion,
            ]);
            return redirect()->route('agentes.index');

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
        $agente=Agentes::find(decodifica($id));
        return view('agentes.edit')->with('agente',$agente)->with('seccion','agentes');
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
                'contacto' => $request->contacto,
                'direccion' => $request->direccion,
            ];
            Agentes::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('agentes.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function agentes_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        Agentes::find($id)->update($data);
        return back();
    }
}
