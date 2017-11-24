<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Origen;


class OrigenController extends Controller
{
    public function index()
    {
        $origenes=Origen::paginate(20);
        return view('origenes.index')->with('origenes',$origenes)->with('seccion','origenes');
    }

    public function create()
    {
        return view('origenes.create')->with('seccion','origenes');
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
            Origen::create([
                'nombre' => $request->nombre,
            ]);
            return redirect()->route('origenes.index');

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
        $origen=Origen::find(decodifica($id));
        return view('origenes.edit')->with('origen',$origen)->with('seccion','origenes');
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
            Origen::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('origenes.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function origenes_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        Origen::find($id)->update($data);
        return back();
    }
}
