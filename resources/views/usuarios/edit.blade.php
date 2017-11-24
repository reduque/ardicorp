@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Usuarios</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("usuarios.index") }}"><i class="fa fa-fw fa-user"></i> Usuarios</a></li>
            <li>Editar</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
    @if($notificacion=Session::get('notificacion'))
        <div class="alert alert-success">{{ $notificacion }}</div>
    @endif
    </div>
    <div class="col-lg-2">
        <p class="text-right"><a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('usuarios.update', codifica($usuario->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" maxlength="120" required autofocus>
                @if ($errors->has('nombre'))
                    <p class="help-block">{{ $errors->first('nombre') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $usuario->email) }}" maxlength="100" required readonly>
                @if ($errors->has('email'))
                    <p class="help-block">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Tipo de usuario</label>
                <select name="tipo" class="form-control">
                    <option value="Trabajador"@if(old('tipo', $usuario->tipo)=='Trabajador') selected @endif>Trabajador</option>
                    <option value="Cliente"@if(old('tipo', $usuario->tipo)=='Cliente') selected @endif>Cliente</option>
                    <option value="Administrador"@if(old('tipo', $usuario->tipo)=='Administrador') selected @endif>Administrador</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Cliente</label>
                <select name="cliente_id" class="form-control">
                    <option value="0">No aplica</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}"@if($cliente->id==old('cliente_id', $usuario->cliente_id)) selected @endif>{{ $cliente->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-primary">Guardar</button></div></div>
</form>


@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function(){
                $(".alert").slideUp(500);
            },3000)
        })
    </script>
@endsection
