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
            <li>Documentos que administra</li>
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

<form role="form" action="{{ route('update_documentos', ['id' => $id]) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            @foreach($documentos as $documento)
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input name="documentos[]" type="checkbox" value="{{ codifica($documento->id) }}"@if($documento->user_id) checked @endif>{{ $documento->titulo }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <p> </p>
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
