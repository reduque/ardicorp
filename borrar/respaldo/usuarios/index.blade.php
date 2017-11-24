@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Usuarios</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Inicio</li>
            <li class="active"> <i class="fa fa-fw fa-user"></i> Usuarios</li>
            <li>Listado</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('usuarios.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>email</th>
                        <th>Nombre</th>
                        <th>Cliente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td><a href="{{ route('usuarios.edit', codifica($usuario->id) ) }}" title="Editar">{{ $usuario->email }}</a></td>
                        <td><a href="{{ route('usuarios.edit', codifica($usuario->id) ) }}" title="Editar">{{ $usuario->nombre }}</a></td>
                        <td><a href="{{ route('usuarios.edit', codifica($usuario->id) ) }}" title="Editar">{{ $usuario->nombrec }}</a></td>
                        <td>
                            <a href="{{ route('usuarios.edit', codifica($usuario->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                        @if($usuario->activo==1)
                            <a href="" title="Bloquear"><i class="fa fa-fw fa-ban bloquear"></i></a>
                        @else
                            <a href="" title="Activar"><i class="fa fa-fw fa-check"></i></a>
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
        {{$usuarios->render()}}
    </div>
</div>

@endsection
