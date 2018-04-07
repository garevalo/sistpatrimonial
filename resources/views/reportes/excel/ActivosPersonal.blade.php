<html>

<table>
	<tr align="center">
		<td colspan="8" ><h3>Reporte de activos por personal</h3></td>
	</tr>	
</table>

<table border="1" cellpadding="2" cellspacing="0" width="100%" style="font-size: 8">
	
	<tr>
		<th width="5%"></th>
		<th>Personal</th>
		<th>Sede</th>
		<th>Gerencia</th>
		<th>Sub Gerencia</th>
		<th>Activo</th>
		<th>Fecha Asignación</th>
		<th>Descripción</th>
	</tr>
	

	<tbody>
	@foreach( $data as $key => $val )
		<tr>
			<td>{{$key+1}}</td>
			<td>{{$val->nombres .' '.$val->apellido_paterno.' '.$val->apellido_materno}}</td>
			<td>{{$val->sede}}</td>
			<td>{{$val->gerencia}}</td>
			<td>{{$val->subgerencia}}</td>
			<td> @if($val->software) {{ $val->software}} @else {{$val->hardware }} @endif </td>
			<td>{{$val->fecha_asignacion}}</td>
			<td>{{$val->descripcion}}</td>
		</tr>
	@endforeach

	</tbody>
</table>

</html>