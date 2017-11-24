<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Cliente;
use App\DocumentoTipo;
use App\DocumentosResponsable;

class UserController extends Controller
{
    public function index()
    {
        $usuarios=User::select(["users.id","email","users.nombre","tipo", "clientes.nombre as nombrec", "users.activo"])->leftJoin("clientes","users.cliente_id","=","clientes.id")->paginate(20);
        return view('usuarios.index')->with('usuarios',$usuarios)->with('seccion','usuarios');
    }

    public function create()
    {
        $clientes=Cliente::where("activo",1)->orderby("nombre")->get();
        return view('usuarios.create')->with('seccion','usuarios')->with("clientes",$clientes);
    }

    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            User::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'tipo' => $request->tipo,
                'cliente_id' => $request->cliente_id,
            ]);
            return redirect()->route('usuarios.index');

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
        $usuario=User::find(decodifica($id));
        $clientes=Cliente::where("activo",1)->orderby("nombre")->get();
        return view('usuarios.edit')->with('usuario',$usuario)->with("clientes",$clientes)->with('seccion','usuarios');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'email' => 'required|email',
            ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $data=[
                'nombre' => $request->nombre,
                'tipo' => $request->tipo,
                'cliente_id' => $request->cliente_id,
            ];
            User::find($id)->update($data);
            return redirect()->route('usuarios.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
    public function usuarios_estado($id,$estado)
    {
        $id=decodifica($id);
        $data=[
            'activo' => $estado,
        ];
        User::find($id)->update($data);
        return back();
    }
    public function edit_password($id)
    {
        $usuario=User::find(decodifica($id));
        return view('usuarios.edit_password')->with('usuario',$usuario)->with('seccion','usuarios');
    }
    public function update_password(Request $request, $id)
    {
        $rules = [
            'password' => 'required|string|min:6|confirmed',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $data=[
                'password' => bcrypt($request->password),
            ];
            User::find($id)->update($data);
            return redirect()->route('edit_password', ["id" => codifica($id)])->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function edit_documentos($id){
        $id=decodifica($id);
        $documentos=DocumentoTipo::select(['documentostipos.id', 'titulo', 'user_id'])->where('activo',1)->leftjoin("documentosresponsables", function($query) use ($id)
        {
            $query->on('documentostipos.id','=','documentostipo_id')->where('user_id','=',$id);
        })->get();
        return view('usuarios.edit_documentos')->with('id',codifica($id))->with('documentos',$documentos)->with('seccion','usuarios');

    }

    public function update_documentos(Request $request, $id){
        $id=decodifica($id);
        DocumentosResponsable::where('user_id',$id)->delete();
        if($documentos=$request->documentos){
            if (is_array($documentos)) {
                 foreach($documentos as $value){
                    DocumentosResponsable::create([
                        'user_id' => $id,
                        'documentostipo_id' => decodifica($value),
                    ]);
                 }
              } else {
                $value = $documentos;
                DocumentosResponsable::create([
                    'user_id' => $id,
                    'documentostipo_id' => decodifica($value),
                ]);
           }
        }
        $documentos=DocumentoTipo::select(['documentostipos.id', 'titulo', 'user_id'])->where('activo',1)->leftjoin("documentosresponsables", function($query) use ($id)
        {
            $query->on('documentostipos.id','=','documentostipo_id')->where('user_id','=',$id);
        })->get();
        return redirect()->route('edit_documentos', ['id' => codifica($id)])->with('documentos',$documentos)->with('seccion','usuarios')->with("notificacion","Se ha guardado correctamente su información");
    }
}
