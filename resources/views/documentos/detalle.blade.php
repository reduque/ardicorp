@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Documentos</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("documentos_index") }}"><i class="fa fa-fw fa-file-text"></i> Documentos</a></li>
            <li>@if($contenedor->cliente){{$contenedor->cliente->nombre}} - @endif{{ $contenedor->bl }}</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tipo de documento</th>
                        <th>Documentos cargados</th>
                        <th width="1">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($contenedor->documentos as $documento)
                    <tr>
                        <td>{{ $documento->tipo->titulo }}</td>
                        <td>
                        @foreach($documento->archivos as $archivo)
                            <p><a href="uploads/contenedores/{{$contenedor->id}}/{{ $archivo->archivo }}" target="_blank">{{ $archivo->titulo }} - {{ $archivo->created_at }}</a></p>
                        @endforeach
                        </td>
                        <td>
                        <?php $soyresponsable=false;
                        foreach($documento->tipo->responsable as $responsable){
                            if($responsable->id==Auth::user()->id) $soyresponsable=true;
                        }
                        ?>
                        @if($soyresponsable)
                            <a href="{{ route('cargar_documentos', ['id' => codifica($contenedor->id), 'tipo' => codifica($documento->tipo->id)] ) }}" title="Cargar documentos"><i class="fa fa-fw fa-upload"></i></a>
                        @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
