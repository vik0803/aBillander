@extends('layouts.master')

@section('title') Productos :: @parent @stop


@section('content')

<div class="page-header">
    <div class="pull-right" style="padding-top: 4px;">
        <a href="{{{ URL::to('products/create') }}}" class="btn btn-sm btn-success" title=" Añadir Nuevo Producto "><i class="fa fa-plus"></i> Nuevo</a>
        <!-- a href="" onclick="return false;" data-toggle="modal" data-target="#modal_create_product" class="btn btn-sm btn-success" title=" Añadir Nuevo Cliente "><i class="fa fa-plus"></i> Nuevo</a -->
        <!-- @if (Input::get('onlyTrashed'))
        	<a class="btn btn-default" href="{{ URL::to('products') }}">{{ Lang::get('products.general.show_curent') }}</a>
        @else
        	<a class="btn btn-default" href="{{ URL::to('products?onlyTrashed=true') }}">{{ Lang::get('products.general.show_deleted') }}</a>
        @endif  -->        
    </div>
    <h2>
        @if (Input::get('onlyTrashed'))
        	{{ Lang::get('products.general.deleted') }}
        @else
        	Productos
        @endif
    </h2>        
</div>

<div id="div_products">
   <div class="table-responsive">

@if ($products->count())
<table id="products" class="table table-hover">
    <thead>
        <tr>
			<th>ID</th>
			<th>Referencia</th>
			<th>Nombre del Producto</th>
			<th>Cantidad</th>
            <th>Precio Coste</th>
            <th>Precio Medio</th>
            <th>Precio Venta</th>
            <th>Impuesto</th>
            <th>Impuesto (%)</th>
            <th>Categoría</th>
			<th class="text-center">Activo</th>
			<th class="text-right"> </th>
		</tr>
	</thead>
	<tbody>
	@foreach ($products as $product)
		<tr>
			<td>{{ $product->id }}</td>
			<td>{{ $product->reference }}</td>
			<td>{{ $product->name }}</td>
			<td>{{ $product->quantity_onhand }}</td>
            <td>{{ $product->cost_price }}</td>
            <td>{{ $product->cost_average }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->tax->name }}</td>
            <td>{{ App\FP::percent($product->tax->percent) }}</td>
            <td>@if (isset($product->category->name)) {{ $product->category->name }} @endif</td>
			<td class="text-center">@if ($product->active) <i class="fa fa-check-square" style="color: #38b44a;"></i> @else <i class="fa fa-square-o" style="color: #df382c;"></i> @endif</td>
           <td class="text-right">
                @if (  is_null($product->deleted_at))
                <a class="btn btn-sm btn-warning" href="{{ URL::to('products/' . $product->id . '/edit') }}" title=" Modificar "><i class="fa fa-pencil"></i></a>
                <!-- a class="btn btn-sm btn-danger delete-product" data-html="false" data-toggle="modal" 
                    href="{{ URL::to('products/' . $product->id ) }}" 
                    data-content="{{ Lang::get('products.message.warning.delete') }}" 
                    data-title="{{ Lang::get('general.delete') }} {{ htmlspecialchars($product->name) }}?" 
                    onClick="return false;" title=" Eliminar "><i class="fa fa-trash-o"></i></a -->
                
                <a class="btn btn-sm btn-danger delete-item" data-html="false" data-toggle="modal" 
                    href="{{ URL::to('products/' . $product->id ) }}" 
                    data-content="Esta acción NO podrá deshacerse." 
                    data-title="Productos. Realmente desea eliminar:  ({{$product->id}}) {{{ $product->name }}} ?" 
                    onClick="return false;" title=" Eliminar "><i class="fa fa-trash-o"></i></a>
                @else
                <a class="btn btn-warning" href="{{ URL::to('products/' . $product->id. '/restore' ) }}"><i class="fa fa-reply"></i></a>
                <a class="btn btn-danger" href="{{ URL::to('products/' . $product->id. '/delete' ) }}"><i class="fa fa-trash-o"></i></a>
                @endif
            </td>
		</tr>
	@endforeach
    </tbody>
</table>
@else
<div class="alert alert-warning alert-block">
    <i class="fa fa-warning"></i>
    {{l('No records found', [], 'layouts')}}
</div>
@endif

   </div>
</div>

@stop

@include('layouts/modal_delete')
