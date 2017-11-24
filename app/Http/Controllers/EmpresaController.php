<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresa;


class EmpresaController extends Controller
{
    public function index()
    {
        $empresas=Empresa::paginate(20);
        return view('empresas.index')->with('empresas',$empresas)->with('seccion','empresas');
    }

    public function create()
    {
        return view('empresas.create')->with('seccion','empresas');
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            Empresa::create([
                'nombre' => $request->nombre,
            ]);
            return redirect()->route('empresas.index');

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
        $empresa=Empresa::find(decodifica($id));
        return view('empresas.edit')->with('empresa',$empresa)->with('seccion','empresas');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nombre' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $data=[
                'nombre' => $request->nombre,
            ];
            Empresa::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('empresas.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function empresas_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        Empresa::find($id)->update($data);
        return back();
    }
}
