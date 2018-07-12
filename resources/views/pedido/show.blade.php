@extends('back.app')

@section('title')Ver Pedido @endsection


@section('content')

<section class="invoice">

        	<div class="col-sm-12 invoice-col">


        	<div class="box-body box-profile">

              <h3 class="profile-username">Detalles del Pedido</h3>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Solicitante</b> <p class="pull-right">{{$pedido->centroCostoSolicitante->codcentrocosto .' - '. $pedido->centroCostoSolicitante->centrocosto}}</p>
                </li>
                <li class="list-group-item">
                  <b>Destino</b> <p class="pull-right">{{ $pedido->CentroCostoDestino->oficina }}</p>
                </li>
                <li class="list-group-item">
                  <b>Responsable</b> <p class="pull-right">{{$pedido->PersonalResponsable->FullName}}</p>
                </li>
                <li class="list-group-item">
                  <b>Estado</b> <p class="pull-right"> 
                    @if($pedido->estado_pedido==1) 
                    <label class="label label-warning">Solicitado</label> 
                    @else 
                    <label class="label label-success">Atendido </label>
                    @endif
                    </p>
                </li>
                <li class="list-group-item">
                  <b>Descripción</b> <p class="pull-right">
                    {{$pedido->descripcion}}
                  </p>

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
              <th>Descripcion</th>
              <th>Cod. Patrimonial</th>
              <th>Estado</th>
              
            </tr>
            </thead>
            <tbody>
            	@foreach($pedido->articulo as $articulo)
            	<tr>
            		<td></td>
            		<td>{{ $articulo->bien->catalogo->denom_catalogo}}</td>
                <td>{{ $articulo->bien->codpatrimonial }}</td>
            		<td>{!! ($articulo->estado_articulo==2)? '<label class="label label-success">'.$estadoarticulo[$articulo->estado_articulo].'</label>': '<label class="label label-warning">'.$estadoarticulo[$articulo->estado_articulo].'</label>'  !!}</td>
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
