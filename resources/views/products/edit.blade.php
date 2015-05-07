@extends('layouts.master')

@section('title') {{ l('Products - Edit') }} @parent @stop


@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_new_address" title=" Nueva Dirección Postal ">
                  <i class="fa fa-plus"></i> Dirección
                </button>
                <a href="{{ URL::to('invoices/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Documento</a>
                <div class="btn-group">
                    <!-- a href="#" class="btn btn-success">Success</a -->
                    <a href="#" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Success &nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul>
                </div>
                <a href="{{ URL::to('products') }}" class="btn btn-default"><i class="fa fa-mail-reply"></i> Volver a Productos</a>
            </div>
            <h2><a href="{{ URL::to('products') }}">Productos</a> <span style="color: #cccccc;">/</span> {{ $product->name }}</h2>
        </div>
    </div>
</div>

<div class="container-fluid">
   <div class="row">

      <div class="col-lg-2 col-md-2 col-sm-3">
         <div class="list-group">
            <a id="b_main_data" href="#" class="list-group-item active">
               <span class="glyphicon glyphicon-asterisk"></span>
               &nbsp; Datos generales
            </a>
            <a id="b_purchases" href="#purchases" class="list-group-item">
               <span class="glyphicon glyphicon-shopping-cart"></span>
               &nbsp; Compras
            </a>
            <a id="b_sales" href="#sales" class="list-group-item">
               <span class="glyphicon glyphicon-share"></span>
               &nbsp; Ventas
            </a>
            <a id="b_inventory" href="#inventory" class="list-group-item">
               <span class="glyphicon glyphicon-th"></span>
               &nbsp; Stocks
            </a>
            <a id="b_combinations" href="#combinations" class="list-group-item">
               <span class="glyphicon glyphicon-tags"></span>
               &nbsp; Combinaciones
            </a>
            <a id="b_internet" href="#internet" class="list-group-item">
               <span class="glyphicon glyphicon-cloud"></span>
               &nbsp; Internet
            </a>
         </div>
      </div>
      
      <div class="col-lg-10 col-md-10 col-sm-9">

          @include('products._panel_main_data')

          @include('products._panel_purchases')

          @include('products._panel_sales')

          @include('products._panel_inventory')

          @include('products._panel_internet')

          @include('products._panel_combinations')

      </div>

   </div>
</div>
@stop

@section('scripts') 
<script type="text/javascript">
   function route_url()
   {
      $("#panel_main_data").hide();
      $("#panel_purchases").hide();
      $("#panel_sales").hide();
      $("#panel_inventory").hide();
      $("#panel_internet").hide();
      $("#panel_combinations").hide();

      $("#b_main_data").removeClass('active');
      $("#b_purchases").removeClass('active');
      $("#b_sales").removeClass('active');
      $("#b_inventory").removeClass('active');
      $("#b_internet").removeClass('active');
      $("#b_combinations").removeClass('active');
      
      if(window.location.hash.substring(1) == 'purchases')
      {
         $("#panel_purchases").show();
         $("#b_purchases").addClass('active');
      }
      else if(window.location.hash.substring(1) == 'sales')
      {
         $("#panel_sales").show();
         $("#b_sales").addClass('active');
      }
      else if(window.location.hash.substring(1) == 'inventory')
      {
         $("#panel_inventory").show();
         $("#b_inventory").addClass('active');
      }
      else if(window.location.hash.substring(1) == 'internet')
      {
         $("#panel_internet").show();
         $("#b_internet").addClass('active');
      }
      else if(window.location.hash.substring(1) == 'combinations')
      {
         $("#panel_combinations").show();
         $("#b_combinations").addClass('active');
      }
      else  
      {
         $("#panel_main_data").show();
         $("#b_main_data").addClass('active');
         // document.f_cliente.nombre.focus();
      }
   }
   $(document).ready(function() {
      route_url();
      window.onpopstate = function(){
         route_url();
      }
   });
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>
<script type="text/javascript">
// Select2 Plugin // https://select2.github.io
// Todo: ajax retrieve (all) groups
  $('#groups').select2({
    placeholder: "{{ l('-- Click to Select --', [], 'layouts') }}",
  });
</script>

@stop

@section('styles') 

<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" type="text/css" rel="stylesheet" />

@stop