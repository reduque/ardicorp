@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Permisos</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-thumbs-o-up"></i> Permisos</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('permisos.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Fecha de expedición</th>
                        <th>Vigencia</th>
                        <th>Empresa</th>
                        <th width="1">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($permisos as $permiso)
                    <tr>
                        <td><a href="{{ route('permisos.edit', codifica($permiso->id) ) }}" title="Editar">{{ $permiso->numero }}</a></td>
                        <td><a href="{{ route('permisos.edit', codifica($permiso->id) ) }}" title="Editar">{{ date('d/m/Y',strtotime($permiso->fechaexpiracion)) }}</a></td>
                        <td><a href="{{ route('permisos.edit', codifica($permiso->id) ) }}" title="Editar">{{ $permiso->vigencia }}</a></td>
                        <td><a href="{{ route('permisos.edit', codifica($permiso->id) ) }}" title="Editar">{{ $permiso->empresa->nombre }}</a></td>
                        <td>
                            <a href="{{ route('permisos.edit', codifica($permiso->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
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
        {{$permisos->render()}}
    </div>
</div>

@endsection
