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
            <li class="treeview">
                <a href="/hardware">
                    <i class="fa fa-archive"></i> <span>Almacén</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->getRequestUri()=='/bien') active @endif"><a href="/bien"><i class="fa fa-circle-o"></i> Bienes</a></li>
                </ul>
            </li>
            <li class="treeview @if(in_array(request()->getRequestUri(),['/cargo','/sede','/gerencia','/subgerencia','/personal','/tiposoftware','/tipohardware'])) active @endif ">
                <a href="#">
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Módulo Mantenimientos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->getRequestUri()=='/gerencia') active @endif"><a href="/gerencia"><i class="fa fa-circle-o"></i> Gerencias</a></li>
                    <li class="@if(request()->getRequestUri()=='/subgerencia') active @endif"><a href="/subgerencia"><i class="fa fa-circle-o"></i> Subgerencia</a></li>
                    <li class="@if(request()->getRequestUri()=='/personal') active @endif"><a href="/personal"><i class="fa fa-circle-o"></i> Personal</a></li>
                    <li class="@if(request()->getRequestUri()=='/rol') active @endif"><a href="/rol"><i class="fa fa-circle-o"></i> Roles</a></li>
                    <li class="@if(request()->getRequestUri()=='/usuario') active @endif"><a href="/usuario"><i class="fa fa-circle-o"></i> Usuario</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>