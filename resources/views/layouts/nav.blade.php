<nav class="navbar navbar-default" role="navigation" style="margin: 0px 0px 5px 0px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            @if( Auth::check() )
                <a href="{{{ URL::to( (Auth::user()->home_page ? Auth::user()->home_page : '/') ) }}}" class="navbar-brand">{!! App\Configuration::get('COMPANY_BO_LOGO') !!}</a>
            @else
                <a href="{{{ URL::to('/') }}}" class="navbar-brand"><span style="color:#dddddd"><i class="fa fa-bolt"></i> Lara<span style="color:#fff">Billander</span></span></a>
            @endif
        </div>
        <nav class="collapse navbar-collapse" role="navigation">
            <ul class="nav navbar-nav navbar-right">

                @if( Auth::check() )
                <!-- li><a href="{{{ URL::to('clients') }}}"><i class="fa fa-dashboard"></i> Sistema</a></li -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> {{l('Basic Data', [], 'layouts')}} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                         <li>
                            <a href="{{{ URL::to('currencies') }}}">
                                 {{l('Currencies', [], 'layouts')}}
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('paymentmethods') }}}">
                                 Formas de Pago
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('taxes') }}}">
                                 Impuestos
                            </a>
                        </li>
                         <!-- li>
                            <a href="{{{ URL::to('account') }}}">
                                 Bancos
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('account') }}}">
                                 Cuentas Remesas
                            </a>
                        </li -->
                        <li class="divider"></li>
                         <li>
                            <a href="{{{ URL::to('categories') }}}">
                                 Categorías de Productos
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('customergroups') }}}">
                                 Grupos de Clientes
                            </a>
                        </li>
                        <li class="divider"></li>
                         <!-- li>
                            <a href="{{{ URL::to('account') }}}">
                                 Países
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('account') }}}">
                                 Provincias
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('account') }}}">
                                 Zonas
                            </a>
                        </li -->
                        <li class="divider"></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-dashboard"></i> Sistema <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <!-- li class="disabled">
                            <a href="" onClick="return false;">
                                 Tablas Generales
                            </a>
                        </li>
                        <li class="divider"></li -->
                         <li>
                            <a href="{{{ URL::to('customers') }}}">
                                 Clientes
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('salesreps') }}}">
                                 Agentes
                            </a>
                        </li>
                         <!-- li>
                            <a href="{{{ URL::to('account') }}}">
                                 Proveedores
                            </a>
                        </li -->
                         <!-- li>
                            <a href="{{{ URL::to('carriers') }}}">
                                 Transportistas
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('manufacturers') }}}">
                                 Fabricantes
                            </a>
                        </li -->
                        <li class="divider"></li>
                         <li>
                            <a href="{{{ URL::to('warehouses') }}}">
                                 Almacenes
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('pricelists') }}}">
                                 Tarifas
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('attributegroups') }}}">
                                 Atributos de Productos
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('products') }}}">
                                 Productos
                            </a>
                        </li>
                        <li class="divider"></li>
                    </ul>
                </li>
                <!-- li><a href="{{{ URL::to('clients') }}}"><i class="fa fa-shopping-cart"></i> Almacén</a></li -->


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i> Almacén <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="divider"></li>
                         <li>
                            <a href="{{{ URL::to('stockmovements') }}}">
                                 Movimientos de Almacén
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('stockmovements') }}}">
                                 Regularización de Almacén
                            </a>
                        </li>
                        <li class="divider"></li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text"></i> Facturación <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                         <li>
                            <a href="{{{ URL::to('customerinvoices') }}}">
                                 Facturas
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="divider"></li>
                    </ul>
                </li>


                <li><a href="{{{ URL::to('clients') }}}"><i class="fa fa-bar-chart-o"></i> Informes</a></li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->getFullName() }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                         <li>
                            <a href="{{{ URL::to('account') }}}">
                                 {{l('Documentation', [], 'layouts')}}
                            </a>
                        </li>
                         <li>
                            <a data-target="#contactForm" data-toggle="modal" onclick="return false;" href="">
                                 {{l('Support & feed-back', [], 'layouts')}}
                            </a>
                        </li>
                        <li class="divider"></li>
                         <li>
                            <a href="http://bootswatch.com/united/" target="_blank">
                                 Plantilla BS3
                            </a>
                        </li>
                         <li>
                            <a href="http://getbootstrap.com/components/" target="_blank">
                                 Glyphicons
                            </a>
                        </li>
                         <li>
                            <a href="http://fontawesome.io/icons/" target="_blank">
                                 Font-Awesome
                            </a>
                        </li>
                         <li>
                            <a data-target="#aboutLaraBillander" data-toggle="modal" onclick="return false;" href="">
                                 {{l('About ...', [], 'layouts')}}
                            </a>
                        </li>
                        @if ( Auth::user()->isAdmin() )
                        <li class="divider"></li>
                         <li>
                            <a href="{{{ URL::to('companies') }}}">
                                 {{l('Company', [], 'layouts')}}
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('configurations') }}}">
                                 {{l('Configuration - All keys', [], 'layouts')}}
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('configurationkeys') }}}">
                                 {{l('Configuration', [], 'layouts')}}
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('languages') }}}">
                                 {{l('Languages', [], 'layouts')}}
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('sequences') }}}">
                                 {{l('Document sequences', [], 'layouts')}}
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('templates') }}}">
                                 {{l('Document templates', [], 'layouts')}}
                            </a>
                        </li>
                         <li>
                            <a href="{{{ URL::to('users') }}}">
                                 {{l('Users', [], 'layouts')}}
                            </a>
                        </li>
                        @endif
                        <li class="divider"></li>

                        <li>
                            <a href="{{{ URL::to('auth/logout') }}}">
                                <i class="fa fa-power-off"></i> {{l('Logout', [], 'layouts')}}
                            </a>
                        </li>
                    </ul>
                </li>
                @else
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <a href="{{{ URL::to('auth/login') }}}">
                    <button class="btn btn-default navbar-btn">
                        <i class="fa fa-user"></i> {{l('Login', [], 'layouts')}} 
                    </button>
                </a>
                    @if( isset($languages) )
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-language"></i> {{ \App\Context::getContext()->language->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($languages as $language)
                                <li>
                                    <a href="{{ URL::to('language/'.$language->id) }}">
                                         {{$language->name}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endif
            </ul>
        </nav>
    </div>
</nav>