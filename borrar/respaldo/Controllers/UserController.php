<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Cliente;


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
            //return redirect($request->redirect_to);
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
}
