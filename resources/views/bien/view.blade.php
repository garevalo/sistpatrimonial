@extends('back.app')

@section('title')Ver Bien @endsection


@section('content')

<section class="invoice">

      <div class="row invoice-info">
      	<div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i> Detalles del Bien</h3>
        </div>
        <div class="box-body">
        	<div class="col-sm-4 invoice-col">
	          <strong>Cod. Catálogo:</strong>
	          {{$bien->codcatalogo}}
	          <br>
	          <strong>Cod. Inventario:</strong>
	          {{$bien->codinventario}}
	          <br>
	          <strong>Cod. Patrimonial:</strong>
	          {{$bien->codpatrimonial}}

	          <br>
	          <strong>Orden Compra:</strong>
	          {{$bien->ordencompra}}
            <br>
            @if($bien->idestado == 1 ) 
                <h3><label class="label label-primary">Activo</label></h3>  
              @else 
                <h3><label class="label btn-block label-danger">De Baja</label></h3> 
            @endif
	        </div>
	        <!-- /.col -->
	        <div class="col-sm-4 invoice-col">
	          <strong>Centro Costo:</strong>
	          {{$bien->centrocostos->codcentrocosto.'-'.$bien->centrocostos->centrocosto}}
	          <br>
	          <strong>modelo:</strong>
	          {{$bien->modelo->modelo}}
	          <br>
	          <strong>Color:</strong>
	          {{$bien->color->color}}

	          <br>
	          <strong>Marca:</strong>
	          {{$bien->marca->marca}}
	        </div>
	        <!-- /.col -->
	        <div class="col-sm-4 invoice-col">
	          <strong>Num. Serie:</strong>
	          {{$bien->numserie}}
	          <br>
	          <strong>Proveedor:</strong>
	          {{$bien->proveedor->razon_social}}
	          <br>
	          <strong>Local:</strong>
	          {{$bien->local->local}}

	          <br>
	          <img class="img img-rounded" src="{{$bien->imagen}}" width="120" height="100"> 
	        </div>	

        </div>
      </div>

      @if($baja)
      <div class="row invoice-info">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i> Detalles de la baja</h3>
        </div>
        <div class="box-body">
          <div class="col-sm-6 invoice-col">
            <strong>Local:</strong>
            {{$baja->bien->local->local}}
            <br>
            <strong>Centro Costo:</strong>
            {{$baja->bien->centrocostos->centrocosto}}
            <br>
            <strong>Personal :</strong>
            {{$baja->bien->personal->FullName}}
            <br>
            <strong>Detalle de la baja:</strong>
            {{$baja->descripcion}}
            <br>
            <strong>Fecha de baja:</strong>
            {{$baja->fechabaja->format('d/m/Y')}}
          </div>

          <div class="col-sm-6 invoice-col">
            <img class="img img-rounded" src="{{$baja->imagen}}" width="120" height="100"> 
          </div>   

        </div>
      </div>
      <br><br>
      @endif

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
        	<div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Movimientos</h3>
            </div>
          <table class="table table-striped">
            <thead>
            <tr>
              <th class="text text-primary">Centro costo (Origen)</th>
              <th class="text text-primary">Personal (Origen)</th>
              <th class="text text-warning">Centro costo (Destino)</th>
              <th class="text text-warning">Personal (Destino)</th>
              <th>Fecha Movimiento</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bien->movimientos as $movimiento)
            <tr>
            	<td>{{ (!empty($movimiento->desde_centrocosto->centrocosto))? $movimiento->desde_centrocosto->centrocosto : ''  }}</td>
            	<td>{{ (!empty($movimiento->personal_origen->FullName))? $movimiento->personal_origen->FullName : '' }}</td>

            	<td>{{$movimiento->centrocosto_destino->centrocosto}}</td>
            	<td>{{$movimiento->personal->FullName}}</td>

            	<td>{{$movimiento->fecha_movimiento}}</td>
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
