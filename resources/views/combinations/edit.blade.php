@extends('layouts.master')

@section('title') Usuarios - Modificar :: @parent @stop


@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2" style="margin-top: 50px">
		<div class="panel panel-info">
			<div class="panel-heading">
          <h3 class="panel-title">Modificar Dirección: ({{$combination->id}}) {{$combination->alias}}</h3>
          <h3 class="panel-title" style="margin-top:10px;">Pertenece a: ({{$combination->model_name}} {{$combination->id}}) {{$combination->name_fiscal}}</h3>
      </div>
			<div class="panel-body"> 
        <!-- h4 class="modal-title" id="modal_new_combinationLabel">({{$combination->id}}) {{$combination->name_fiscal}}</h4 -->

				{!! Form::model($combination, array('method' => 'PATCH', 'route' => array('combinations.update', $combination->id))) !!}
				@if($errors->any())
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</div>
				@endif

<ul class="nav nav-tabs lead" style="font-size: 16px; margin-top: 10px;">
  <li class="active"><a href="#main_data" data-toggle="tab">Dirección</a></li>
  <li><a href="#contact_data" data-toggle="tab">Contacto</a></li>
  <li><a href="#extra_data" data-toggle="tab">Otros</a></li>
</ul>

<div id="myTabContent" class="tab-content" style="padding-top: 20px;">
  <div class="tab-pane fade active in" id="main_data">

        <div class="row">
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('alias') ? 'has-error' : '' }}}">
                     Alias:
                     <input class="form-control" type="text" name="alias" id="alias" placeholder="" value="{{{ Input::old('alias', isset($combination) ? $combination->alias : '') }}}" />
                    {{ $errors->first('alias', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('name_commercial') ? 'has-error' : '' }}}">
                     Nombre Comercial:
                     <input class="form-control" type="text" name="name_commercial" id="name_commercial" placeholder="" value="{{{ Input::old('name_commercial', isset($combination) ? $combination->name_commercial : '') }}}" />
                    {{ $errors->first('name_commercial', '<span class="help-block">:message</span>') }}
                  </div>

                   <!-- div class="form-group col-lg-4 col-md-4 col-sm-4">
                     <label class="control-label">Envío por defecto?</label>
                     <div class="">
                       <div class="radio-inline">
                         <label>
                           <input name="blocked" id="active_on" value="1" @if (  Input::old('blocked', isset($combination) ? $combination->blocked : 1) )checked="checked"@endif type="radio">
                           Sí
                         </label>
                       </div>
                       <div class="radio-inline">
                         <label>
                           <input name="blocked" id="active_off" value="0" @if ( !Input::old('blocked', isset($combination) ? $combination->blocked : 1) )checked="checked"@endif type="radio">
                           No
                         </label>
                       </div>
                     </div>
                   </div -->
        </div>

        <div class="row">
                  <div class="form-group col-lg-5 col-md-5 col-sm-5 {{{ $errors->has('combination1') ? 'has-error' : '' }}}">
                     Dirección (calle, plaza, vía...):
                     <input class="form-control" type="text" name="combination1" id="combination1" placeholder="" value="{{{ Input::old('combination1', isset($combination) ? $combination->combination1 : '') }}}" />
                    {{ $errors->first('combination1', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-5 col-md-5 col-sm-5 {{{ $errors->has('combination2') ? 'has-error' : '' }}}">
                     Dirección 2 (barrio, edificio...):
                     <input class="form-control" type="text" name="combination2" id="combination2" placeholder="" value="{{{ Input::old('combination2', isset($combination) ? $combination->combination2 : '') }}}" />
                    {{ $errors->first('combination2', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-2 {{{ $errors->has('postcode') ? 'has-error' : '' }}}">
                     Código Postal:
                     <input class="form-control" type="text" name="postcode" id="postcode" placeholder="" value="{{{ Input::old('postcode', isset($combination) ? $combination->postcode : '') }}}" />
                    {{ $errors->first('postcode', '<span class="help-block">:message</span>') }}
                  </div>
        </div>

        <div class="row">
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('city') ? 'has-error' : '' }}}">
                     Ciudad:
                     <input class="form-control" type="text" name="city" id="city" placeholder="" value="{{{ Input::old('city', isset($combination) ? $combination->city : '') }}}" />
                    {{ $errors->first('city', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('state') ? 'has-error' : '' }}}">
                     Provincia:
                     <input class="form-control" type="text" name="state" id="state" placeholder="" value="{{{ Input::old('state', isset($combination) ? $combination->state : '') }}}" />
                    {{ $errors->first('state', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('country') ? 'has-error' : '' }}}">
                     País:
                     <input class="form-control" type="text" name="country" id="country" placeholder="" value="{{{ Input::old('country', isset($combination) ? $combination->country : Configuration::get('DEF_COUNTRY_NAME')) }}}" />
                    {{ $errors->first('country', '<span class="help-block">:message</span>') }}
                  </div>
        </div>

        <!-- div class="row">
            <div class="form-group col-lg-3 col-md-3 col-sm-3">
            <div class="well well-sm">
               <b>Contacto</b>
            </div>
            </div>
        </div -->

  </div>
  <div class="tab-pane fade in" id="contact_data">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('firstname') ? 'has-error' : '' }}}">
                    Nombre:
                    <input class="form-control" type="text" name="firstname" id="firstname" placeholder="" value="{{{ Input::old('firstname', isset($combination) ? $combination->firstname : '') }}}" />
                    {{ $errors->first('firstname', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('lastname') ? 'has-error' : '' }}}">
                    Apellidos:
                    <input class="form-control" type="text" name="lastname" id="lastname" placeholder="" value="{{{ Input::old('lastname', isset($combination) ? $combination->lastname : '') }}}" />
                    {{ $errors->first('lastname', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                    Correo Electónico:
                    <input class="form-control" type="text" name="email" id="customer_email" placeholder="" value="{{{ Input::old('email', isset($combination) ? $combination->email : '') }}}" />
                    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('phone') ? 'has-error' : '' }}}">
                    Teléfono (fijo):
                    <input class="form-control" type="text" name="phone" id="phone" placeholder="" value="{{{ Input::old('phone', isset($combination) ? $combination->phone : '') }}}" />
                    {{ $errors->first('phone', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('phone_mobile') ? 'has-error' : '' }}}">
                    Teléfono (móvil):
                    <input class="form-control" type="text" name="phone_mobile" id="phone_mobile" placeholder="" value="{{{ Input::old('phone_mobile', isset($combination) ? $combination->phone_mobile : '') }}}" />
                    {{ $errors->first('phone_mobile', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('fax') ? 'has-error' : '' }}}">
                    Fax:
                    <input class="form-control" type="text" name="fax" id="fax" placeholder="" value="{{{ Input::old('fax', isset($combination) ? $combination->fax : '') }}}" />
                    {{ $errors->first('fax', '<span class="help-block">:message</span>') }}
                </div>
            </div>
        </div>

  </div>
  <div class="tab-pane fade" id="extra_data">

        <!-- div class="row">
            <div class="form-group col-lg-3 col-md-3 col-sm-3">
            <div class="well well-sm">
               <b>Otros</b>
            </div>
            </div>
        </div -->

        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('phone') ? 'has-error' : '' }}}">
                    Longitud:
                    <input class="form-control" type="text" name="phone" id="phone" placeholder="" value="{{{ Input::old('phone', isset($combination) ? $combination->phone : '') }}}" />
                    {{ $errors->first('phone', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('phone_mobile') ? 'has-error' : '' }}}">
                    Latitud:
                    <input class="form-control" type="text" name="phone_mobile" id="phone_mobile" placeholder="" value="{{{ Input::old('phone_mobile', isset($combination) ? $combination->phone_mobile : '') }}}" />
                    {{ $errors->first('phone_mobile', '<span class="help-block">:message</span>') }}
                </div>
            </div>

                   <div class="form-group col-lg-4 col-md-4 col-sm-4">
                     <label class="control-label">Activo?</label>
                     <div class="">
                       <div class="radio-inline">
                         <label>
                           <input name="active" id="active_on" value="1" @if (  Input::old('active', isset($customer) ? $customer->active : 1) )checked="checked"@endif type="radio">
                           Sí
                         </label>
                       </div>
                       <div class="radio-inline">
                         <label>
                           <input name="active" id="active_off" value="0" @if ( !Input::old('active', isset($customer) ? $customer->active : 1) )checked="checked"@endif type="radio">
                           No
                         </label>
                       </div>
                     </div>
                   </div>
        </div>

        <div class="row">
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 {{{ $errors->has('notes') ? 'has-error' : '' }}}">
                     Notas:
                     <textarea id="notes" class="form-control" xcols="50" name="notes" rows="3" placeholder="">{{{ Input::old('notes', isset($customer) ? $customer->notes : null) }}}</textarea>
                  {{ $errors->first('notes', '<span class="help-block">:message</span>') }}
                  </div>
        </div>

  </div>

               <!-- div class="panel-footer text-right">
                  <input type="hidden" value="" name="tab_name" id="tab_name">
                  <button class="btn xbtn-sm btn-lightblue" xstyle="background-color: #008cba;" type="submit" onclick="this.disabled=true;$('#tab_name').val('combinationbook');this.form.submit();">
                     <span class="glyphicon glyphicon-hdd"></span>
                     &nbsp; Guardar
                  </button>
               </div -->

               </div><!-- div id="myTabContent" -->

        <?php if (!isset($back_route)) $back_route = ''; ?>
        <input type="hidden" name="back_route" value="{!!$back_route!!}"/>
				{!! Form::submit('Guardar', array('class' => 'btn btn-success')) !!}
        {!! link_to( ('products/' . $product->id . '/edit#combinations'), 'Cancelar', array('class' => 'btn btn-warning')) !!}
				{!! Form::close() !!}


			</div>
		</div>
	</div>
</div>

@stop