<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{asset('dist/img/avatar3.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            @if(Auth::check())
            <p>{{Auth::user()->name}}</p>
            @endif
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
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
            <li>
                <a href="/hardware">
                    <i class="fa fa-laptop"></i> <span>Módulo de Hardware</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            <li>
                <a href="/software">
                    <i class="fa fa-windows"></i> <span>Módulo de Software</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            <li>
                <a href="/activo">
                    <i class="fa fa-send-o"></i> <span>Módulo de Asignación</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <li>
                <a href="/activo/seguimiento">
                    <i class="fa fa-tasks"></i> <span>Módulo de Seguimiento</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            @if(Auth::check())
            @if(Auth::user()->idrol == 1 )
            <li class="treeview @if(in_array(request()->getRequestUri(),['/reporte'])) active @endif ">
                <a href="/activo">
                    <i class="fa fa-pie-chart"></i> <span>Módulo de Reportes</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->getRequestUri()=='/reporte1') active @endif" ><a href="{{url('reporte/licenciaspagadas')}}"><i class="fa fa-file-pdf-o"></i> Licencias Pagadas</a></li>
                    <li class="@if(request()->getRequestUri()=='/reporte2') active @endif"><a href="{{url('reporte/activosobsoletos')}}"><i class="fa fa-file-pdf-o"></i> Activos Obsoletos</a></li>
                    <li class="@if(request()->getRequestUri()=='/reporte3') active @endif"><a href="{{url('reporte/activos/operativos')}}"><i class="fa fa-file-pdf-o"></i> Activos Operativos</a></li>

                    <li class="@if(request()->getRequestUri()=='/reporte4') active @endif"><a href="{{url('reporte/activos/inoperativos')}}"><i class="fa fa-file-pdf-o"></i> Activos Inoperativos</a></li>

                    <li class="@if(request()->getRequestUri()=='/reporte5') active @endif"><a href="{{url('reporte/activos/vencidos')}}"><i class="fa fa-file-pdf-o"></i> Activos Vencidos</a></li>
                    <li class="@if(request()->getRequestUri()=='/reporte6') active @endif"><a href="{{url('reporte/activos/personal')}}"><i class="fa fa-file-pdf-o"></i> Activos Personal</a></li>

                    <li class="@if(request()->getRequestUri()=='/reporte7') active @endif"><a href="{{url('reporte/activos/stock')}}"><i class="fa fa-file-pdf-o"></i> Activos Stock</a></li>
                </ul>
            </li>
            @endif
            @endif
            <li class="treeview @if(in_array(request()->getRequestUri(),['/cargo','/sede','/gerencia','/subgerencia','/personal','/tiposoftware','/tipohardware'])) active @endif ">
                <a href="#">
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Módulo Mantenimientos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->getRequestUri()=='/cargo') active @endif" ><a href="/cargo"><i class="fa fa-circle-o"></i> Cargo</a></li>
                    <li class="@if(request()->getRequestUri()=='/sede') active @endif"><a href="/sede"><i class="fa fa-circle-o"></i> Sedes</a></li>
                    <li class="@if(request()->getRequestUri()=='/gerencia') active @endif"><a href="/gerencia"><i class="fa fa-circle-o"></i> Gerencias</a></li>
                    <li class="@if(request()->getRequestUri()=='/subgerencia') active @endif"><a href="/subgerencia"><i class="fa fa-circle-o"></i> Subgerencia</a></li>
                    <li class="@if(request()->getRequestUri()=='/personal') active @endif"><a href="/personal"><i class="fa fa-circle-o"></i> Personal</a></li>
                    <li class="@if(request()->getRequestUri()=='/tiposoftware') active @endif"><a href="/tiposoftware"><i class="fa fa-circle-o"></i> Tipo Software</a></li>
                    <li class="@if(request()->getRequestUri()=='/tipohardware') active @endif"><a href="/tipohardware"><i class="fa fa-circle-o"></i> Tipo Hardware</a></li>
                    <li class="@if(request()->getRequestUri()=='/rol') active @endif"><a href="/rol"><i class="fa fa-circle-o"></i> Roles</a></li>
                    <li class="@if(request()->getRequestUri()=='/usuario') active @endif"><a href="/usuario"><i class="fa fa-circle-o"></i> Usuario</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>