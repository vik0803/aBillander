
               <div class="panel-body">

        <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ l('Product Name') }}
                     {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) !!}
                     {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 {{ $errors->has('reference') ? 'has-error' : '' }}">
                     {{ l('Reference') }}
                     {!! Form::text('reference', null, array('class' => 'form-control', 'id' => 'reference')) !!}
                     {!! $errors->first('reference', '<span class="help-block">:message</span>') !!}
                  </div>

                   <div class="form-group col-lg-2 col-md-2 col-sm-2" id="div-active">
                     {!! Form::label('active', l('Active?', [], 'layouts'), ['class' => 'control-label']) !!}
                     <div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('active', '1', true, ['id' => 'active_on']) !!}
                           {!! l('Yes', [], 'layouts') !!}
                         </label>
                       </div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('active', '0', false, ['id' => 'active_off']) !!}
                           {!! l('No', [], 'layouts') !!}
                         </label>
                       </div>
                     </div>
                   </div>
        </div>

        <div class="row">
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 {{ $errors->has('price') ? 'has-error' : '' }}">
                     {{ l('Customer Price') }}
                     {!! Form::text('price', null, array('class' => 'form-control', 'id' => 'price', 'autocomplete' => 'off', 
                                      'onclick' => 'this.select()', 'onkeyup' => 'new_margin()', 'onchange' => 'new_margin()')) !!}
                     {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
                  </div>
    		         <div class="form-group col-lg-3 col-md-3 col-sm-3 {{ $errors->has('tax_id') ? 'has-error' : '' }}">
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
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 {{ $errors->has('cost_price') ? 'has-error' : '' }}">
                     {{ l('Cost Price') }}
                     {!! Form::text('cost_price', null, array('class' => 'form-control', 'id' => 'cost_price', 'autocomplete' => 'off', 
                                      'onclick' => 'this.select()', 'onkeyup' => 'new_margin()', 'onchange' => 'new_margin()')) !!}
                     {!! $errors->first('cost_price', '<span class="help-block">:message</span>') !!}
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 {{ $errors->has('margin') ? 'has-error' : '' }}">
                     {{ l('Margin') }}
                     {!! Form::text('margin', null, array('class' => 'form-control', 'id' => 'margin', 'autocomplete' => 'off', 
                                      'onclick' => 'this.select()', 'onkeyup' => 'new_price()', 'onchange' => 'new_price()')) !!}
                     {!! $errors->first('margin', '<span class="help-block">:message</span>') !!}
                  </div>
                  <!-- div class="form-group col-lg-3 col-md-3 col-sm-3 { { $errors->has('cost_average') ? 'has-error' : '' } }">
                     { { l('Average Cost Price') } }
                     {! ! Form::text('cost_average', null, array('class' => 'form-control', 'id' => 'cost_average')) ! !}
                     {! ! $errors->first('cost_average', '<span class="help-block">:message</span>') ! !}
                  </div -->
        </div>

        <div class="row">
		         <div class="form-group col-lg-4 col-md-4 col-sm-4 {{ $errors->has('category_id') ? 'has-error' : '' }}">
		            {{ l('Category') }}
		            {!! Form::select('category_id', array('0' => l('-- Please, select --', [], 'layouts')) + $categoryList, null, array('class' => 'form-control')) !!}
                {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
		         </div>

		          <div class="form-group col-lg-3 col-md-3 col-sm-3" id="div-stock_control">
                     {!! Form::label('stock_control', l('Stock Control?'), ['class' => 'control-label']) !!}
		            <div>
		              <div class="radio-inline">
		                <label>
		                  {!! Form::radio('stock_control', '1', true, ['id' => 'stock_control_on']) !!}
                      {!! l('Yes', [], 'layouts') !!}
		                </label>
		              </div>
		              <div class="radio-inline">
		                <label>
		                  {!! Form::radio('stock_control', '0', false, ['id' => 'stock_control_off']) !!}
                      {!! l('No', [], 'layouts') !!}
		                </label>
		              </div>
		            </div>
		          </div>

                  <div class="form-group col-lg-2 col-md-2 col-sm-2 {{ $errors->has('quantity_onhand') ? 'has-error' : '' }}">
                     {{ l('Quantity') }}
                     {!! Form::text('quantity_onhand', null, array('class' => 'form-control', 'id' => 'quantity_onhand')) !!}
                     {!! $errors->first('quantity_onhand', '<span class="help-block">:message</span>') !!}
                  </div>
                  <div class="form-group col-lg-3 col-md-3 col-sm-3 {{ $errors->has('warehouse_id') ? 'has-error' : '' }}">
                      {{ l('Warehouse') }}
                      {!! Form::select('warehouse_id', array('0' => l('-- Please, select --', [], 'layouts')) + $warehouseList, null, array('class' => 'form-control')) !!}
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
                  <a class="btn btn-link" data-dismiss="modal" href="{{ URL::to('products') }}">{{l('Cancel', [], 'layouts')}}</a>
                  <button class="btn btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                     &nbsp; {{l('Save', [], 'layouts')}}
                  </button>
                  <input type="hidden" id="nextAction" name="nextAction" value="" />
                  <button class="btn btn-info" type="submit" onclick="this.disabled=true;$('#nextAction').val('completeProductData');this.form.submit();">
                     <span class="glyphicon glyphicon-hdd"></span>
                     &nbsp; {{l('Save & Complete', [], 'layouts')}}
                  </button>
               </div>


@section('scripts') 

@include('products._calculator_js')

<script type="text/javascript">

$(document).ready(function() {
   $("#cost_price").val( 0.0 );
   $("#quantity_onhand").val( 0 );
});

</script>

@append