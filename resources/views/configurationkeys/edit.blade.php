@extends('layouts.master')

@section('title')
{{ Lang::get('clients.general.edit') }} {{ $customer->name_fiscal }}
::@parent
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{ URL::to('invoices/create') }}" class="btn btn-success" title=" Nueva Dirección Postal "><i class="fa fa-plus"></i> Dirección</a>
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
                <a href="{{ URL::to('customers') }}" class="btn btn-default"><i class="fa fa-mail-reply"></i> Volver a Clientes</a>
            </div>
            <h2><a href="{{ URL::to('customers') }}">Clientes</a> <span style="color: #cccccc;">/</span> {{ $customer->name_fiscal }}</h2>
        </div>
    </div>
</div>

<div class="container-fluid">
   <div class="row">

      <div class="col-lg-2 col-md-2 col-sm-3">
         <div class="list-group">
            <a id="b_main" href="#" class="list-group-item active">
               <span class="glyphicon glyphicon-user"></span>
               &nbsp; Datos generales
            </a>
            <a id="b_commercial" href="#commercial" class="list-group-item">
               <span class="glyphicon glyphicon-dashboard"></span>
               &nbsp; Comercial
            </a>
            <!-- a id="b_bankaccounts" href="#bankaccounts" class="list-group-item">
               <span class="glyphicon glyphicon-briefcase"></span>
               &nbsp; Bancos
            </a -->
            <a id="b_addressbook" href="#addressbook" class="list-group-item">
               <span class="glyphicon glyphicon-road"></span>
               &nbsp; Direcciones
            </a>
            <!-- a id="b_specialprices" href="#specialprices" class="list-group-item">
               <span class="glyphicon glyphicon-list-alt"></span>
               &nbsp; Precios Especiales
            </a -->
            <!-- a id="b_accounting" href="#accounting" class="list-group-item">
               <span class="glyphicon glyphicon-book"></span>
               &nbsp; Contabilidad
            </a -->
            <a id="b_stats" href="{$fsc->url()}&stats=TRUE#stats" class="list-group-item">
               <span class="glyphicon glyphicon-stats"></span>
               &nbsp; Estadísticas
            </a>
         </div>
      </div>
      
      <div class="col-lg-10 col-md-10 col-sm-9">

         {{ Form::model($customer, array('route' => array('customers.update', $customer->id), 'method' => 'PUT', 'class' => 'form')) }}
            <input type="hidden" name="id" value="{$customer->id}"/>

            <div class="panel panel-primary" id="panel_main">
               <div class="panel-heading">
                  <h3 class="panel-title">Datos generales</h3>
               </div>
               <div class="panel-body">

<!-- Datos generales -->

        <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 {{{ $errors->has('name_fiscal') ? 'has-error' : '' }}}">
                     Empresa:
                     <input class="form-control" type="text" name="name_fiscal" id="name_fiscal" placeholder="Nombre fiscal" value="{{{ Input::old('name_fiscal', isset($customer) ? $customer->name_fiscal : null) }}}" />
                   {{ $errors->first('name_fiscal', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('name_commercial') ? 'has-error' : '' }}}">
                     Nombre Comercial:
                     <input class="form-control" type="text" name="name_commercial" id="name_commercial" placeholder="" value="{{{ Input::old('name_commercial', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->name_commercial : '') }}}" />
                    {{ $errors->first('name_commercial', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-2 {{{ $errors->has('identification') ? 'has-error' : '' }}}">
                     DNI / CIF:
                     <input class="form-control" type="text" name="identification" id="identification" placeholder="" value="{{{ Input::old('identification', isset($customer) ? $customer->identification : null) }}}" />
                   {{ $errors->first('identification', '<span class="help-block">:message</span>') }}
                  </div>
        </div>

        <div class="row">
                  <div class="form-group col-lg-5 col-md-5 col-sm-5 {{{ $errors->has('address1') ? 'has-error' : '' }}}">
                     Dirección (calle, plaza, vía...):
                     <input class="form-control" type="text" name="address1" id="address1" placeholder="" value="{{{ Input::old('address1', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->address1 : '') }}}" />
                    {{ $errors->first('address1', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-5 col-md-5 col-sm-5 {{{ $errors->has('address2') ? 'has-error' : '' }}}">
                     Dirección 2 (barrio, edificio...):
                     <input class="form-control" type="text" name="address2" id="address2" placeholder="" value="{{{ Input::old('address2', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->address2 : '') }}}" />
                    {{ $errors->first('address2', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-2 {{{ $errors->has('postcode') ? 'has-error' : '' }}}">
                     Código Postal:
                     <input class="form-control" type="text" name="postcode" id="postcode" placeholder="" value="{{{ Input::old('postcode', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->postcode : '') }}}" />
                    {{ $errors->first('postcode', '<span class="help-block">:message</span>') }}
                  </div>
        </div>

        <div class="row">
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('city') ? 'has-error' : '' }}}">
                     Ciudad:
                     <input class="form-control" type="text" name="city" id="city" placeholder="" value="{{{ Input::old('city', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->city : '') }}}" />
                    {{ $errors->first('city', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('state') ? 'has-error' : '' }}}">
                     Provincia:
                     <input class="form-control" type="text" name="state" id="state" placeholder="" value="{{{ Input::old('state', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->state : '') }}}" />
                    {{ $errors->first('state', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('country') ? 'has-error' : '' }}}">
                     País:
                     <input class="form-control" type="text" name="country" id="country" placeholder="" value="{{{ Input::old('country', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->country : Configuration::get('DEF_COUNTRY_NAME')) }}}" />
                    {{ $errors->first('country', '<span class="help-block">:message</span>') }}
                  </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3 col-md-3 col-sm-3">
            <div class="well well-sm">
               <b>Contacto</b>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('firstname') ? 'has-error' : '' }}}">
                    Nombre:
                    <input class="form-control" type="text" name="firstname" id="firstname" placeholder="" value="{{{ Input::old('firstname', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->firstname : '') }}}" />
                    {{ $errors->first('firstname', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('lastname') ? 'has-error' : '' }}}">
                    Apellidos:
                    <input class="form-control" type="text" name="lastname" id="lastname" placeholder="" value="{{{ Input::old('lastname', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->lastname : '') }}}" />
                    {{ $errors->first('lastname', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                    Correo Electrónico:
                    <input class="form-control" type="text" name="email" id="customer_email" placeholder="" value="{{{ Input::old('email', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->email : '') }}}" />
                    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('phone') ? 'has-error' : '' }}}">
                    Teléfono (fijo):
                    <input class="form-control" type="text" name="phone" id="phone" placeholder="" value="{{{ Input::old('phone', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->phone : '') }}}" />
                    {{ $errors->first('phone', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('phone_mobile') ? 'has-error' : '' }}}">
                    Teléfono (móvil):
                    <input class="form-control" type="text" name="phone_mobile" id="phone_mobile" placeholder="" value="{{{ Input::old('phone_mobile', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->phone_mobile : '') }}}" />
                    {{ $errors->first('phone_mobile', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('fax') ? 'has-error' : '' }}}">
                    Fax:
                    <input class="form-control" type="text" name="fax" id="fax" placeholder="" value="{{{ Input::old('fax', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->fax : '') }}}" />
                    {{ $errors->first('fax', '<span class="help-block">:message</span>') }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3 col-md-3 col-sm-3">
            <div class="well well-sm">
               <b>Otros</b>
            </div>
            </div>
        </div>

        <div class="row">
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('website') ? 'has-error' : '' }}}">
                     Web:
                     <input class="form-control" type="text" name="website" id="website" placeholder="www." value="{{{ Input::old('website', isset($customer) ? $customer->website : null) }}}" />
                    {{ $errors->first('website', '<span class="help-block">:message</span>') }}
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

                   <div class="form-group col-lg-4 col-md-4 col-sm-4">
                     <label class="control-label">Bloqueado?</label>
                     <div class="">
                       <div class="radio-inline">
                         <label>
                           <input name="blocked" id="active_on" value="1" @if (  Input::old('blocked', isset($customer) ? $customer->blocked : 1) )checked="checked"@endif type="radio">
                           Sí
                         </label>
                       </div>
                       <div class="radio-inline">
                         <label>
                           <input name="blocked" id="active_off" value="0" @if ( !Input::old('blocked', isset($customer) ? $customer->blocked : 1) )checked="checked"@endif type="radio">
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

<!-- Datos generales ENDS -->

               </div>
               <div class="panel-footer text-right">
                  <button class="btn btn-sm btn-info" type="submit" onclick="this.disabled=true;this.form.submit();">
                     <span class="glyphicon glyphicon-hdd"></span>
                     &nbsp; Guardar
                  </button>
               </div>
            </div>
            
            <div class="panel panel-primary" id="panel_commercial">
               <div class="panel-heading">
                  <h3 class="panel-title">Comercial</h3>
               </div>
               <div class="panel-body">

<!-- Comercial -->

        <div class="row">
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('sequence_id') ? 'has-error' : '' }}}">
                     Serie de Facturas:
                     {{ Form::select('sequence_id', array('0' => '-- Seleccione--') + $sequenceList, Input::old('sequence_id', isset($customer) ? $customer->sequence_id : 0), array('class' => 'form-control')) }}
                     {{ $errors->first('sequence_id', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('payment_method_id') ? 'has-error' : '' }}}">
                     Forma de Pago:
                     {{ Form::select('payment_method_id', array('0' => '-- Seleccione--') + $payment_methodList, Input::old('payment_method_id', isset($customer) ? $customer->payment_method_id : 0), array('class' => 'form-control')) }}
                     {{ $errors->first('payment_method_id', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('currency_id') ? 'has-error' : '' }}}">
                     Divisa de Pago:
                     {{ Form::select('currency_id', array('0' => '-- Seleccione--') + $currencyList, Input::old('currency_id', isset($customer) ? $customer->currency_id : 0), array('class' => 'form-control')) }}
                     {{ $errors->first('currency_id', '<span class="help-block">:message</span>') }}
                  </div>
        </div>

        <div class="row">
                   <div class="form-group col-lg-3 col-md-3 col-sm-3">
                     <label class="control-label">Admite Factura Electrónica?</label>
                     <div class="">
                       <div class="radio-inline">
                         <label>
                           <input name="accept_einvoice" id="accept_einvoice_on" value="1" @if (  Input::old('accept_einvoice', isset($customer) ? $customer->accept_einvoice : 1) )checked="checked"@endif type="radio">
                           Sí
                         </label>
                       </div>
                       <div class="radio-inline">
                         <label>
                           <input name="accept_einvoice" id="accept_einvoice_off" value="0" @if ( !Input::old('accept_einvoice', isset($customer) ? $customer->accept_einvoice : 1) )checked="checked"@endif type="radio">
                           No
                         </label>
                       </div>
                     </div>
                   </div>

                  <div class="form-group col-lg-3 col-md-3 col-sm-3 {{{ $errors->has('outstanding_amount_allowed') ? 'has-error' : '' }}}">
                     Riesgo Máximo Permitido:
                     <input class="form-control" type="text" name="outstanding_amount_allowed" id="outstanding_amount_allowed" placeholder="" value="{{{ Input::old('outstanding_amount_allowed', isset($customer) ? $customer->outstanding_amount_allowed : null) }}}" />
                    {{ $errors->first('outstanding_amount_allowed', '<span class="help-block">:message</span>') }}
                  </div>

                  <div class="form-group col-lg-2 col-md-2 col-sm-2 {{{ $errors->has('outstanding_amount') ? 'has-error' : '' }}}">
                     Riesgo Alcanzado:
                     <input class="form-control" type="text" name="outstanding_amount" id="outstanding_amount" disabled="disabled" value="{{{ isset($customer) ? $customer->outstanding_amount : 0 }}}" />
                    {{ $errors->first('outstanding_amount', '<span class="help-block">:message</span>') }}
                  </div>

                  <div class="form-group col-lg-2 col-md-2 col-sm-2 {{{ $errors->has('unresolved_amount') ? 'has-error' : '' }}}">
                     Impagado:
                     <input class="form-control" type="text" name="unresolved_amount" id="unresolved_amount" disabled="disabled" value="{{{ isset($customer) ? $customer->unresolved_amount : 0 }}}" />
                    {{ $errors->first('unresolved_amount', '<span class="help-block">:message</span>') }}
                  </div>
        </div>

        <div class="row">
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('customer_group_id') ? 'has-error' : '' }}}">
                     Grupo de Cliente:
                     {{ Form::select('customer_group_id', array('0' => '-- Seleccione--') + $customer_groupList, Input::old('customer_group_id', isset($customer) ? $customer->customer_group_id : 0), array('class' => 'form-control')) }}
                     {{ $errors->first('customer_group_id', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('price_list_id') ? 'has-error' : '' }}}">
                     Tarifa:
                     {{ Form::select('price_list_id', array('0' => '-- Seleccione--') + $price_listList, Input::old('price_list_id', isset($customer) ? $customer->price_list_id : 0), array('class' => 'form-control')) }}
                     {{ $errors->first('price_list_id', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('salesrep_id') ? 'has-error' : '' }}}">
                     Agente Comercial:
                     {{ Form::select('salesrep_id', array('0' => '-- Seleccione--') + $salesrepList, Input::old('salesrep_id', isset($customer) ? $customer->salesrep_id : 0), array('class' => 'form-control')) }}
                     {{ $errors->first('salesrep_id', '<span class="help-block">:message</span>') }}
                  </div>
        </div>

        <div class="row">
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('shipping_address_id') ? 'has-error' : '' }}}">
                     Dirección de Envío:
                    <select class="form-control" name="shipping_address_id" id="shipping_address_id" @if ( count($aBook)==1 ) disabled="disabled" @endif>
                        <option {{ $customer->shipping_address_id <= 0 ? 'selected="selected"' : '' }} value="0">-- Seleccione--</option>
                        @foreach ($aBook as $country)
                        <option {{ $customer->shipping_address_id == $country->id ? 'selected="selected"' : '' }} value="{{ $country->id }}">{{ $country->alias }}</option>
                        @endforeach
                    </select>
                    {{ $errors->first('shipping_address_id', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('carrier_id') ? 'has-error' : '' }}}">
                     Transportista:
                     {{ Form::select('carrier_id', array('0' => '-- Seleccione--') + $carrierList, Input::old('carrier_id', isset($customer) ? $customer->carrier_id : 0), array('class' => 'form-control')) }}
                     {{ $errors->first('carrier_id', '<span class="help-block">:message</span>') }}
                  </div>
        </div>

<!-- Comercial ENDS -->

               </div>
               <div class="panel-footer text-right">
                  <input type="hidden" value="" name="tab_name" id="tab_name">
                  <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;$('#tab_name').val('commercial');this.form.submit();">
                     <span class="glyphicon glyphicon-floppy-disk"></span>
                     &nbsp; Guardar
                  </button>
               </div>
            </div>
         {{ Form::close() }}

         @include('customers.edit_addresses')

      </div><!-- div class="col-lg-10 col-md-10 col-sm-9" -->

   </div>
</div>
@stop

@section('scripts') 
<script type="text/javascript">
   function route_url()
   {
      $("#panel_main").hide();
      $("#panel_commercial").hide();
 //     $("#panel_bankaccounts").hide();
      $("#panel_addressbook").hide();
 //     $("#panel_specialprices").hide();
 //     $("#panel_accounting").hide();

      $("#b_main").removeClass('active');
      $("#b_commercial").removeClass('active');
 //     $("#b_bankaccounts").removeClass('active');
      $("#b_addressbook").removeClass('active');
 //     $("#b_specialprices").removeClass('active');
 //     $("#b_accounting").removeClass('active');
      
      if(window.location.hash.substring(1) == 'commercial')
      {
         $("#panel_commercial").show();
         $("#b_commercial").addClass('active');
         // document.f_cliente.codgrupo.focus();
      }
      else if(window.location.hash.substring(1) == 'addressbook')
      {
         $("#panel_addressbook").show();
         $("#b_addressbook").addClass('active');
      }
      else  
      {
         $("#panel_main").show();
         $("#b_main").addClass('active');
         // document.f_cliente.nombre.focus();
      }
   }
   $(document).ready(function() {
      route_url();
      window.onpopstate = function(){
         route_url();
      }
      $("#b_eliminar").click(function(event) {
         event.preventDefault();
         if( confirm("¿Realmente desea eliminar este cliente?") )
            window.location.href = '{$fsc->ppage->url()}&delete={$fsc->cliente->codcliente}';
      });
      $("#b_nueva_cuenta").click(function(event) {
         event.preventDefault();
         $("#modal_nueva_cuenta").modal('show');
         document.f_nueva_cuenta.descripcion.focus();
      });
      $("#b_nueva_direccion").click(function(event) {
         event.preventDefault();
         $("#modal_nueva_direccion").modal('show');
         document.f_nueva_direccion.provincia.focus();
      });
   });
</script>
@stop