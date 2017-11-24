<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DocumentoTipo;


class DocumentoTipoController extends Controller
{
    public function index()
    {
        $documentotipos=DocumentoTipo::paginate(20);
        return view('documentotipos.index')->with('documentotipos',$documentotipos)->with('seccion','documentotipos');
    }

    public function create()
    {
        return view('documentotipos.create')->with('seccion','documentotipos');
    }

    public function store(Request $request)
    {
        $rules = [
            'titulo' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            DocumentoTipo::create([
                'titulo' => $request->titulo,
            ]);
            return redirect()->route('documentotipos.index');

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
        $documentotipo=DocumentoTipo::find(decodifica($id));
        return view('documentotipos.edit')->with('documentotipo',$documentotipo)->with('seccion','documentotipos');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'titulo' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $data=[
                'titulo' => $request->titulo,
            ];
            DocumentoTipo::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('documentotipos.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function documentotipos_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        DocumentoTipo::find($id)->update($data);
        return back();
    }
}
