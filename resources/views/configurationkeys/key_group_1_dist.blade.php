@extends('layouts.master')

@section('title')
Configuración General
::@parent
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
            </div>
            <h2>Configuración</h2>
        </div>
    </div>
</div>

<div class="container-fluid">
   <div class="row">

        @include('configurationkeys.key_groups')
      
      <div class="col-lg-10 col-md-10 col-sm-9">

            <!-- div class="panel panel-primary" id="panel_main">
               <div class="panel-heading">
                  <h3 class="panel-title">Datos generales</h3>
               </div -->
               <div class="panel-body well">


<form class="form-horizontal">
  <fieldset>
    <legend>Legend</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputEmail" placeholder="Email" type="text">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Password A longer block of help text that breaks</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputPassword" placeholder="Password" type="password">
        <div class="checkbox">
          <label>
            <input type="checkbox"> Checkbox 
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Textarea</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea"></textarea>
        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Radios</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input name="optionsRadios" id="optionsRadios1" value="option1" checked="" type="radio">
            Option one is this
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="optionsRadios" id="optionsRadios2" value="option2" type="radio">
            Option two can be something else
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="select" class="col-lg-2 control-label">Selects</label>
      <div class="col-lg-10">
        <select class="form-control" id="select">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
        <br>
        <select multiple="" class="form-control">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button class="btn btn-default">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </fieldset>
</form>



               </div>

               <!-- div class="panel-footer text-right">
               </div>

            </div -->

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