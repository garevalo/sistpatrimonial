<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

    
    {{--
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
    </form>
    <!-- /.search form -->
    --}}
    <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li></li>
            <li class="treeview @if(in_array(request()->getRequestUri(),['/bien','/catalogo'])) active @endif ">
                <a href="/hardware">
                    <i class="fa fa-archive"></i> <span>Almacén</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->getRequestUri()=='/bien') active @endif"><a href="/bien"><i class="fa fa-circle-o text-aqua"></i> Bienes</a></li>
                    <li class="@if(request()->getRequestUri()=='/catalogo') active @endif"><a href="/catalogo"><i class="fa fa-folder-open text-aqua"></i> Calálogo</a></li>
                </ul>
            </li>
            <li class="treeview @if(in_array(request()->getRequestUri(),['/cargo','/gerencia','/subgerencia','/marca','/modelo','/adquisicion','/personal','/color'])) active @endif ">
                <a href="#">
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Módulo Mantenimientos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->getRequestUri()=='/gerencia') active @endif"><a href="/gerencia"><i class="fa fa-circle-o text-aqua"></i> Gerencias</a></li>
                    <li class="@if(request()->getRequestUri()=='/subgerencia') active @endif"><a href="/subgerencia"><i class="fa fa-circle-o text-aqua"></i> Subgerencia</a></li>
                    <li class="@if(request()->getRequestUri()=='/marca') active @endif"><a href="/marca"><i class="fa fa-circle-o text-aqua"></i> Marca</a></li>
                    <li class="@if(request()->getRequestUri()=='/modelo') active @endif"><a href="/modelo"><i class="fa fa-circle-o text-aqua"></i> Modelo</a></li>
                    <li class="@if(request()->getRequestUri()=='/color') active @endif"><a href="/color"><i class="fa fa-circle-o text-aqua"></i> Color</a></li>
                    <li class="@if(request()->getRequestUri()=='/adquisicion') active @endif"><a href="/adquisicion"><i class="fa fa-circle-o text-aqua"></i> Adquisición</a></li>
                    <li class="@if(request()->getRequestUri()=='/personal') active @endif"><a href="/personal"><i class="fa fa-circle-o text-aqua"></i> Personal</a></li>
                    <li class="@if(request()->getRequestUri()=='/cargo') active @endif"><a href="/cargo"><i class="fa fa-circle-o text-aqua"></i> Cargo</a></li>
                </ul>
            </li>

            <li class="">
                <a href="#">
                    <i class="fa fa-exchange"></i>
                    <span>Solicitar Equipo</span>
                </a>
            </li>
            
            <li class="treeview @if(in_array(request()->getRequestUri(),['/rol','/usuario'])) active @endif ">
                <a href="#">
                    <i class="fa fa-user-plus"></i>
                    <span>Módulo Usuarios</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->getRequestUri()=='/rol') active @endif"><a href="/rol"><i class="fa  fa-user-secret text-aqua"></i> Roles</a></li>
                    <li class="@if(request()->getRequestUri()=='/usuario') active @endif"><a href="/usuario"><i class="fa fa-user text-aqua"></i> Usuario</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>