

         {{ Form::model($customer, array('route' => array('customers.update', $customer->id), 'method' => 'PUT', 'class' => 'form')) }}
            <input type="hidden" name="id" value="{$customer->id}"/>

            <div class="panel panel-primary" id="panel_addressbook">
               <div class="panel-heading">
                  <h3 class="panel-title">Direcciones</h3>
               </div>
               <div class="panel-body">


        <div class="row">
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('shipping_address_id') ? 'has-error' : '' }}}">
                      <label class="control-label">Dirección Principal:</label>
                    <select class="form-control" name="shipping_address_id" id="shipping_address_id" @if ( count($aBook)==1 ) disabled="disabled" @endif>
                        <option {{ $customer->shipping_address_id <= 0 ? 'selected="selected"' : '' }} value="0">-- Seleccione--</option>
                        @foreach ($aBook as $country)
                        <option {{ $customer->shipping_address_id == $country->id ? 'selected="selected"' : '' }} value="{{ $country->id }}">{{ $country->alias }}</option>
                        @endforeach
                    </select>
                    {{ $errors->first('shipping_address_id', '<span class="help-block">:message</span>') }}
                    <p>Es la Dirección que aparecerá en las Facturas.</p>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('shipping_address_id') ? 'has-error' : '' }}}">
                      <label class="control-label">Dirección de Envío:</label>
                    <select class="form-control" name="shipping_address_id" id="shipping_address_id" @if ( count($aBook)==1 ) disabled="disabled" @endif>
                        <option {{ $customer->shipping_address_id <= 0 ? 'selected="selected"' : '' }} value="0">-- Seleccione--</option>
                        @foreach ($aBook as $country)
                        <option {{ $customer->shipping_address_id == $country->id ? 'selected="selected"' : '' }} value="{{ $country->id }}">{{ $country->alias }}</option>
                        @endforeach
                    </select>
                    {{ $errors->first('shipping_address_id', '<span class="help-block">:message</span>') }}
                    <p>Es la Dirección de envío por defecto.</p>
                  </div>
        </div>


               </div>
               <div class="panel-footer text-right">
                  <input type="hidden" value="" name="tab_name" id="tab_name">
                  <button class="btn xbtn-sm btn-info" type="submit" onclick="this.disabled=true;$('#tab_name').val('addressbook');this.form.submit();">
                     <span class="glyphicon glyphicon-hdd"></span>
                     &nbsp; Guardar
                  </button>
               </div>
            </div>
         {{ Form::close() }}


<!-- Main Address -->

         {{ Form::model($customer, array('route' => array('customers.update', $customer->id), 'method' => 'PUT', 'class' => 'form')) }}
            <input type="hidden" name="id" value="{$customer->id}"/>

            <div class="panel panel-info" id="panel_addressbook">
               <div class="panel-heading">
                  <h3 class="panel-title">{{{ isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->alias : '' }}} (#{{ isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->id : 'desconocido' }})</h3>
               </div>
               <div class="panel-body">


        <div class="row">
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('alias') ? 'has-error' : '' }}}">
                     Alias:
                     <input class="form-control" type="text" name="alias" id="alias" placeholder="" value="{{{ Input::old('alias', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->alias : '') }}}" />
                    {{ $errors->first('alias', '<span class="help-block">:message</span>') }}
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-4 {{{ $errors->has('name_commercial') ? 'has-error' : '' }}}">
                     Nombre Comercial:
                     <input class="form-control" type="text" name="name_commercial" id="name_commercial" placeholder="" value="{{{ Input::old('name_commercial', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->name_commercial : '') }}}" />
                    {{ $errors->first('name_commercial', '<span class="help-block">:message</span>') }}
                  </div>

                   <!-- div class="form-group col-lg-4 col-md-4 col-sm-4">
                     <label class="control-label">Envío por defecto?</label>
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
                   </div -->
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
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('phone') ? 'has-error' : '' }}}">
                    Longitud:
                    <input class="form-control" type="text" name="phone" id="phone" placeholder="" value="{{{ Input::old('phone', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->phone : '') }}}" />
                    {{ $errors->first('phone', '<span class="help-block">:message</span>') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{{ $errors->has('phone_mobile') ? 'has-error' : '' }}}">
                    Latitud:
                    <input class="form-control" type="text" name="phone_mobile" id="phone_mobile" placeholder="" value="{{{ Input::old('phone_mobile', isset($aBook[$mainAddressIndex]) ? $aBook[$mainAddressIndex]->phone_mobile : '') }}}" />
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
               <div class="panel-footer text-right">
                  <input type="hidden" value="" name="tab_name" id="tab_name">
                  <button class="btn xbtn-sm btn-info" style="background-color: #008cba;" type="submit" onclick="this.disabled=true;$('#tab_name').val('addressbook');this.form.submit();">
                     <span class="glyphicon glyphicon-hdd"></span>
                     &nbsp; Guardar
                  </button>
               </div>
            </div>
         {{ Form::close() }}

<!-- Main Address ENDS -->