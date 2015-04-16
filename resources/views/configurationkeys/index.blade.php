@extends('layouts.master')

@section('title') {{ Lang::get('customers.general.title') }} {{ Lang::get('general.settings') }} :: @parent @stop


@section('content')

<div class="page-header">
    <div class="pull-right" style="padding-top: 4px;">
        <a href="{{{ URL::to('customers/create') }}}" class="btn btn-sm btn-success" title=" Añadir Nuevo Cliente "><i class="fa fa-plus"></i> Nuevo</a>
        <!-- a href="" onclick="return false;" data-toggle="modal" data-target="#modal_create_customer" class="btn btn-sm btn-success" title=" Añadir Nuevo Cliente "><i class="fa fa-plus"></i> Nuevo</a -->
        <!-- @if (Input::get('onlyTrashed'))
        	<a class="btn btn-default" href="{{ URL::to('customers') }}">{{ Lang::get('customers.general.show_curent') }}</a>
        @else
        	<a class="btn btn-default" href="{{ URL::to('customers?onlyTrashed=true') }}">{{ Lang::get('customers.general.show_deleted') }}</a>
        @endif  -->        
    </div>
    <h2>
        @if (Input::get('onlyTrashed'))
        	{{ Lang::get('customers.general.deleted') }}
        @else
        	Clientes
        @endif
    </h2>        
</div>

<div id="div_customers">
   <div class="table-responsive">

@if ($customers->count())
<table id="customers" class="table table-hover">
    <thead>
        <tr>
            <th class="text-left">ID</th>
            <th class="text-left">Nombre</th>
            <th class="text-left">NIF / CIF</th>
            <th class="text-left">Email</th>
            <th class="text-left">Pendiente</th>
            <th class="text-left">Bloqueado</th>
            <th class="text-right"> </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name_fiscal }}</td>
            <td>{{{ $customer->identification }}}</td>
            <td>{{{ $customer->email }}}</td>
            <td>{{{ $customer->outstanding_amount }}}</td>
            <td>@if ($customer->blocked) <i class="fa fa-lock" style="color: #df382c;"></i> @else <i class="fa fa-unlock" style="color: #38b44a;"></i> @endif</td>
            <td class="text-right">
                @if (  is_null($customer->deleted_at))
                <a class="btn btn-sm btn-success" href="{{ URL::to('customers/' . $customer->id) }}" title=" Ver "><i class="fa fa-eye"></i></a>               
                <a class="btn btn-sm btn-warning" href="{{ URL::to('customers/' . $customer->id . '/edit') }}" title=" Modificar "><i class="fa fa-pencil"></i></a>
                <a class="btn btn-sm btn-danger delete-customer" data-html="false" data-toggle="modal" href="{{ URL::to('customers/' . $customer->id ) }}" data-content="{{ Lang::get('customers.message.warning.delete') }}" data-title="{{ Lang::get('general.delete') }} {{ htmlspecialchars($customer->name) }}?" onClick="return false;" title=" Borrar "><i class="fa fa-trash-o"></i></a>
                @else
                <a class="btn btn-warning" href="{{ URL::to('customers/' . $customer->id. '/restore' ) }}"><i class="fa fa-reply"></i></a>
                <a class="btn btn-danger" href="{{ URL::to('customers/' . $customer->id. '/delete' ) }}"><i class="fa fa-trash-o"></i></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-warning alert-block">
    <i class="fa fa-warning"></i>
    No se han encontrado registros.
</div>
@endif

   </div>
</div>

@include('layouts/modal')       <!-- modal para confirmar borrado -->

{{-- @include('customers/modal_create') --}}

@stop

{{--
@section('scripts')

<script type="text/javascript">
   function show_create_customer_form()
   {
      $("#modal_create_customer").modal('show');
      document.create_customer.name.focus();
   }
   function show_grupos()
   {
      $("#ul_tabs li").each(function() {
         $( this ).removeClass("active");
      });
      $("#div_clientes").hide();
      $("#b_grupos_clientes").addClass('active');
      $("#div_grupos").show();
      document.f_new_grupo.nombre.focus();
   }
   $(document).ready(function() {
      
      if(window.location.hash.substring(1) == 'create')
      {
         show_create_customer_form();
      }
      else if(window.location.hash.substring(1) == 'grupos')
      {
         show_grupos();
      }
      
      $("#b_grupos_clientes").click(function(event) {
         event.preventDefault();
         show_grupos();
      });
      $("#b_new_customer").click(function(event) {
         event.preventDefault();
         show_create_customer_form();
      });
   });
</script>

@stop
--}}