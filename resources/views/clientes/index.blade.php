@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Clientes</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-address-book"></i> Clientes</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('clientes.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>RIF</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td><a href="{{ route('clientes.edit', codifica($cliente->id) ) }}" title="Editar">{{ $cliente->nombre }}</a></td>
                        <td><a href="{{ route('clientes.edit', codifica($cliente->id) ) }}" title="Editar">{{ $cliente->rif }}</a></td>
                        <td><a href="{{ route('clientes.edit', codifica($cliente->id) ) }}" title="Editar">{{ $cliente->telefono }}</a></td>
                        <td>
                            <a href="{{ route('clientes.edit', codifica($cliente->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                        @if($cliente->activo==1)
                            <a href="{{ route('clientes_estado', ["id"=>codifica($cliente->id), "estado"=>0]) }}" title="Bloquear"><i class="fa fa-fw fa-ban bloquear"></i></a>
                        @else
                            <a href="{{ route('clientes_estado', ["id"=>codifica($cliente->id), "estado"=>1]) }}" title="Activar"><i class="fa fa-fw fa-reply-all bloquear"></i></a>
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
        {{$clientes->render()}}
    </div>
</div>

@endsection
