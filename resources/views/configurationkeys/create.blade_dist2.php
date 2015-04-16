@extends('layouts.master')

@section('title')
{{ Lang::get('clients.general.create') }}            
::@parent
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{ URL::to('customers') }}" class="btn btn-primary"><i class="fa fa-mail-reply"></i> Volver a Clientes</a>
            </div>
            <h2>Nuevo Cliente</h2>
        </div>
    </div>
</div> 
{{ Form::open(array('url' => 'customers', 'files' => true, 'id'=> 'create_customer')) }}
    @include('customers/form')
{{ Form::close() }}
@stop