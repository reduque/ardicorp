<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pais;


class PaisController extends Controller
{
    public function index()
    {
        $paises=Pais::orderby('pais')->paginate(20);
        return view('paises.index')->with('paises',$paises)->with('seccion','paises');
    }

    public function create()
    {
        return view('paises.create')->with('seccion','paises');
    }

    public function store(Request $request)
    {
        $rules = [
            'pais' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            Pais::create([
                'pais' => $request->pais,
            ]);
            return redirect()->route('paises.index');

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
        $pais=Pais::find(decodifica($id));
        return view('paises.edit')->with('pais',$pais)->with('seccion','paises');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'pais' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $data=[
                'pais' => $request->pais,
            ];
            Pais::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('paises.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        Pais::find($id)->delete();
        return redirect()->route('paises.index');
    }
    public function paises_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        Pais::find($id)->update($data);
        return back();
    }
}
