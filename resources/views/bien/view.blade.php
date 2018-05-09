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

	        </div>
	        <!-- /.col -->
	        <div class="col-sm-4 invoice-col">
	          <strong>Centro Costo:</strong>
	          {{$bien->centrocostos->codcentrocosto.'-'.$bien->centrocostos->centrocosto}}
	          <br>
	          <strong>modelo:</strong>
	          {{$bien->modelo->modelo}}
	          <br>
	          <strong>Cod. Patrimonial:</strong>
	          {{$bien->codpatrimonial}}

	          <br>
	          <strong>Orden Compra:</strong>
	          {{$bien->ordencompra}}
	        </div>
	        <!-- /.col -->
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
	          <img class="img img-rounded" src="{{$bien->imagen}}" width="120" height="100"> 
	        </div>	

        </div>
        

      </div>
      <!-- /.row -->
      <br><br>
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
              <th>Centro costo</th>
              <th>Personal</th>
              <th>Fecha Movimiento</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bien->movimientos as $movimiento)
            <tr>
            	<td>{{$movimiento->centrocosto}}</td>
            	<td>{{$movimiento->idpersonal}}</td>
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
