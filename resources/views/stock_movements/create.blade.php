@extends('layouts.master')

@section('title') {{ l('Stock Movements - Create') }} @parent @stop


@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">{{ l('New Stock Movement') }}</h3></div>
            <div class="panel-body">

                @include('errors.list')

				{!! Form::open(array('route' => 'stockmovements.store')) !!}
    
<div class="row">
    <div class="form-group col-lg-4 col-md-4 col-sm-4">
        {!! Form::label('date', l('Date')) !!}
        {!! Form::text('date', 
            \App\FP::date_short( \Carbon\Carbon::now(), \App\Context::getContext()->language->date_format_lite ), 
            array('id' => 'date', 'xreadonly' => 'xreadonly', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group col-lg-4 col-md-4 col-sm-4">
        {!! Form::label('warehouse_id', l('Warehouse')) !!}
        {!! Form::select('warehouse_id', array('0' => l('-- Please, select --', [], 'layouts')) + $warehouseList, null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group col-lg-4 col-md-4 col-sm-4">
        {!! Form::label('document_reference', l('Document')) !!}
        {!! Form::text('document_reference', null, array('class' => 'form-control')) !!}
    </div>
</div>
    
<div class="row">
    <div class="form-group col-lg-3 col-md-3 col-sm-3">
        {!! Form::label('reference', l('Product Reference')) !!}
        {!! Form::text('reference', null, array('id' => 'reference', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group col-lg-6 col-md-6 col-sm-6">
        {!! Form::label('product_query', l('Product Name')) !!}
        <div class="input-group">
          {!! Form::hidden('product_id', null, array('id' => 'product_id')) !!}

          {!! Form::text('product_query', null, array('id' => 'product_query', 'autocomplete' => 'off', 'class' => 'form-control')) !!}

           <span class="input-group-btn">
              <button class="btn btn-primary" type="submit" onclick="return false;">
                 <span class="glyphicon glyphicon-search"></span>
              </button>
           </span>
        </div>
    </div>

    <!-- input type="hidden" name="_token" value="{{ csrf_token() }}" / -->

    <div class="form-group col-lg-3 col-md-3 col-sm-3">
        {!! Form::label('options', l('Product Options')) !!}
        <div id="product_options"> &nbsp; 
        </div>
    </div>

</div>

<div class="row">
    <div class="form-group col-lg-3 col-md-3 col-sm-3">
        {!! Form::label('quantity', l('Quantity')) !!}
               <a href="javascript:void(0);">
                  <button type="button" xclass="btn btn-xs btn-success" data-toggle="popover" data-placement="top" 
                          data-content="{{ l('Positive: stock increases. Negative: stock decreases.') }}">
                      <span class="glyphicon glyphicon-info-sign"></span>
                  </button>
               </a>
        {!! Form::text('quantity', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group col-lg-3 col-md-3 col-sm-3">
        {!! Form::label('price', l('Price')) !!}
        {!! Form::text('price', null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group col-lg-6 col-md-6 col-sm-6">
        {!! Form::label('movement_type_id', l('Movement type')) !!}
        {!! Form::select('movement_type_id', array('0' => l('-- Please, select --', [], 'layouts')) + $movement_typeList, null, array('class' => 'form-control')) !!}
    </div>
</div>
        
<div class="row">
      <div class="form-group col-lg-12 col-md-12 col-sm-12 {{ $errors->has('notes') ? 'has-error' : '' }}">
         {{ l('Notes') }}
         {!! Form::textarea('notes', null, array('class' => 'form-control', 'id' => 'notes', 'rows' => '3')) !!}
         {!! $errors->first('notes', '<span class="help-block">:message</span>') !!}
      </div>
</div>

               </div><!-- div class="panel-body" -->

               <div class="panel-footer text-right">
                  <a class="btn btn-link" data-dismiss="modal" href="{{ URL::to('stockmovements') }}">{{l('Cancel', [], 'layouts')}}</a>
                  <button class="btn btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                     &nbsp; {{l('Save', [], 'layouts')}}
                  </button>
               </div>

				{!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
@parent

{{-- Date Picker --}}

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
{!! HTML::script('assets/jquery-ui/datepicker/datepicker-'.\App\Context::getContext()->language->iso_code.'.js'); !!}

<script>
  $(function() {
    $( "#date" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: "{{ \App\Context::getContext()->language->date_format_lite_view }}"
    });
  });
</script>


{{-- AutoComplete --}}

<script>

// http://stackoverflow.com/questions/21627170/laravel-tokenmismatchexception-in-ajax-request
// var _globalObj = {{ json_encode(array('_token'=> csrf_token())) }};

  $(function() {
    $( "#product_query" ).autocomplete({
      source: "{{ route('products.ajax.nameLookup') }}",
      minLength: 2,
      select: function( event, ui ) {
      //  alert( ui.item ?
      //    "Selected: " + ui.item.value + " aka " + ui.item.id :
      //    "Nothing selected, input was " + this.value );

        $( "#reference" ).val( ui.item.reference );
        $( "#product_id" ).val( ui.item.id );

        // Product has combinations?
        $("#product_options").addClass('loading');

           var token = "{{ csrf_token() }}";        // See also: http://words.weareloring.com/development/laravel/laravel-4-csrf-tokens-when-using-jquerys-ajax/
           $.ajax({
              type: 'POST',
              url: "{{ route('products.ajax.optionsLookup') }}",
              dataType: 'html',
              data: "product_id="+ui.item.id+"&_token="+token,
              success: function(datos) {
                 $("#product_options").html(datos);
                 $("#product_options").removeClass('loading');
              }
           });
      }
    })
    // http://stackoverflow.com/questions/9887032/how-to-highlight-input-words-in-autocomplete-jquery-ui
    .data("ui-autocomplete")._renderItem = function (ul, item) {
        var newText = String(item.value).replace(
                new RegExp(this.term, "gi"),
                "<span class='ui-state-highlight' style='color: #dd4814;'><strong>$&</strong></span>");

        return $("<li></li>")
            .data("item.autocomplete", item)
            .append("<a>" + newText + "</a>")
            .appendTo(ul);
    };
  });
  </script>

@stop

@section('styles')
@parent

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<style>
  .ui-autocomplete-loading{
    background: white url("../img/ui-anim_basic_16x16.gif") right center no-repeat;
  }
  .loading{
    background: white url("../img/ui-anim_basic_16x16.gif") left center no-repeat;
  }
</style>

@stop