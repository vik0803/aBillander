@extends('layouts.masterAdmin')

@section('title')
@parent
Clientes
@stop

@section('content')

{{ Form::open(array('route' => 'admin.taxes.store', 'class' => 'form-horizontal')) }}

	<div class="headerbar">
		<h1>Formulario de Clientes</h1>
		<div class="pull-right">
			<button class="btn btn-primary" xname="btn_submit" value="1"><i class="icon-ok icon-white"></i> Guardar</button>
			<button class="btn btn-danger"  xname="btn_cancel" value="1"
				onClick="window.location = '{{ URL::to('admin/taxes') }}'; return false;">
																		 <i class="icon-remove icon-white"></i> Cancelar</button>
		</div>
	</div>

	<div class="content">
	
		<!-- Success-Messages -->
		@if ( $nbErrors = $errors->any() )
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

			<div class="control-group">
				<label class="control-label">Nombre del Impuesto: </label>
				<div class="controls">
					{{ Form::text('name', '', array('id' => 'name')) }}
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Porcentaje de Impuesto: </label>
				<div class="controls">
					{{ Form::text('percent', '', array('id' => 'percent', 'class' => 'input-small')) }}
				</div>
			</div>

	</div>

{{ Form::close() }}

@stop