@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Clientes</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("clientes.index") }}"><i class="fa fa-fw fa-address-book"></i> Clientes</a></li>
            <li>Crear</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('clientes.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>

<form role="form" action="{{ route('clientes.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" maxlength="200" required autofocus>
                @if ($errors->has('nombre'))
                    <p class="help-block">{{ $errors->first('nombre') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('rif') ? ' has-error' : '' }}">
                <label>RIF</label>
                <input type="text" class="form-control" name="rif" value="{{ old('rif') }}" maxlength="20" required>
                @if ($errors->has('rif'))
                    <p class="help-block">{{ $errors->first('rif') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                <label>Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" maxlength="20">
                @if ($errors->has('telefono'))
                    <p class="help-block">{{ $errors->first('telefono') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label><i class="fa fa-fw fa-flag"></i> País</label>
                <select name="pais_id" class="form-control">
                @foreach($paises as $pais)
                    <option value="{{ $pais->id }}"@if($pais->id==old('pais_id')) selected @endif>{{ $pais->pais }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="{{ old('ciudad') }}" maxlength="100">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Dirección</label>
                <textarea name="direccion" class="form-control">{{ old('direccion') }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-12">
            <h3><i class="fa fa-fw fa-address-card-o"></i> Contactos</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre1" value="{{ old('nombre1') }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Área funcional</label>
                <input type="text" class="form-control" name="area1" value="{{ old('area1') }}" maxlength="40">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" class="form-control" name="telefono1" value="{{ old('telefono1') }}" maxlength="20">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre2" value="{{ old('nombre2') }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Área funcional</label>
                <input type="text" class="form-control" name="area2" value="{{ old('area2') }}" maxlength="40">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" class="form-control" name="telefono2" value="{{ old('telefono2') }}" maxlength="20">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre3" value="{{ old('nombre3') }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Área funcional</label>
                <input type="text" class="form-control" name="area3" value="{{ old('area3') }}" maxlength="40">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" class="form-control" name="telefono3" value="{{ old('telefono3') }}" maxlength="20">
            </div>
        </div>
    </div>
    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-primary">Guardar</button></div></div>
</form>


@endsection
