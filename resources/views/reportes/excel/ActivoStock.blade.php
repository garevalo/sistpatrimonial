<html>

<table>
	<tr align="center">
		<td></td>
		<td colspan="11"><h3>Reporte de activos en stock</h3></td>
	</tr>	
</table>

<table border="1" cellpadding="2" cellspacing="0" width="100%" style="font-size: 7">
	
	<tr>
		<th></th>
		<th>Tipo</th>
		<th >Marca</th>
		<th >Modelo /<br>Arquitectura</th>
		<th >Num. Serie</th>
		<th >Código Inventario</th>
		<th>Código Patrimonial</th>
		<th >Fecha de Adquisición</th>
		<th>Descripción</th>
	</tr>
	

	<tbody>
	@foreach( $data as $key => $val )
		<tr>
			<td>{{$key+1}}</td>
			<td>{{ ($val->tipo_hardware)? $val->tipo_hardware : $val->tipo_software }}</td>
			<td>{{ ($val->tipo_hardware)? $val->marca : $val->nombre_software }}</td>
			<td>{{ ($val->tipo_hardware) ? $val->modelo : $val->arquitectura }}</td>
			<td>{{ $val->num_serie }}</td>
			<td>{{$val->cod_inventario}}</td>
			<td>{{$val->codigo_patrimonial }}</td>
			<td>{{ ($val->tipo_hardware) ? $val->fecha_adquisicion : $val->fa_software  }}</td>
			<td>{{$val->descripcion}}</td>
		</tr>
	@endforeach

	</tbody>
</table>

</html>