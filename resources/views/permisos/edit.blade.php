@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Permisos</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("permisos.index") }}"><i class="fa fa-fw fa-thumbs-o-up"></i> Permisos</a></li>
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
        <p class="text-right"><a href="{{ route('permisos.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('permisos.update', codifica($permiso->id)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                <label>Número</label>
                <input type="text" class="form-control" name="numero" value="{{ old('numero', $permiso->numero) }}" maxlength="20" required autofocus>
                @if ($errors->has('numero'))
                    <p class="help-block">{{ $errors->first('numero') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                <label>Fecha</label>
                <input type="date" class="form-control" name="fecha" value="{{ old('fecha', date('Y-m-d',strtotime($permiso->fecha))) }}" maxlength="10" required>
                @if ($errors->has('fecha'))
                    <p class="help-block">{{ $errors->first('fecha') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('fechaexpiracion') ? ' has-error' : '' }}">
                <label>Fecha de expiración</label>
                <input type="date" class="form-control" name="fechaexpiracion" value="{{ old('fechaexpiracion', date('Y-m-d',strtotime($permiso->fechaexpiracion))) }}" maxlength="10" required>
                @if ($errors->has('fechaexpiracion'))
                    <p class="help-block">{{ $errors->first('fechaexpiracion') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('vigencia') ? ' has-error' : '' }}">
                <label>Vigencia</label>
                <input type="number" class="form-control" name="vigencia" value="{{ old('vigencia', $permiso->vigencia) }}" min="1" required>
                @if ($errors->has('vigencia'))
                    <p class="help-block">{{ $errors->first('vigencia') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label><i class="fa fa-fw fa-flag"></i> Destino</label>
                <select name="destino_id" class="form-control">
                @foreach($destinos as $destino)
                    <option value="{{ $destino->id }}"@if($destino->id==old('destino_id', $permiso->destino_id)) selected @endif>{{ $destino->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label><i class="fa fa-fw fa-university"></i> Empresas</label>
                <select name="empresa_id" class="form-control">
                @foreach($empresas as $empresa)
                    <option value="{{ $empresa->id }}"@if($empresa->id==old('empresa_id', $permiso->empresa_id)) selected @endif>{{ $empresa->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label><i class="fa fa-fw fa-shopping-bag"></i> Productos</label>
                <select name="producto_id" class="form-control">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}"@if($producto->id==old('producto_id', $permiso->producto_id)) selected @endif>{{ $producto->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('ncontenedores') ? ' has-error' : '' }}">
                <label>Número de contenedores</label>
                <input type="number" class="form-control" name="ncontenedores" value="{{ old('ncontenedores', $permiso->ncontenedores) }}" min="1" required>
                @if ($errors->has('ncontenedores'))
                    <p class="help-block">{{ $errors->first('ncontenedores') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Archivo a cargar</label>
                <input type="file" name="file">
            </div>
        </div>
        @if($permiso->foto<>"")
        <div class="col-lg-6">
            <div class="form-group">
                <a href="uploads/permisos/{{ $permiso->foto }}" target="_blank"><img src="uploads/permisos/{{ $permiso->foto }}" height="100"></a>
            </div>
        </div>
        @endif
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
