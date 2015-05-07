
<div class="panel panel-primary" id="panel_combinations">
   <div class="panel-heading">
      <h3 class="panel-title">Combinaciones</h3>
   </div>
   <div class="panel-body">

<!-- Combinations -->

        <div class="row">
        </div>

<!-- Combination List -->

@if ($product->combinations->count())

<!-- Combination List -->
<div id="panel_combination_list">

    <div class="page-header">
        <div class="pull-right" style="padding-top: 4px;">
            <a href="{{{ URL::to('products/create') }}}" class="btn btn-sm btn-success" title=" Añadir Nuevo Producto "><i class="fa fa-plus"></i> Nuevo</a>
            <!-- a href="" onclick="return false;" data-toggle="modal" data-target="#modal_create_product" class="btn btn-sm btn-success" title=" Añadir Nuevo Cliente "><i class="fa fa-plus"></i> Nuevo</a -->
            <!-- @if (Input::get('onlyTrashed'))
              <a class="btn btn-default" href="{{ URL::to('products') }}">{{ Lang::get('products.general.show_curent') }}</a>
            @else
              <a class="btn btn-default" href="{{ URL::to('products?onlyTrashed=true') }}">{{ Lang::get('products.general.show_deleted') }}</a>
            @endif  -->        
        </div>
        <h2>
            Combinaciones
        </h2>        
    </div>

    <div id="div_combinations">
       <div class="table-responsive">

    <table id="products" class="table table-hover">
        <thead>
            <tr>
          <th>ID</th>
          <th>Referencia</th>
          <th>Atributos</th>
          <th>Stock</th>
          <th>Almacenes - ud.</th>
          <th class="text-center">Activo</th>
          <th class="text-right"> </th>
        </tr>
      </thead>
      <tbody>
      @foreach ($product->combinations as $combination)
        <tr>
          <td>{{ $combination->id }}</td>
          <td>{{ $combination->reference }}</td>
          <td>
              {{-- @foreach ($combination->options as $option)
                  { { $option->optiongroup->name } }: { { $option->name } } - 
              @endforeach
              <br /> --}}
              {!! $combination->name() !!}
          </td>
          <td>{{ $combination->quantity_onhand }}</td>
          <td>
              @foreach ($combination->warehouses as $wh)
                  {{ $wh->alias }} - {{ $wh->pivot->quantity }}<br />
              @endforeach
          </td>
          <td class="text-center">@if ($combination->active) <i class="fa fa-check-square" style="color: #38b44a;"></i> @else <i class="fa fa-square-o" style="color: #df382c;"></i> @endif</td>
               <td class="text-right">
                    @if (  is_null($combination->deleted_at))
                    <a class="btn btn-sm btn-warning" href="{{ URL::to('combinations/' . $combination->id . '/edit') }}" title=" Modificar "><i class="fa fa-pencil"></i></a>
                    @else
                    <a class="btn btn-warning" href="{{ URL::to('products/' . $product->id. '/restore' ) }}"><i class="fa fa-reply"></i></a>
                    <a class="btn btn-danger" href="{{ URL::to('products/' . $product->id. '/delete' ) }}"><i class="fa fa-trash-o"></i></a>
                    @endif
                </td>
        </tr>
      @endforeach
        </tbody>
    </table>

       </div>
    </div>

</div>
<!-- Combination List ENDS -->


      @foreach ($groups as $i => $group)

      {{$group['name']}} {!! Form::select('group_'.$i, array('0' => '-- Seleccione --') + $group['values'], null, array('class' => 'form-control')) !!}
      <br /><br />

      @endforeach


@else
    <div class="alert alert-warning alert-block">
        <i class="fa fa-warning"></i>
        {{l('No records found', [], 'layouts')}}
    </div>

    @include('products._form_select_groups')

@endif



<!-- Combinations ENDS -->

   </div>

</div>