@extends('back.app')

@section('title')Ver Bien @endsection


@section('content')

<section class="invoice">

        	<div class="col-sm-6 invoice-col">


        	<div class="box-body box-profile">

              <h3 class="profile-username">Detalles del Pedido</h3>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Solicitante</b> <a class="pull-right">{{$pedido->centroCostoSolicitante->codcentrocosto .' - '. $pedido->centroCostoSolicitante->centrocosto}}</a>
                </li>
                <li class="list-group-item">
                  <b>Destino</b> <a class="pull-right">{{ $pedido->CentroCostoDestino->codcentrocosto .' - '.$pedido->CentroCostoDestino->centrocosto }}</a>
                </li>
                <li class="list-group-item">
                  <b>Responsable</b> <a class="pull-right">{{$pedido->PersonalResponsable->FullName}}</a>
                </li>
                <li class="list-group-item">
                  <b>Estado</b> <a class="pull-right"> @if($pedido->estado_pedido==1) Solicitado @else Atendido @endif</a>
                </li>
                <li class="list-group-item">
                  <b>Descripción</b> <a class="pull-right"></a>
                </li>
              </ul>
        </div>
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
        	<div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Bienes Solicitados</h3>
            </div>
          <table class="table table-striped table-condensed table-bordered">
            <thead>
            <tr>
              <th></th>
              <th>Cantidad</th>
              <th>Unidad</th>
              <th>Descripcion</th>
              <th></th>
              
            </tr>
            </thead>
            <tbody>
            	@foreach($pedido->articulo as $articulo)
            	<tr>
            		<td></td>
            		<td>{{ $articulo->cantidad}}</td>
            		<td>{{ $articulo->unidad}}</td>
            		<td>{{ $articulo->descripcion}}</td>
            		<td>{{ $articulo->estado_articulo}}</td>
            	</tr>
            	@endforeach
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      </div>
    </section>

@endsection
