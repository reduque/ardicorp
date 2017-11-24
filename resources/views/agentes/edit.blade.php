@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Agentes aduanales</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("agentes.index") }}"><i class="fa fa-fw fa-money"></i> Agentes aduanales</a></li>
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
        <p class="text-right"><a href="{{ route('agentes.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('agentes.update', codifica($agente->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $agente->nombre) }}" maxlength="200" required autofocus>
                @if ($errors->has('nombre'))
                    <p class="help-block">{{ $errors->first('nombre') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('rif') ? ' has-error' : '' }}">
                <label>RIF</label>
                <input type="text" class="form-control" name="rif" value="{{ old('rif', $agente->rif) }}" maxlength="20" required>
                @if ($errors->has('rif'))
                    <p class="help-block">{{ $errors->first('rif') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                <label>Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $agente->telefono) }}" maxlength="20">
                @if ($errors->has('telefono'))
                    <p class="help-block">{{ $errors->first('telefono') }}</p>
                @endif
            </div>
        </div>
         <div class="col-lg-6">
            <div class="form-group{{ $errors->has('contacto') ? ' has-error' : '' }}">
                <label>Contacto</label>
                <input type="text" class="form-control" name="contacto" value="{{ old('contacto', $agente->contacto) }}" maxlength="60" required>
                @if ($errors->has('contacto'))
                    <p class="help-block">{{ $errors->first('contacto') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                <label>Dirección</label>
                <textarea name="direccion" class="form-control" rows="3">{{ old('direccion', $agente->direccion) }}</textarea>
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
