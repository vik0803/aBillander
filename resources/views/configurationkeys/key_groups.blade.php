      <div class="col-lg-2 col-md-2 col-sm-3">
         <div class="list-group">
            <a id="b_tab_index_1" href="{{ URL::to('configurationkeys?tab_index=1') }}" class="list-group-item @if ($tab_index==1) active @endif">
               <span class="glyphicon glyphicon-user"></span>
               &nbsp; Mi Empresa
            </a>
            <a id="b_tab_index_2" href="{{ URL::to('configurationkeys?tab_index=2') }}" class="list-group-item @if ($tab_index==2) active @endif">
               <span class="glyphicon glyphicon-dashboard"></span>
               &nbsp; Valores por Defecto
            </a>
            <!-- a id="b_bankaccounts" href="#bankaccounts" class="list-group-item">
               <span class="glyphicon glyphicon-briefcase"></span>
               &nbsp; Bancos
            </a>
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
            </a>
            <a id="b_stats" href="{$fsc->url()}&stats=TRUE#stats" class="list-group-item">
               <span class="glyphicon glyphicon-stats"></span>
               &nbsp; Estadísticas
            </a -->
         </div>
      </div>