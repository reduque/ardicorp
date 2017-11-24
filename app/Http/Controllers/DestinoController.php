<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Destino;
use App\Pais;


class DestinoController extends Controller
{
    public function index()
    {
        $destinos=Destino::paginate(20);
        return view('destinos.index')->with('destinos',$destinos)->with('seccion','destinos');
    }

    public function create()
    {
        $paises=Pais::orderby("pais")->get();
        return view('destinos.create')->with('paises',$paises)->with('seccion','destinos');
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
            Destino::create([
                'nombre' => $request->nombre,
                'pais_id' => $request->pais_id,
            ]);
            return redirect()->route('destinos.index');

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
        $paises=Pais::orderby("pais")->get();
        $destino=Destino::find(decodifica($id));
        return view('destinos.edit')->with('destino',$destino)->with("paises",$paises)->with('seccion','destinos');
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
                'pais_id' => $request->pais_id,
            ];
            Destino::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('destinos.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function destinos_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        Destino::find($id)->update($data);
        return back();
    }
}
