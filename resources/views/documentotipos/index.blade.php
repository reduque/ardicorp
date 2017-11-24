@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Tipos de documentos</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-file-text-o"></i> Tipos de documentos</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('documentotipos.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th width="1">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($documentotipos as $documentotipo)
                    <tr>
                        <td><a href="{{ route('documentotipos.edit', codifica($documentotipo->id) ) }}" title="Editar">{{ $documentotipo->titulo }}</a></td>
                        <td>
                            <a href="{{ route('documentotipos.edit', codifica($documentotipo->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                        @if($documentotipo->activo==1)
                            <a href="{{ route('documentotipos_estado', ["id"=>codifica($documentotipo->id), "estado"=>0]) }}" title="Bloquear"><i class="fa fa-fw fa-ban bloquear"></i></a>
                        @else
                            <a href="{{ route('documentotipos_estado', ["id"=>codifica($documentotipo->id), "estado"=>1]) }}" title="Activar"><i class="fa fa-fw fa-reply-all bloquear"></i></a>
                        @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        {{$documentotipos->render()}}
    </div>
</div>

@endsection
