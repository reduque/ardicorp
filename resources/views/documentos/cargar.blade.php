@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Tipos de documentos</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("documentos_index") }}"><i class="fa fa-fw fa-file-text"></i> Documentos</a></li>
            <li><a href="{{ route('documentos_detalle', ['id' => codifica($contenedor->id)]) }}">{{ $contenedor->bl }}</a></li>
            <li>Cargar documentos: {{ $tipodocumento->titulo }}</li>
        </ol>
    </div>
</div>
<form name="form1" method=POST action="{{ route('cargar_documentos2') }}" enctype="multipart/form-data" onSubmit="ver()">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ codifica($contenedor->id) }}">
    <input type="hidden" name="tipo" value="{{ $tipo }}">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Título</label>
                <input type="text" class="form-control" name="titulo" maxlength="100" value="{{ old('titulo') }}" required autofocus>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Archivo a cargar</label>
                <input type="file" name="file">
            </div>
        </div>
    </div>
    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-primary">Guardar</button></div></div>
</form>

<script type="text/javascript">
    function ver(){
        if (document.form1.file.value.length==0){
            alert("Debe seleccionar un archivo");event.returnValue=false;
        }else{
            $(".side-nav").hide(0);
            $("body").append("<div class='cargando'><div>Cargando el contenido. Por favor no cierre ni refresque esta ventana</div></div>");
        }
    }
</script>
@endsection
