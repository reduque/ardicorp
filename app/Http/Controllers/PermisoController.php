<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permiso;
use App\Destino;
use App\Empresa;
use App\Producto;


class PermisoController extends Controller
{
    public function index()
    {
        $permisos=Permiso::paginate(20);
        return view('permisos.index')->with('permisos',$permisos)->with('seccion','permisos');
    }

    public function create()
    {
        $destinos=Destino::where("activo",1)->orderby("nombre")->get();
        $empresas=Empresa::where("activo",1)->orderby("nombre")->get();
        $productos=Producto::where("activo",1)->orderby("nombre")->get();
        return view('permisos.create')->with('destinos',$destinos)->with('empresas',$empresas)->with('productos',$productos)->with('seccion','permisos');
    }

    public function store(Request $request)
    {
        $rules = [
            'numero' => 'required',
            'fecha' => 'required|date',
            'fechaexpiracion' => 'required|date',
            'vigencia' => 'required|numeric',
            'ncontenedores' => 'required|numeric',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $nombre_original=$_FILES["file"]["name"];
            if($nombre_original<>''){
                $path_parts = pathinfo($_FILES["file"]["name"]);
                $extension = $path_parts['extension'];

                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . '.' . $extension;

                $directorioUpload='uploads/permisos';
                @mkdir ($directorioUpload,0755);
                $ok = (@is_uploaded_file($_FILES['file']['tmp_name']) && @move_uploaded_file($_FILES['file']['tmp_name'], $directorioUpload . "/" . $fileName));
            }else{
                $ok=true;
                $fileName='';
            }
            if($ok){
                Permiso::create([
                    'numero' => $request->numero,
                    'fecha' => $request->fecha,
                    'fechaexpiracion' => $request->fechaexpiracion,
                    'vigencia' => $request->vigencia,
                    'destino_id' => $request->destino_id,
                    'empresa_id' => $request->empresa_id,
                    'producto_id' => $request->producto_id,
                    'ncontenedores' => $request->ncontenedores,
                    'foto' => $fileName,
                ]);
                return redirect()->route('permisos.index');
            }else{
                return back()->withInput();
            }



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
        $permiso=Permiso::find(decodifica($id));
        $destinos=Destino::where("activo",1)->orderby("nombre")->get();
        $empresas=Empresa::where("activo",1)->orderby("nombre")->get();
        $productos=Producto::where("activo",1)->orderby("nombre")->get();
        return view('permisos.edit')->with('permiso',$permiso)->with('destinos',$destinos)->with('empresas',$empresas)->with('productos',$productos)->with('seccion','permisos');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'numero' => 'required',
            'fecha' => 'required|date',
            'fechaexpiracion' => 'required|date',
            'vigencia' => 'required|numeric',
            'ncontenedores' => 'required|numeric',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $nombre_original=$_FILES["file"]["name"];
            if($nombre_original<>''){
                $path_parts = pathinfo($_FILES["file"]["name"]);
                $extension = $path_parts['extension'];

                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . '.' . $extension;

                $directorioUpload='uploads/permisos';
                $ok = (@is_uploaded_file($_FILES['file']['tmp_name']) && @move_uploaded_file($_FILES['file']['tmp_name'], $directorioUpload . "/" . $fileName));
                $data=[
                    'numero' => $request->numero,
                    'fecha' => $request->fecha,
                    'fechaexpiracion' => $request->fechaexpiracion,
                    'vigencia' => $request->vigencia,
                    'destino_id' => $request->destino_id,
                    'empresa_id' => $request->empresa_id,
                    'producto_id' => $request->producto_id,
                    'ncontenedores' => $request->ncontenedores,
                    'foto' => $fileName,
                ];
            }else{
                $data=[
                    'numero' => $request->numero,
                    'fecha' => $request->fecha,
                    'fechaexpiracion' => $request->fechaexpiracion,
                    'vigencia' => $request->vigencia,
                    'destino_id' => $request->destino_id,
                    'empresa_id' => $request->empresa_id,
                    'producto_id' => $request->producto_id,
                    'ncontenedores' => $request->ncontenedores,
                ];
            }
            Permiso::find($id)->update($data);
            //return redirect($request->redirect_to);
            return redirect()->route('permisos.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function permisos_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        Permiso::find($id)->update($data);
        return back();
    }
}
