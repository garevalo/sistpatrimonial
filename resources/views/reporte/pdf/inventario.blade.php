

<style type="text/css">
	table {
		font-size: 11px;
	}
</style>
<h3 style="text-align: center;">Inventario Año {{$year}}</h3>
<div class="panel panel-info">
  <div class="panel-heading"><h4>Bienes Conciliados</h4></div>
  
    <table class="table table-condensed table-bordered table-striped" border="1" cellpadding="5" cellspacing="0" width="100%">
	    <tr class="warning">
	    	<td></td>
	    	<td><strong>Cod.CC</strong></td>
	        <td><strong>Centro Costo</strong></td>
	        <td><strong>Bien</strong></td>
	        <td><strong>Cod. Patrimonial</strong></td>
	    </tr>
	    <tbody>
	   	 @foreach($resultConciliado as $key => $conciliado )
	    	<tr>
	    		<td>{{ $key+1 }}</td>
	    		<td>{{ $conciliado->inventario->centrocosto}}</td>
	    		<td>{{ $conciliado->inventario->CentroCosto->centrocosto}}</td>
	    		<td>{{ $conciliado->bien->catalogo->denom_catalogo }} </td>
	    		<td>{{ $conciliado->bien->codpatrimonial }}</td>
	    	</tr>
	    @endforeach 	
	    </tbody>
	</table>

</div>
<br>
<div class="panel panel-danger">
  <div class="panel-heading"><h4>Bienes Faltantes</h4></div>
  
    <table class="table table-condensed table-bordered table-striped" border="1" cellpadding="5" cellspacing="0" width="100%">
	    <tr class="warning">
	    	<td></td>
	    	<td><strong>Cod.CC</strong></td>
	        <td><strong>Centro Costo</strong></td>
	        <td><strong>Bien</strong></td>
	        <td><strong>Cod. Patrimonial</strong></td>
	    </tr>
	    <tbody>
	   	 @foreach($resultFaltante as $key => $conciliado )
	    	<tr>
	    		<td>{{ $key+1 }}</td>
	    		<td>{{ $conciliado->inventario->centrocosto}}</td>
	    		<td>{{ $conciliado->inventario->CentroCosto->centrocosto}}</td>
	    		<td>{{ $conciliado->bien->catalogo->denom_catalogo }} </td>
	    		<td>{{ $conciliado->bien->codpatrimonial }}</td>
	    	</tr>
	    @endforeach 	
	    </tbody>
	</table>

</div>