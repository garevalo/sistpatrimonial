<style>
   .table tr td{
    	padding: 5px 5px 5px 10px;
    	font-size: 11px;
    }
</style>


<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse: collapse;" class="table">
	
	<tbody>
		<tr><td colspan="6" style="text-align: center;background-color: skyblue;">FICHA DE REGISTO</td></tr>
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
			<td colspan="4">NIVEL DE CUMPLIMIENTO DE ENTREGA</td>
		</tr>
		<tr>
			<td colspan="2">FECHA DE INICIO</td>
			<td style="text-align: center;">{{$data['desde']}}</td>
			<td>FECHA FINAL</td>
			<td colspan="2" style="text-align: center;">{{$data['hasta']}}</td>
		</tr>
		<tr style="background-color: skyblue; font-size: 14px; text-align: center;">
			<td colspan="2">VARIABLE</td>
			<td colspan="2">INDICADOR</td>
			<td>MEDIDA</td>
			<td>FÓRMULA</td>
		</tr>
		<tr style="text-align: center;">
			<td colspan="2" style="padding: 15px;">CONTROL DE BIENES PATRIMONIALES</td>
			<td colspan="2">NIVEL DE CUMPLIMIENTO DE ENTREGA</td>
			<td>UNIDAD</td>
			<td>NCE = P.E <strong>/</strong> P.S </td>
		</tr>
		<tr style="text-align: center; background-color:skyblue;">
			<td style="width: 1%;"><p>Item</p></td>
			<td>Fecha</td>
			<td>Pedidos Entregados (PE)</td>
			<td>Pedidos Solicitados (PS)</td>	
			<td colspan="2">Nivel de Cumplimiento de Entrega</td>
		</tr>
				@php 
					$tentregados = 0; $tsolicitados = 0;
				@endphp
				@foreach($pedidos as $key=> $item)

				@php 
				$tentregados   = $tentregados + $item->entregados;
				$tsolicitados  = $tsolicitados + $item->solicitados;
				@endphp

				<tr style="text-align: center;">
					<td>{{$key + 1 }}</td>
					<td>{{$item->fecha}}</td>
					<td>{{ $item->entregados }}</td>
					<td>{{$item->solicitados}}</td>
					<td colspan="2"> @if($item->solicitados > 0 ) {{ round(($item->entregados / $item->solicitados) * 100 , 2)  }} @else 0 @endif </td>
				</tr>
				@endforeach

				<tr style="text-align: center;">
					<td colspan="2">TOTAL DE BIENES</td>
					<td>{{ $tentregados }}</td>
					<td>{{ $tsolicitados }}</td>
					<td colspan="2"> @if($tsolicitados > 0 ) {{ round(($tentregados / $tsolicitados) * 100 , 2)  }} @else 0 @endif %</td>
				</tr>
			</tbody>

</table>