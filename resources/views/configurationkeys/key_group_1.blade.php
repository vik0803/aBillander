@extends('layouts.master')

@section('title')
Configuración General
::@parent
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
            </div>
            <h2>Configuración · See: https://www.youtube.com/watch?v=YlP7Bw_Z8Nw</h2>
        </div>
    </div>
</div>

<div class="container-fluid">
   <div class="row">

        @include('configurationkeys.key_groups')
      
      <div class="col-lg-10 col-md-10 col-sm-9">

            <!-- div class="panel panel-primary" id="panel_main">
               <div class="panel-heading">
                  <h3 class="panel-title">Datos generales</h3>
               </div -->
               <div class="panel-body well">


{{ Form::open(array('url' => 'configurationkeys', 'id' => 'key_group_'.intval($tab_index), 'name' => 'key_group_'.intval($tab_index), 'class' => 'form-horizontal')) }}
  <input type="hidden" name="tab_index" value="{{$tab_index}}"/>
  <fieldset>
    <legend>Mi Empresa</legend>

    <div class="form-group" {{{ $errors->has('COMPANY_BO_LOGO') ? 'has-error' : '' }}}>
      <label for="COMPANY_BO_LOGO" class="col-lg-4 control-label">Logo de Empresa</label>
      <div class="col-lg-8">
        <div class="row">
        <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="COMPANY_BO_LOGO" name="COMPANY_BO_LOGO" >{{{ Input::old('COMPANY_BO_LOGO', isset($key_group) ? $key_group['COMPANY_BO_LOGO'] : null) }}}</textarea>
        {{ $errors->first('COMPANY_BO_LOGO', '<span class="help-block">:message</span>') }}
        </div>
        <div class="col-lg-2"> </div>
        </div>
        <span class="help-block">HTML en la esquina superior izquierda. Para identificar a la empresa que usa LaraBillander.</span>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-4 control-label">Método para calcular el Margen</label>
      <div class="col-lg-8">
        <div class="radio">
          <label>
            <input name="MARGIN_METHOD" id="MARGIN_METHOD_1" value="CST" @if(Input::old('MARGIN_METHOD', isset($key_group) ? $key_group['MARGIN_METHOD'] : 'CST')=='CST') checked="checked" @endif type="radio">
            Sobre el Precio de Coste
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="MARGIN_METHOD" id="MARGIN_METHOD_2" value="PRC" @if(Input::old('MARGIN_METHOD', isset($key_group) ? $key_group['MARGIN_METHOD'] : 'CST')!='CST') checked="checked" @endif type="radio">
            Sobre el Precio de Venta
          </label>
        </div>
        <span class="help-block">CST: Margen sobre el precio de coste; other: sobre el precio de venta.</span>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-4 control-label">Permitir Ventas sin Stock</label>
      <div class="col-lg-8">
        <div class="radio">
          <label>
            <input name="ALLOW_SALES_WITHOUT_STOCK" id="ALLOW_SALES_WITHOUT_STOCK_1" value="1" @if(Input::old('ALLOW_SALES_WITHOUT_STOCK', isset($key_group) ? $key_group['ALLOW_SALES_WITHOUT_STOCK'] : 0)>0) checked="checked" @endif type="radio">
            Sí
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="ALLOW_SALES_WITHOUT_STOCK" id="ALLOW_SALES_WITHOUT_STOCK_2" value="0" @if(Input::old('ALLOW_SALES_WITHOUT_STOCK', isset($key_group) ? $key_group['ALLOW_SALES_WITHOUT_STOCK'] : 0)==0) checked="checked" @endif type="radio">
            No
          </label>
        </div>
        <span class="help-block"> </span>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-4 control-label">Permitir Ventas con Riesgo excedido</label>
      <div class="col-lg-8">
        <div class="radio">
          <label>
            <input name="ALLOW_SALES_RISK_EXCEEDED" id="ALLOW_SALES_RISK_EXCEEDED_1" value="1" @if(Input::old('ALLOW_SALES_RISK_EXCEEDED', isset($key_group) ? $key_group['ALLOW_SALES_RISK_EXCEEDED'] : 0)>0) checked="checked" @endif type="radio">
            Sí
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="ALLOW_SALES_RISK_EXCEEDED" id="ALLOW_SALES_RISK_EXCEEDED_2" value="0" @if(Input::old('ALLOW_SALES_RISK_EXCEEDED', isset($key_group) ? $key_group['ALLOW_SALES_RISK_EXCEEDED'] : 0)==0) checked="checked" @endif type="radio">
            No
          </label>
        </div>
        <span class="help-block">Permitir Ventas a Clientes con el Riesgo excedido.</span>
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-8 col-lg-offset-4">
        <!-- button class="btn btn-default">Cancelar</button -->
        <button type="submit" class="btn btn-primary">
          <span class="glyphicon glyphicon-hdd"></span>
                     &nbsp; Guardar
          </button>
      </div>
    </div>
  </fieldset>
{{ Form::close() }}



               </div>

               <!-- div class="panel-footer text-right">
               </div>

            </div -->

      </div><!-- div class="col-lg-10 col-md-10 col-sm-9" -->

   </div>
</div>
@stop