<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PlantaProcesadora;


class PlantaProductoraController extends Controller
{
    public function index()
    {
        $plantas=PlantaProcesadora::paginate(20);
        return view('plantas.index')->with('plantas',$plantas)->with('seccion','plantas');
    }

    public function create()
    {
        return view('plantas.create')->with('seccion','plantas');
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
            PlantaProcesadora::create([
                'nombre' => $request->nombre,
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
            return redirect()->route('plantas.index');

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
        $planta=PlantaProcesadora::find(decodifica($id));
        return view('plantas.edit')->with('planta',$planta)->with('seccion','plantas');
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
            PlantaProcesadora::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('plantas.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function plantas_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        PlantaProcesadora::find($id)->update($data);
        return back();
    }
}
