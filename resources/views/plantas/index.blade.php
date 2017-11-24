@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Plantas procesadoras</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-industry"></i> Plantas procesadoras</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('plantas.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
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
                @foreach($plantas as $planta)
                    <tr>
                        <td><a href="{{ route('plantas.edit', codifica($planta->id) ) }}" title="Editar">{{ $planta->nombre }}</a></td>
                        <td>
                            <a href="{{ route('plantas.edit', codifica($planta->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                        @if($planta->activo==1)
                            <a href="{{ route('plantas_estado', ["id"=>codifica($planta->id), "estado"=>0]) }}" title="Bloquear"><i class="fa fa-fw fa-ban bloquear"></i></a>
                        @else
                            <a href="{{ route('plantas_estado', ["id"=>codifica($planta->id), "estado"=>1]) }}" title="Activar"><i class="fa fa-fw fa-reply-all bloquear"></i></a>
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
        {{$plantas->render()}}
    </div>
</div>

@endsection