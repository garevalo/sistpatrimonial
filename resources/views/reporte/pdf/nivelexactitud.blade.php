<style>
   .table tr td{
    	padding: 5px 5px 5px 10px;
    	font-size: 11px;
    }
</style>

<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse: collapse;" class="table">
	
	<tbody>
		<tr><td colspan="6" style="text-align: center;font-weight: bold;background-color: skyblue;">FICHA DE REGISTO</td></tr>
		<tr style="">
			<td colspan="2" style="width: 25%">Investigador</td>
			<td colspan="2">SANCHEZ AGAPITO, PEDRO KENNEDY</td>
			<td style="background-color: skyblue;">TIPO DE PRUEBA</td>
			<td>POST-TEST</td>
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
			<td style="text-align: center;">{{$data['desde']}}</td>
			<td>FECHA FINAL</td>
			<td colspan="2" style="text-align: center;">{{$data['hasta']}}</td>
		</tr>
		<tr style="background-color: skyblue;font-size: 14px;text-align: center;font-weight: bold;">
			<td colspan="2">VARIABLE</td>
			<td colspan="2">INDICADOR</td>
			<td>MEDIDA</td>
			<td>FÓRMULA</td>
		</tr>
		<tr style="text-align: center;">
			<td colspan="2" style="padding: 15px;">CONTROL DE BIENES PATRIMONIALES</td>
			<td colspan="2">NIVEL DE EXACTITUD DE INVENTARIO</td>
			<td>UNIDAD</td>
			<td>NEI = N.R / U.A</td>
		</tr>
		<tr style="text-align: center; background-color: skyblue">
			<td style="width: 1%;">Ítem</td>
			<td>Fecha</td>
			<td>Código de Centro de Costo</td>
			<td>Número De Referencia (NR)</td>
			<td>Unidad Almacenada (UA)</td>	
			<td>NIVEL DE EXACTITUD DE INVENTARIO</td>
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
					<td>{{ date('d/m/Y',strtotime($item->fecha)) }}</td>
					<td>{{ $item->centro_costos }}</td>
					<td>{{$item->referencia}}</td>
					<td>{{$item->almacenada}}</td>
					<td> @if($item->almacenada > 0 ) {{ round(($item->referencia / $item->almacenada) , 2)  }} @else 0 @endif </td>
				</tr>
				@endforeach

				<tr style="text-align: center;">
					<td colspan="3">TOTAL, DE BIENES</td>
					<td>{{ $treferencia }}</td>
					<td>{{ $talmacenadas }}</td>
					<td style="text-align: center;">@if($talmacenadas > 0 ) {{ round(($treferencia / $talmacenadas ) * 100 , 2)  }} @else 0 @endif % </td>
				</tr>
			</tbody>

</table>