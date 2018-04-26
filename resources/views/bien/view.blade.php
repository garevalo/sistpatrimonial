@extends('back.app')

@section('title')Ver Bien @endsection


@section('content')

<section class="invoice">
		{{dump($bien)}}
      <div class="row invoice-info">
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
          {{$bien->centrocostos}}
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
          <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Serial #</th>
              <th>Description</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>Call of Duty</td>
              <td>455-981-221</td>
              <td>El snort testosterone trophy driving gloves handsome</td>
              <td>$64.50</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Need for Speed IV</td>
              <td>247-925-726</td>
              <td>Wes Anderson umami biodiesel</td>
              <td>$50.00</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Monsters DVD</td>
              <td>735-845-642</td>
              <td>Terry Richardson helvetica tousled street art master</td>
              <td>$10.70</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Grown Ups Blue Ray</td>
              <td>422-568-642</td>
              <td>Tousled lomo letterpress</td>
              <td>$25.99</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      </div>
    </section>

@endsection
