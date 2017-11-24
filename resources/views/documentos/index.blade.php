@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Documentos</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-file-text"></i> Documentos</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Identificación</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($contenedores as $contenedor)
                    <tr>
                        <td><a href="{{ route('documentos_detalle', ['id' => codifica($contenedor->id)]) }}">{{ $contenedor->bl }}</a></td>
                        <td><a href="{{ route('documentos_detalle', ['id' => codifica($contenedor->id)]) }}">@if($contenedor->cliente){{ $contenedor->cliente->nombre }}@endif</a></td>
                        <td><a href="{{ route('documentos_detalle', ['id' => codifica($contenedor->id)]) }}">{{ date('d/m/Y', strtotime($contenedor->created_at)) }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        {{$contenedores->render()}}
    </div>
</div>

@endsection
