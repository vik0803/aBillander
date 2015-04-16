@extends('layouts.masterAdmin')

@section('title')
@parent
Clientes
@stop

@section('content')

{{ Form::open(array('route' => 'admin.customers.store', 'class' => 'form-horizontal')) }}

	<div class="headerbar">
		<h1>Formulario de Clientes</h1>
		<div class="pull-right">
			<button class="btn btn-primary" xname="btn_submit" value="1"><i class="icon-ok icon-white"></i> Guardar</button>
			<button class="btn btn-danger"  xname="btn_cancel" value="1"
				onClick="window.location = '{{ URL::to('admin/customers') }}'; return false;">
																		 <i class="icon-remove icon-white"></i> Cancelar</button>
		</div>
	</div>

	<div class="content">
	
		<!-- Success-Messages -->
		@if ( $nbErrors = $errors->any() OR 1 )
		<div class="alert alert-error alert-block">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<!-- h4>Success</h4 -->
			@if ($message = Session::get('message_error'))
			{{{ $message }}}
			@endif
			<ul>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</ul>
		</div>
		@endif
        
        <div class="row-fluid">
            
            <div class="span6">
		
		
        <fieldset>
            <legend>Datos Generales</legend>

            <div class="control-group">
                <label class="control-label">Nombre Fiscal: </label>
                <div class="controls">
                    {{ Form::text('name_fiscal', '', array('id' => 'name_fiscal')) }}
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Nombre Comercial: </label>
                <div class="controls">
                    {{ Form::text('name_commercial', '', array('id' => 'name_commercial')) }}
                </div>
            </div>

        </fieldset>
		
		
            </div>
            
            <div class="span6">   
		
		
        <fieldset>
            <legend>Otros Datos</legend>

            <div class="control-group">
                {{ Form::label('accept_einvoice', 'Acepta eFactura: ', array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::checkbox('accept_einvoice', '1', false, array('id' => 'accept_einvoice')) }}
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Notas: </label>
                <div class="controls">
                    {{ Form::textarea('customer_notes', '') }}
                </div>
            </div>

        </fieldset>

            
            </div>
            
        </div><!-- div class="row-fluid" ENDS -->
        
        <div class="row-fluid">
            
            <div class="span6">
		
		
        <fieldset>
            <legend>Dirección de Facturación</legend>

            <div class="control-group">
                <label class="control-label">Denominación: </label>
                <div class="controls">
                    {{ Form::text('inv_address_alias', '', array('id' => 'alias')) }}
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Nombre Comercial: </label>
                <div class="controls">
                    {{ Form::text('inv_address_name_commercial', '', array('id' => 'inv_address_name_commercial')) }}
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Dirección: </label>
                <div class="controls">
                    {{ Form::text('inv_address_address1', '', array('id' => 'address1')) }}
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Notas: </label>
                <div class="controls">
                    {{ Form::textarea('inv_address_notes', '') }}
                </div>
            </div>

        </fieldset>
		
		
            </div>
            
            <div class="span6">   
		
		
        <fieldset>
            <legend>Dirección de Envío</legend>

            <div class="control-group">
			</div>

        </fieldset>
		
            
            </div>
            
        </div><!-- div class="row-fluid" ENDS -->

	
	</div><!-- div class="content" WHOLE THING ENDS -->

{{ Form::close() }}

@stop