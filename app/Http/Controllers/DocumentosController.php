<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Contenedor;
use App\Cliente;
use App\DocumentoTipo;
use App\ContenedorDocumento;
use App\Documento;


class DocumentosController extends Controller
{
    public function index()
    {
        if(Auth::user()->tipo=='Cliente'){
            $contenedores=Contenedor::where('cliente_id', Auth::user()->cliente_id)->orderby('created_at','desc')->paginate(20);
        }else{
            $contenedores=Contenedor::orderby('created_at','desc')->paginate(20);
        }

        return view('documentos.index')->with('contenedores',$contenedores)->with('seccion','documentos');
    }

    public function detalle($id)
    {
        $id=decodifica($id);
        $contenedor=Contenedor::find($id);
        return view('documentos.detalle')->with('contenedor',$contenedor)->with('seccion','documentos');
    }
    public function cargar_documentos($id,$tipo)
    {
        $contenedor=Contenedor::find(decodifica($id));
        $tipodocumento=DocumentoTipo::find(decodifica($tipo),['titulo']);
        return view('documentos.cargar')->with('contenedor',$contenedor)->with('tipodocumento',$tipodocumento)->with('tipo',$tipo)->with('seccion','documentos');
    }

    public function cargar(Request $request)
    {
        $id=decodifica($request->id);
        $nombre_original=$_FILES["file"]["name"];
        $path_parts = pathinfo($_FILES["file"]["name"]);
        $extension = $path_parts['extension'];

        $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . '.' . $extension;

        $directorioUpload='uploads/contenedores/' . $id;
        @mkdir ($directorioUpload,0755);
        $ok = (@is_uploaded_file($_FILES['file']['tmp_name']) && @move_uploaded_file($_FILES['file']['tmp_name'], $directorioUpload . "/" . $fileName));
        if($ok){
            $contenedordocumento=ContenedorDocumento::where('contenedor_id',$id)->where('documentostipo_id',decodifica($request->tipo))->first();
            $contenedordocumento->update(['cargado'=>1]);
            Documento::create([
                'contenedordocumento_id' => $contenedordocumento->id,
                'user_id' => Auth::user()->id,
                'titulo' => $request->titulo,
                'archivo' => $fileName
            ]);
            return redirect()->route('documentos_detalle', ['id' => codifica($id)]);
        }else{
            return back()->withInput();
        }
    }
}
