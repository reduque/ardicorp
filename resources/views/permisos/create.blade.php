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
            <li>Crear</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('permisos.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>

<form role="form" action="{{ route('permisos.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                <label>Número</label>
                <input type="text" class="form-control" name="numero" value="{{ old('numero') }}" maxlength="20" required autofocus>
                @if ($errors->has('numero'))
                    <p class="help-block">{{ $errors->first('numero') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                <label>Fecha</label>
                <input type="date" class="form-control" name="fecha" value="{{ old('fecha') }}" maxlength="10" required>
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
                <input type="date" class="form-control" name="fechaexpiracion" value="{{ old('fechaexpiracion') }}" maxlength="10" required>
                @if ($errors->has('fechaexpiracion'))
                    <p class="help-block">{{ $errors->first('fechaexpiracion') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('vigencia') ? ' has-error' : '' }}">
                <label>Vigencia</label>
                <input type="number" class="form-control" name="vigencia" value="{{ old('vigencia') }}" min="1" required>
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
                    <option value="{{ $destino->id }}"@if($destino->id==old('destino_id')) selected @endif>{{ $destino->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label><i class="fa fa-fw fa-university"></i> Empresas</label>
                <select name="empresa_id" class="form-control">
                @foreach($empresas as $empresa)
                    <option value="{{ $empresa->id }}"@if($empresa->id==old('empresa_id')) selected @endif>{{ $empresa->nombre }}</option>
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
                    <option value="{{ $producto->id }}"@if($producto->id==old('producto_id')) selected @endif>{{ $producto->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('ncontenedores') ? ' has-error' : '' }}">
                <label>Número de contenedores</label>
                <input type="number" class="form-control" name="ncontenedores" value="{{ old('ncontenedores',4) }}" min="1" required>
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
    </div>
    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-primary">Guardar</button></div></div>
</form>

@endsection
