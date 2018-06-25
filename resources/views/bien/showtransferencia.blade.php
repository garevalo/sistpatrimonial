@extends('back.app')

@section('title')Ver Transferencia @endsection


@section('content')

<section class="invoice">

      <div class="row invoice-info">

        <div class="box-body">
        	<div class="col-sm-12 invoice-col">
            <h3 class="profile-username"> <i class="fa fa-tag"></i> Detalles del Pedido</h3>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Centro Costo Origen:</b> <p class="pull-right">{{$transferencia->CentrocostoOrigen->centrocosto}}</p>
                </li>
                <li class="list-group-item">
                  <b>Centro Costo Destino</b> <p class="pull-right"> {{$transferencia->CentrocostoDestino->centrocosto}}</p>
                </li>
                <li class="list-group-item">
                  <b>Personal Origen:</b> <p class="pull-right">{{$transferencia->PersonalOrigen->FullName}}</p>
                </li>
                <li class="list-group-item">
                  <b>Personal Destino:</b> <p class="pull-right"> {{$transferencia->PersonalDestino->FullName}}</p>
                </li>
              </ul>
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
              <th class="text text-primary">Codigo Patrimonial</th>
              <th class="text text-primary">Bien</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transferencia->movimiento as $movimiento)
            <tr>
            	<td>{{$movimiento->bien->codpatrimonial}}</td>
            	<td>{{$movimiento->bien->catalogo->denom_catalogo}}</td>
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
