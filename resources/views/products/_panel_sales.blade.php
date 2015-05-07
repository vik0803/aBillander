
{!! Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT', 'class' => 'form')) !!}
<input type="hidden" value="" name="tab_name" id="tab_name">

<div class="panel panel-primary" id="panel_sales">
   <div class="panel-heading">
      <h3 class="panel-title">Ventas</h3>
   </div>
   <div class="panel-body">

<!-- Sales Prices -->

        <div class="row">
                  <div class="form-group col-lg-2 col-md-2 col-sm-2 {{ $errors->has('cost_price') ? 'has-error' : '' }}">
                     {{ l('Cost Price') }}
                     {!! Form::text('cost_price', null, array('class' => 'form-control', 'id' => 'cost_price', 'autocomplete' => 'off', 
                                      'onclick' => 'this.select()', 'onkeyup' => 'new_margin()', 'onchange' => 'new_margin()')) !!}
                     {!! $errors->first('cost_price', '<span class="help-block">:message</span>') !!}
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-2 {{ $errors->has('margin') ? 'has-error' : '' }}">
                     {{ l('Margin (%)') }}
                         <a href="javascript:void(0);">
                            <button type="button" xclass="btn btn-xs btn-white" data-toggle="popover" data-placement="top" 
                                    data-content="{{ \App\Configuration::get('MARGIN_METHOD') == 'CST' ?
                                        l('Margin calculation is based on Cost Price') :
                                        l('Margin calculation is based on Sales Price') }}">
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </button>
                         </a>
                     {!! Form::text('margin', null, array('class' => 'form-control', 'id' => 'margin', 'autocomplete' => 'off', 
                                      'onclick' => 'this.select()', 'onkeyup' => 'new_price()', 'onchange' => 'new_price()')) !!}
                     {!! $errors->first('margin', '<span class="help-block">:message</span>') !!}
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 {{ $errors->has('price') ? 'has-error' : '' }}">
                     {{ l('Customer Price') }}
                     {!! Form::text('price', null, array('class' => 'form-control', 'id' => 'price', 'autocomplete' => 'off', 
                                      'onclick' => 'this.select()', 'onkeyup' => 'new_margin()', 'onchange' => 'new_margin()')) !!}
                     {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
                  </div>
                 <div class="form-group col-lg-2 col-md-2 col-sm-2 {{ $errors->has('tax_id') ? 'has-error' : '' }}">
                    {{ l('Tax') }}
                    {!! Form::select('tax_id', array('0' => l('-- Please, select --', [], 'layouts')) + $taxList, null, array('class' => 'form-control', 'id' => 'tax_id',
                                      'onchange' => 'new_margin()')) !!}
                    {!! $errors->first('tax_id', '<span class="help-block">:message</span>') !!}
                 </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 {{ $errors->has('price_tax_inc') ? 'has-error' : '' }}">
                     {{ l('Customer Price (with Tax)') }}
                     {!! Form::text('price_tax_inc', null, array('class' => 'form-control', 'id' => 'price_tax_inc', 'autocomplete' => 'off', 
                                      'onclick' => 'this.select()', 'onkeyup' => 'new_margin_price()', 'onchange' => 'new_margin_price()')) !!}
                     {!! $errors->first('price_tax_inc', '<span class="help-block">:message</span>') !!}
                  </div>
        </div>

        <div class="row">
        </div>

        <div class="row">
        </div>

        <div class="row">
        </div>

<!-- Sales Prices ENDS -->

   </div>

   <div class="panel-footer text-right">
      <button class="btn btn-sm btn-info" type="submit" onclick="this.disabled=true;$('#tab_name').val('sales');this.form.submit();">
         <span class="glyphicon glyphicon-hdd"></span>
         &nbsp; Guardar
      </button>
   </div>

</div>

{!! Form::close() !!}


@section('scripts') 

{{-- !! \App\Calculator::marginJSCode( true ) !! --}}

<!-- script type="text/javascript">

function get_tax_percent_by_id(tax_id) 
{
   // http://stackoverflow.com/questions/18910939/how-to-get-json-key-and-value-in-javascript
   // var taxes = $.parseJSON( '{{ json_encode( $taxpercentList ) }}' );
   var taxes = {!! json_encode( $taxpercentList ) !!} ;

   if (typeof taxes[tax_id] == "undefined")   // or if (taxes[tax_id] === undefined) {
   {
        // variable is undefined
        alert('Tax code ['+tax_id+'] not found!');
   } else
        return taxes[tax_id];
}


function new_price()
{
  var cost_price = parseFloat( $("#cost_price").val() );
  var margin = parseFloat( $("#margin").val() );
  var tax = parseFloat(  get_tax_percent_by_id( $("#tax_id").val() ) );

  var price = pricecalc( cost_price, margin );
  var price_tax_inc = price*(1.0+tax/100.0);

  $("#price").val( price );
  $("#price_tax_inc").val( price_tax_inc );
}

function new_margin()
{
  var cost_price = parseFloat( $("#cost_price").val() );
  var price = parseFloat( $("#price").val() );
  var tax = parseFloat(  get_tax_percent_by_id( $("#tax_id").val() ) );

  var margin = margincalc( cost_price, price );
  var price_tax_inc = price*(1.0+tax/100.0);

  $("#margin").val( margin );
  $("#price_tax_inc").val( price_tax_inc );
}

function new_margin_price()
{
  var cost_price = parseFloat( $("#cost_price").val() );
  var price_tax_inc = parseFloat( $("#price_tax_inc").val() );
  var tax = parseFloat(  get_tax_percent_by_id( $("#tax_id").val() ) );

  var price = price_tax_inc/(1.0+tax/100.0);
  var margin = margincalc( cost_price, price );

  $("#price").val( price );
  $("#margin").val( margin );
}
-->
 
@include('products._calculator_js')

<script type="text/javascript">

$(document).ready(function() {
   new_margin();
});

</script>

@append