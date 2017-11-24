@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Contenedores</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("contenedores.index") }}"><i class="fa fa-fw fa-truck"></i> Contenedores</a></li>
            <li>Editar</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
    @if($notificacion=Session::get('notificacion'))
        <div class="alert alert-success">{{ $notificacion }}</div>
    @endif
    </div>
    <div class="col-lg-2">
        <p class="text-right"><a href="{{ route('contenedores.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('contenedores.update', codifica($contenedor->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('id_numero') ? ' has-error' : '' }}">
                <label>id numérico</label>
                <input type="number" class="form-control" name="id_numero" value="{{ old('id_numero',$contenedor->id_numero) }}" maxlength="50" required autofocus>
                @if ($errors->has('id_numero'))
                    <p class="help-block">{{ $errors->first('id_numero') }}</p>
                @endif
            </div>
        </div>
    </div>


     <div class="row">
         <div class="col-lg-12">
            <h3><i class="fa fa-fw fa-folder-open-o"></i> Datos generales</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('bl') ? ' has-error' : '' }}">
                <label>BL</label>
                <input type="text" class="form-control" name="bl" value="{{ old('bl',$contenedor->bl) }}" maxlength="50" required autofocus>
                @if ($errors->has('bl'))
                    <p class="help-block">{{ $errors->first('bl') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('ncontenedor') ? ' has-error' : '' }}">
                <label>Contenedor</label>
                <input type="text" class="form-control" name="ncontenedor" value="{{ old('ncontenedor',$contenedor->ncontenedor) }}" maxlength="20" required>
                @if ($errors->has('ncontenedor'))
                    <p class="help-block">{{ $errors->first('ncontenedor') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label><i class="fa fa-fw fa-industry"></i> Planta procesadora</label>
                <select name="plantasprocesadora_id" class="form-control">
                @foreach($plantas as $planta)
                    <option value="{{ $planta->id }}"@if($planta->id==old('planta_id',$contenedor->planta_id)) selected @endif>{{ $planta->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label><i class="fa fa-fw fa-address-book"></i> Cliente</label>
                <select name="cliente_id" class="form-control">
                    <option value="0">No asignado</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}"@if($cliente->id==old('cliente_id',$contenedor->cliente_id)) selected @endif>{{ $cliente->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label><i class="fa fa-fw fa-ship"></i> Línea Naviera</label>
                <select name="naviera_id" class="form-control">
                @foreach($navieras as $naviera)
                    <option value="{{ $naviera->id }}"@if($naviera->id==old('naviera_id',$contenedor->naviera_id)) selected @endif>{{ $naviera->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label><i class="fa fa-fw fa-money"></i> Agente Aduanal</label>
                <select name="agentesaduanal_id" class="form-control">
                @foreach($agentes as $agente)
                    <option value="{{ $agente->id }}"@if($agente->id==old('agente_id',$contenedor->agente_id)) selected @endif>{{ $agente->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('precinto') ? ' has-error' : '' }}">
                <label>Precinto</label>
                <input type="text" class="form-control" name="precinto" value="{{ old('precinto',$contenedor->precinto) }}" maxlength="20">
                @if ($errors->has('precinto'))
                    <p class="help-block">{{ $errors->first('precinto') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label><i class="fa fa-fw fa-flag"></i> Puerto de origen</label>
                <select name="origen_id" class="form-control">
                @foreach($origenes as $origen)
                    <option value="{{ $origen->id }}"@if($origen->id==old('origen_id',$contenedor->origen_id)) selected @endif>{{ $origen->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label><i class="fa fa-fw fa-thumbs-o-up"></i> Nro. Permiso de exportación</label>
                <select name="permiso_id" class="form-control">
                @foreach($permisos as $permiso)
                    <option value="{{ $permiso->id }}"@if($permiso->id==old('permiso_id',$contenedor->permiso_id)) selected @endif>{{ $permiso->numero }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('carga') ? ' has-error' : '' }}">
                <label>Carga KG.</label>
                <input type="number" class="form-control txt_calc" name="carga" id="carga" value="{{ old('carga',$contenedor->carga) }}" maxlength="20" min="1" required>
                @if ($errors->has('carga'))
                    <p class="help-block">{{ $errors->first('carga') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('cajas') ? ' has-error' : '' }}">
                <label>Cajas</label>
                <input type="number" class="form-control" name="cajas" value="{{ old('cajas',$contenedor->cajas) }}" maxlength="20" min="1" required>
                @if ($errors->has('cajas'))
                    <p class="help-block">{{ $errors->first('cajas') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-12">
            <h3><i class="fa fa-fw fa-check-circle-o"></i> Productos</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Producto pricipal</label>
                <select name="producto_id1" class="form-control">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}"@if($producto->id==old('producto_id1',$contenedor->producto_id1)) selected @endif>{{ $producto->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Producto 2</label>
                <select name="producto_id2" class="form-control">
                    <option value="0">No aplica</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}"@if($producto->id==old('producto_id2',$contenedor->producto_id2)) selected @endif>{{ $producto->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Producto 3</label>
                <select name="producto_id3" class="form-control">
                    <option value="0">No aplica</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}"@if($producto->id==old('producto_id3',$contenedor->producto_id3)) selected @endif>{{ $producto->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-12">
            <h3><i class="fa fa-fw fa-calendar"></i> Fechas</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('fecha_reconocimiento') ? ' has-error' : '' }}">
                <label>Fecha de reconocimiento</label>
                <?php
                if($contenedor->fecha_reconocimiento){
                    $fecha_reconocimiento=date('Y-m-d',strtotime($contenedor->fecha_reconocimiento));
                }else{
                    $fecha_reconocimiento='';
                } ?>
                <input type="date" class="form-control" name="fecha_reconocimiento" value="{{ old('fecha_reconocimiento', $fecha_reconocimiento) }}" maxlength="10">
                @if ($errors->has('fecha_reconocimiento'))
                    <p class="help-block">{{ $errors->first('fecha_reconocimiento') }}</p>
                @endif
            </div>
        </div>
        <!--
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('fecha_estimada_salida') ? ' has-error' : '' }}">
                <label>Fecha de salida estimada</label>
                <?php
                if($contenedor->fecha_estimada_salida){
                    $fecha_estimada_salida=date('Y-m-d',strtotime($contenedor->fecha_estimada_salida));
                }else{
                    $fecha_estimada_salida='';
                } ?>
                <input type="date" class="form-control" name="fecha_estimada_salida" value="{{ old('fecha_estimada_salida',$fecha_estimada_salida) }}" maxlength="10">
                @if ($errors->has('fecha_estimada_salida'))
                    <p class="help-block">{{ $errors->first('fecha_estimada_salida') }}</p>
                @endif
            </div>
        </div>
        -->
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('fecha_entrada_puerto') ? ' has-error' : '' }}">
                <?php
                if($contenedor->fecha_entrada_puerto){
                    $fecha_entrada_puerto=date('Y-m-d',strtotime($contenedor->fecha_entrada_puerto));
                }else{
                    $fecha_entrada_puerto='';
                } ?>
                <label>Fecha de entrada al puerto</label>
                <input type="date" class="form-control" name="fecha_entrada_puerto" value="{{ old('fecha_entrada_puerto',$fecha_entrada_puerto) }}" maxlength="10">
                @if ($errors->has('fecha_entrada_puerto'))
                    <p class="help-block">{{ $errors->first('fecha_entrada_puerto') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('etd') ? ' has-error' : '' }}">
                <label>ETD</label>
                <?php
                if($contenedor->etd){
                    $etd=date('Y-m-d',strtotime($contenedor->etd));
                }else{
                    $etd='';
                } ?>
                <input type="date" class="form-control txt_calc" name="etd" id="etd" value="{{ old('etd',$etd) }}" maxlength="10">
                @if ($errors->has('etd'))
                    <p class="help-block">{{ $errors->first('etd') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('eta') ? ' has-error' : '' }}">
                <label>ETA</label>
                <?php
                if($contenedor->eta){
                    $eta=date('Y-m-d',strtotime($contenedor->eta));
                }else{
                    $eta='';
                } ?>
                <input type="date" class="form-control txt_calc" name="eta" id="eta" value="{{ old('eta',$eta) }}" maxlength="10">
                @if ($errors->has('eta'))
                    <p class="help-block">{{ $errors->first('eta') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-12">
            <h3><i class="fa fa-fw fa-calculator"></i> Finanzas</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Gastos de exportación Bs.</label>
                <input type="number" step="any" class="form-control" name="gastos_exportacion_bs" value="{{ old('gastos_exportacion_bs',$contenedor->gastos_exportacion_bs) }}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Gastos de exportación $</label>
                <input type="number" step="any" class="form-control" name="gastos_exportacion_usd" value="{{ old('gastos_exportacion_usd',$contenedor->gastos_exportacion_usd) }}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Fecha de pago Gastos de exportación</label>
                <?php
                if($contenedor->fecha_pago_gastos_exportacion){
                    $fecha_pago_gastos_exportacion=date('Y-m-d',strtotime($contenedor->fecha_pago_gastos_exportacion));
                }else{
                    $fecha_pago_gastos_exportacion='';
                } ?>
                <input type="date" class="form-control" name="fecha_pago_gastos_exportacion" value="{{ old('fecha_pago_gastos_exportacion',$fecha_pago_gastos_exportacion) }}" maxlength="10">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Gastos de Bolipuertos Bs</label>
                <input type="number" step="any" class="form-control txt_calc" name="gastos_bolipuertos_bs" id="gastos_bolipuertos_bs" value="{{ old('gastos_bolipuertos_bs',$contenedor->gastos_bolipuertos_bs) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Gastos de Bolipuertos $</label>
                <input type="number" step="any" class="form-control txt_calc" name="gastos_bolipuertos_usd" id="gastos_bolipuertos_usd" value="{{ old('gastos_bolipuertos_usd',$contenedor->gastos_bolipuertos_usd) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Factura</label>
                <input type="text" class="form-control" name="factura" value="{{ old('factura',$contenedor->factura) }}" maxlength="20">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Monto factura USD</label>
                <input type="number" step="any" class="form-control txt_calc" name="monto_factura_usd" id="monto_factura_usd" value="{{ old('monto_factura_usd',$contenedor->monto_factura_usd) }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Anticipo</label>
                <input type="number" step="any" class="form-control txt_calc" name="anticipo" id="anticipo" value="{{ old('anticipo',$contenedor->anticipo) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Fecha de pago anticipo</label>
                <?php
                if($contenedor->fecha_pago_anticipo){
                    $fecha_pago_anticipo=date('Y-m-d',strtotime($contenedor->fecha_pago_anticipo));
                }else{
                    $fecha_pago_anticipo='';
                } ?>
                <input type="date" class="form-control" name="fecha_pago_anticipo" value="{{ old('fecha_pago_anticipo',$fecha_pago_anticipo) }}" maxlength="10">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Pago final</label>
                <input type="number" step="any" class="form-control txt_calc" name="pago_final" id="pago_final" value="{{ old('pago_final',$contenedor->pago_final) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Fecha de pago final</label>
                <?php
                if($contenedor->fecha_pago_final){
                    $fecha_pago_final=date('Y-m-d',strtotime($contenedor->fecha_pago_final));
                }else{
                    $fecha_pago_final='';
                } ?>
                <input type="date" class="form-control" name="fecha_pago_final" value="{{ old('fecha_pago_final',$fecha_pago_final) }}" maxlength="10">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Flete</label>
                <input type="number" step="any" class="form-control txt_calc" name="flete" id="flete" value="{{ old('flete',$contenedor->flete) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Comisiones</label>
                <input type="number" step="any" class="form-control" name="comisiones" value="{{ old('comisiones',$contenedor->comisiones) }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Observaciones</label>
                <textarea name="observaciones" class="form-control">{{ old('observaciones',$contenedor->observaciones) }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tabla_valores">
                </table>
            </div>
        </div>
    </div>

    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-primary">Guardar</button></div></div>
</form>


@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function(){
                $(".alert").slideUp(500);
            },3000)
        })
    </script>
@endsection
