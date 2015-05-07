
{!! Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT', 'class' => 'form')) !!}
<input type="hidden" value="" name="tab_name" id="tab_name">

<div class="panel panel-primary" id="panel_internet">
   <div class="panel-heading">
      <h3 class="panel-title">Internet</h3>
   </div>
   <div class="panel-body">

<!-- Internet -->

        <div class="row">

                   <div class="form-group col-lg-2 col-md-2 col-sm-2" id="div-publish_to_web">
                     {!! Form::label('publish_to_web', l('Publish to web?'), ['class' => 'control-label']) !!}
                     <div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('publish_to_web', '1', true, ['id' => 'publish_to_web_on']) !!}
                           {!! l('Yes', [], 'layouts') !!}
                         </label>
                       </div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('publish_to_web', '0', false, ['id' => 'publish_to_web_off']) !!}
                           {!! l('No', [], 'layouts') !!}
                         </label>
                       </div>
                     </div>
                   </div>
        </div>

        <div class="row">
        </div>

        <div class="row">
        </div>

        <div class="row">
        </div>

<!-- Internet ENDS -->

   </div>

   <div class="panel-footer text-right">
      <button class="btn btn-sm btn-info" type="submit" onclick="this.disabled=true;$('#tab_name').val('internet');this.form.submit();">
         <span class="glyphicon glyphicon-hdd"></span>
         &nbsp; Guardar
      </button>
   </div>

</div>

{!! Form::close() !!}
