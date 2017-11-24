@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Agentes aduanales</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-money"></i> Agentes aduanales</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('agentes.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
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
                @foreach($agentes as $agente)
                    <tr>
                        <td><a href="{{ route('agentes.edit', codifica($agente->id) ) }}" title="Editar">{{ $agente->nombre }}</a></td>
                        <td><a href="{{ route('agentes.edit', codifica($agente->id) ) }}" title="Editar">{{ $agente->rif }}</a></td>
                        <td><a href="{{ route('agentes.edit', codifica($agente->id) ) }}" title="Editar">{{ $agente->telefono }}</a></td>
                        <td>
                            <a href="{{ route('agentes.edit', codifica($agente->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                        @if($agente->activo==1)
                            <a href="{{ route('agentes_estado', ["id"=>codifica($agente->id), "estado"=>0]) }}" title="Bloquear"><i class="fa fa-fw fa-ban bloquear"></i></a>
                        @else
                            <a href="{{ route('agentes_estado', ["id"=>codifica($agente->id), "estado"=>1]) }}" title="Activar"><i class="fa fa-fw fa-reply-all bloquear"></i></a>
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
        {{$agentes->render()}}
    </div>
</div>

@endsection
