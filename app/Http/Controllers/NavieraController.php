<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Naviera;


class NavieraController extends Controller
{
    public function index()
    {
        $navieras=Naviera::paginate(20);
        return view('navieras.index')->with('navieras',$navieras)->with('seccion','navieras');
    }

    public function create()
    {
        return view('navieras.create')->with('seccion','navieras');
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
            Naviera::create([
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
            return redirect()->route('navieras.index');

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
        $naviera=Naviera::find(decodifica($id));
        return view('navieras.edit')->with('naviera',$naviera)->with('seccion','navieras');
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
            Naviera::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('navieras.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function navieras_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        Naviera::find($id)->update($data);
        return back();
    }
}
