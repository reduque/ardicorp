<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('/') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin.css?v=2') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
            @if($notificaciones->count()>0)
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle activ1" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                    @foreach($notificaciones as $notificacion)
                        <li>
                            <a href="{{ route('documentos_detalle', ['id' => codifica($notificacion->id)]) }}">{{ $notificacion->bl }} <span class="label label-warning">Documentos pendientes</span></a>
                        </li>
                    @endforeach
                    </ul>
                </li>
            @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->nombre }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-bell"></i> Alertas</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li @if($seccion=="home") class="active" @endif>
                        <a href="{{ route('home') }}"><i class="fa fa-fw fa-dashboard"></i> Inicio</a>
                    </li>
                @if(Auth::user()->tipo=='Administrador')
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-cog"></i> Configuraciones <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li @if($seccion=="usuarios") class="active" @endif>
                                <a href="{{ route("usuarios.index") }}"><i class="fa fa-fw fa-user"></i> Usuarios</a>
                            </li>
                            <li @if($seccion=="paises") class="active" @endif>
                                <a href="{{ route("paises.index") }}"><i class="fa fa-fw fa-flag"></i> Países</a>
                            </li>
                            <li @if($seccion=="clientes") class="active" @endif>
                                <a href="{{ route("clientes.index") }}"><i class="fa fa-fw fa-address-book"></i> Clientes</a>
                            </li>
                            <li @if($seccion=="empresas") class="active" @endif>
                                <a href="{{ route("empresas.index") }}"><i class="fa fa-fw fa-university"></i> Empresas</a>
                            </li>
                            <li @if($seccion=="plantas") class="active" @endif>
                                <a href="{{ route("plantas.index") }}"><i class="fa fa-fw fa-industry"></i> Plantas procesadoras</a>
                            </li>
                            <li @if($seccion=="navieras") class="active" @endif>
                                <a href="{{ route("navieras.index") }}"><i class="fa fa-fw fa-ship"></i> Navieras</a>
                            </li>
                            <li @if($seccion=="agentes") class="active" @endif>
                                <a href="{{ route("agentes.index") }}"><i class="fa fa-fw fa-money"></i> Agentes aduanales</a>
                            </li>
                            <li @if($seccion=="productos") class="active" @endif>
                                <a href="{{ route("productos.index") }}"><i class="fa fa-fw fa-shopping-bag"></i> Productos</a>
                            </li>
                            <li @if($seccion=="origenes") class="active" @endif>
                                <a href="{{ route("origenes.index") }}"><i class="fa fa-fw fa-flag"></i> Puertos</a>
                            </li>
                            <li @if($seccion=="destinos") class="active" @endif>
                                <a href="{{ route("destinos.index") }}"><i class="fa fa-fw fa-flag"></i> Destinos</a>
                            </li>
                            <li @if($seccion=="documentotipos") class="active" @endif>
                                <a href="{{ route("documentotipos.index") }}"><i class="fa fa-fw fa-file-text-o"></i> Tipos de documentos</a>
                            </li>
                        </ul>
                    </li>

                    <li @if($seccion=="permisos") class="active" @endif>
                        <a href="{{ route("permisos.index") }}"><i class="fa fa-fw fa-thumbs-o-up"></i> Permisos</a>
                    </li>
                    <li @if($seccion=="contenedores") class="active" @endif>
                        <a href="{{ route("contenedores.index") }}"><i class="fa fa-fw fa-truck"></i> Contenedores</a>
                    </li>
                @endif
                    <li @if($seccion=="documentos") class="active" @endif>
                        <a href="{{ route("documentos_index") }}"><i class="fa fa-fw fa-file-text"></i> Documentos</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

@yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
@yield('javascript')

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
</body>
</html>
