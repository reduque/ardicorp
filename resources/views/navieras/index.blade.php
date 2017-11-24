@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Navieras</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-ship"></i> Navieras</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('navieras.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
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
                @foreach($navieras as $naviera)
                    <tr>
                        <td><a href="{{ route('navieras.edit', codifica($naviera->id) ) }}" title="Editar">{{ $naviera->nombre }}</a></td>
                        <td>
                            <a href="{{ route('navieras.edit', codifica($naviera->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                        @if($naviera->activo==1)
                            <a href="{{ route('navieras_estado', ["id"=>codifica($naviera->id), "estado"=>0]) }}" title="Bloquear"><i class="fa fa-fw fa-ban bloquear"></i></a>
                        @else
                            <a href="{{ route('navieras_estado', ["id"=>codifica($naviera->id), "estado"=>1]) }}" title="Activar"><i class="fa fa-fw fa-reply-all bloquear"></i></a>
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
        {{$navieras->render()}}
    </div>
</div>

@endsection
