<style>
   .table tr td{
    	padding: 5px 5px 5px 10px;
    	font-size: 11px;
    }
</style>

<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse: collapse;" class="table">
	
	<tbody>
		<tr><td colspan="6" style="text-align: center;font-weight: bold;background-color: skyblue;">FICHA DE REGISTO</td></tr>
		<tr style="
">
			<td colspan="2" style="width: 20%">Investigador</td>
			<td colspan="2">SANCHEZ AGAPITO, PEDRO KENNEDY</td>
			<td colspan="2">Datos recopilados de la empresa</td>
		</tr>
		<tr>
			<td colspan="2">Empresa donde se investiga</td>
			<td colspan="4">MUNICIPALIDAD DISTRITAL DE COMAS</td>
		</tr>
		<tr>
			<td colspan="2">DIRECCIÓN</td>
			<td colspan="4">PZA PLAZA DE ARMAS NRO. S/N (KM 11 TÚPAC AMARU) LIMA - COMAS</td>
		</tr>
		<tr>
			<td colspan="2">MOTIVO DE INVESTIGACIÓN</td>
			<td colspan="4">NIVEL DE EXACTITUD DE INVENTARIO</td>
		</tr>
		<tr>
			<td colspan="2">FECHA DE INICIO</td>
			<td></td>
			<td>FECHA FINAL</td>
			<td colspan="2"></td>
		</tr>
		<tr style="
    background-color: skyblue;
    font-size: 14px;
    text-align: center;
    font-weight: bold;
">
			<td colspan="2">VARIABLE</td>
			<td colspan="2">INDICADOR</td>
			<td>MEDIDA</td>
			<td>FÓRMULA</td>
		</tr>
		<tr style="
    text-align: center;
    /* padding: 5px 5px 5px 10px; */
">
			<td colspan="2" style="
    padding: 15px;
    /* font-size: 14px; */
">CONTROL DE BIENES PATRIMONIALES</td>
			<td colspan="2">NIVEL DE EXACTITUD DE INVENTARIO</td>
			<td>UNIDAD</td>
			<td>EXI = (N.R / U.A) * 100% </td>
		</tr>
		<tr style="
    text-align: center;
">
<td colspan="2"></td><td colspan="2">Pre Test</td>
<td colspan="2"></td></tr>
		<tr style="text-align: center;">
			<td rospan="2" style="width: 1%;">Item</td>
			<td>Fecha</td>
			<td>Número De Referencia (NR)</td>
			<td>Unidad Almacenada (UA)</td>	
			<td colspan="2">Nivel de Cumplimiento de Entrega</td>
		</tr>
				@php 
					$talmacenadas = 0; $treferencia = 0;
				@endphp

				@foreach($conteo as $key=> $item)
				@php 

				$talmacenadas = $talmacenadas + $item->almacenada;
				$treferencia  = $treferencia + $item->referencia;
				@endphp

				<tr style="text-align: center;">
					<td>{{$key + 1 }}</td>
					<td>{{$item->fecha}}</td>
					<td>{{$item->referencia}}</td>
					<td>{{$item->almacenada}}</td>
					<td colspan="2"> @if($item->almacenada > 0 ) {{ round(($item->referencia / $item->almacenada) * 100 , 2)  }} @else 0 @endif </td>
				</tr>
				@endforeach

				<tr style="text-align: center;">
					<td colspan="2">Total de bienes</td>
					<td>{{ $treferencia }}</td>
					<td>{{ $talmacenadas }}</td>
					<td colspan="2" style="text-align: center;">@if($talmacenadas > 0 ) {{ round(($treferencia / $talmacenadas ) * 100 , 2)  }} @else 0 @endif % </td>
				</tr>
			</tbody>

</table>