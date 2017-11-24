<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Producto;


class ProductoController extends Controller
{
    public function index()
    {
        $productos=Producto::paginate(20);
        return view('productos.index')->with('productos',$productos)->with('seccion','productos');
    }

    public function create()
    {
        return view('productos.create')->with('seccion','productos');
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
            Producto::create([
                'nombre' => $request->nombre,
            ]);
            return redirect()->route('productos.index');

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
        $producto=Producto::find(decodifica($id));
        return view('productos.edit')->with('producto',$producto)->with('seccion','productos');
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
            Producto::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('productos.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function productos_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        Producto::find($id)->update($data);
        return back();
    }
}
