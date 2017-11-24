@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Contenedores</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-truck"></i> Contenedores</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('contenedores.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Identificación</th>
                        <th>Contenedor</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th width="1">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($contenedores as $contenedor)
                    <tr>
                        <td><a href="{{ route('contenedores.edit', codifica($contenedor->id) ) }}" title="Editar">{{ $contenedor->id }}</a></td>
                        <td><a href="{{ route('contenedores.edit', codifica($contenedor->id) ) }}" title="Editar">{{ $contenedor->ncontenedor }}</a></td>
                        <td><a href="{{ route('contenedores.edit', codifica($contenedor->id) ) }}" title="Editar">@if($contenedor->cliente){{ $contenedor->cliente->nombre }}@endif</a></td>
                        <td><a href="{{ route('contenedores.edit', codifica($contenedor->id) ) }}" title="Editar">{{ date('d/m/Y', strtotime($contenedor->created_at)) }}</a></td>
                        <td>
                            <a href="{{ route('contenedores.edit', codifica($contenedor->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
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
        {{$contenedores->render()}}
    </div>
</div>

@endsection
