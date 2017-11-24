@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Plantas procesadoras</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("plantas.index") }}"><i class="fa fa-fw fa-industry"></i> Plantas procesadoras</a></li>
            <li>Crear</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('plantas.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>

<form role="form" action="{{ route('plantas.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" maxlength="40" required autofocus>
                @if ($errors->has('nombre'))
                    <p class="help-block">{{ $errors->first('nombre') }}</p>
                @endif
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