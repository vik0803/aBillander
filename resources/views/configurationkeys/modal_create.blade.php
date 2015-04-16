
<div class="modal" id="modal_create_customer">
{{ Form::open(array('url' => 'customers', 'id'=> 'create_customer', 'name' => 'create_customer', 'class' => 'form-horizontal', 'role' => 'form')) }}
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nuevo cliente</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="codserie" class="col-lg-2 col-md-2 col-sm-2 control-label"><a href="{$fsc->serie->url()}">Serie</a></label>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                     <select class="form-control" name="codserie">
                     {loop="$fsc->serie->all()"}
                        <option value="{$value->codserie}"{if condition="$value->is_default()"} selected="selected"{/if}>{$value->descripcion}</option>
                     {/loop}
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label for="nombre" class="col-lg-2 col-md-2 col-sm-2 control-label">Nombre</label>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                     <input class="form-control" type="text" name="nombre" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label for="cifnif" class="col-lg-2 col-md-2 col-sm-2 control-label">{#FS_CIFNIF#}</label>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                     <input class="form-control" type="text" name="cifnif" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label for="pais" class="col-lg-2 col-md-2 col-sm-2 control-label"><a href="{$fsc->pais->url()}">País</a></label>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                     <select class="form-control" name="pais">
                     {loop="$fsc->pais->all()"}
                        <option value="{$value->codpais}"{if condition="$value->is_default()"} selected="selected"{/if}>{$value->nombre}</option>
                     {/loop}
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label for="provincia" class="col-lg-2 col-md-2 col-sm-2 control-label">Provincia</label>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                     <input class="form-control" type="text" name="provincia" autocomplete="off" value="{$fsc->empresa->provincia}"/>
                  </div>
               </div>
               <div class="form-group">
                  <label for="ciudad" class="col-lg-2 col-md-2 col-sm-2 control-label">Ciudad</label>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                     <input class="form-control" type="text" name="ciudad" autocomplete="off" value="{$fsc->empresa->ciudad}"/>
                  </div>
               </div>
               <div class="form-group">
                  <label for="codpostal" class="col-lg-2 col-md-2 col-sm-2 control-label">Código Postal</label>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                     <input class="form-control" type="text" name="codpostal" autocomplete="off" value="{$fsc->empresa->codpostal}"/>
                  </div>
               </div>
               <div class="form-group">
                  <label for="direccion" class="col-lg-2 col-md-2 col-sm-2 control-label">Dirección</label>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                     <input class="form-control" type="text" name="direccion" value="C/ " autocomplete="off"/>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <input type="hidden" value="1" name="submitCustomersCreate">
               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
                  &nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
{{ Form::close() }}
</div>