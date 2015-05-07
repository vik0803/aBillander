<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
                <th class="text-left">Referencia + Descripción</th>
                <th class="text-left">Notas</th>
                <th class="text-right">Stock</th>
                <th class="text-right">Pendiente</th>
                <th class="text-right">Reservado</th>
                <th class="text-right">Disponible</th>
                <th></th>
			</tr>
		</thead>
		<tbody>
			<tr>  
				<td class="text-left">
				    <a onclick="add_product_to_order('FAG-001', 'Fagodio Esforulante', 'undefined', 'undefined', 'undefined')" href="javascript:void(0);">{{$product->reference}}</a> &nbsp; {{{$product->name}}}
				</td>
				<td class="text-left">
                     {{$product->notes}}
                </td>
                <td class="text-right">{{$product->quantity_onhand}}</td>
                <td class="text-right">{{$product->quantity_onorder}}</td>
                <td class="text-right">{{$product->quantity_allocated}}</td>
                <td class="text-right" id="quantity_available"><strong>{{$product->quantity_onhand+$product->quantity_onorder-$product->quantity_allocated}}</strong></td>
                <script type="text/javascript">
                	// alert($("#quantity_available").text());
                	if ( parseFloat($("#quantity_available").text()) <= 0 ) $("#quantity_available").addClass('alert-danger');
                </script>
                <td>
                <a title=" Añadir al Pedido " onclick="add_product_to_order( {{{ $product_string }}} )" href="javascript:void(0);">
                		<button type="button" class="btn btn-xs btn-success">
                			<span class="glyphicon glyphicon-shopping-cart"></span>
                		</button>
                	</a>
                </td>
            </tr>                          
		</tbody>
	</table>
</div>

<!-- div class="modal-header">
<div class="lead well well-lg">
   <b>Cliente</b>: <a href="index.php?page=ventas_cliente&amp;cod=000001">PePiToR</a><br>
   <b>Tarifa</b>: <a href="index.php?page=admin_agente&amp;cod=1">Paco Pepe</a><br>
</div>
</div -->

<!-- div class="modal-body">
	<ul class="nav nav-tabs" id="nav_12">
	   <li id="li_1" class="active"><a href="javascript:void(0);"><b>Cliente</b>: PePiToR</a></li>
	   <li id="li_2"               ><a href="javascript:void(0);"><b>Tarifa</b>: Paco Pepe</a></li>
	</ul>
</div -->

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title"><b>Cliente</b>: PePiToR</a></h3>
  </div>
  <div class="panel-body">
    <b>Tarifa</b>: Paco Pepe</a>
  </div>
</div>

<div class="modal-body">
   <span id="detalle">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th class="text-left">PVP</th>
            <th class="text-left">Coste</th>
            <th class="text-left">Margen</th>
            <th class="text-right">PVP Cliente</th>
            <th class="text-right">Descuento</th>
            <th class="text-right">Margen Cliente</th>
            <th class="text-right">PVP+IVA Cliente</th>
          </tr>
        </thead>
        <tbody id="lineas_detalle">
          
          <tr>
            <td>{{$product->price}}</td>
            <td>{{$product->cost_price}}</td>
            <td>{{Calculator::margin($product->cost_price, $product->price)}}</td>
            <td class="text-right">{{$product->price_customer}}</td>
            <td class="text-right">{{$product->price-$product->price_customer}} ({{100*($product->price-$product->price_customer)/$product->price}}%)</td>
            <td class="text-right">{{Calculator::margin($product->cost_price, $product->price_customer)}}</td>
            <td class="text-right">{{$product->price_customer_with_tax}}</td>
          </tr>
          
        </tbody>
      </table>
   </span>

   <br><br>
   
   <b>Margen</b>: 
   @if ( Configuration::get('MARGIN_METHOD') == 'CST' )  
      se calcula sobre el <i>Precio de Coste</i>.
   @else
      se calcula sobre el <i>Precio de Venta</i>.
   @endif
   <br>
</div>