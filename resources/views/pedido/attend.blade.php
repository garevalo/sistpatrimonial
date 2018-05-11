@extends('back.app')

@section('title','Atender '. ucwords($titulomod))

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Atender {{ucwords($titulomod)}}</h3>
        </div>
        {!! Form::model($table, ['route' => ['atencion.store',$table->idpedido]] ) !!}
            <div class="box-body">
                <div class="col-xs-12">
                    {{ Form::selectfield('cc_solicitante','Dependencia Solicitante',$centrocostos,'Seleccione Centro Costo',$table->centroCostoSolicitante->codcentrocosto,['disabled'=>'disabled']) }}

                    {{ Form::selectfield('cc_destino','Con Destino a',$centrocostos,'Seleccione Centro Costo',$table->CentroCostoDestino->codcentrocosto,['disabled'=>'disabled']) }}

                    {{ Form::selectfield('responsable','Entregar a',$personales,'Seleccione Personal',$table->PersonalResponsable->idpersonal,['disabled'=>'disabled']) }}

                    {{ Form::selectfield('estado','Estado',$estados,'Seleccione Estados',$table->estado_pedido) }}
                    
                    {{Form::textfield('fecha_entrega','Fecha de Entrega',$table->FechaEntrega,["data-inputmask" => "'alias': 'dd/mm/yyyy'" ,"data-mask"=>"" ])}} 

                    {{Form::textfield('descripcion','Descripción',$table->descripcion)}}
                </div>

                <div class="col-xs-12">
                    <br><br>
                    <div class="box box-warning">
                        <div class="box-header">
                          <h3 class="box-title">Artículos Solicitados</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table id="articulos" class="table table-condensed table-striped table-responsive">
                                <thead>
                                    <th width="10%">Cantidad</th>
                                    <th width="10%">Unidad</th>
                                    <th width="65%">Articulos Solicitados</th>
                                    <th width="65%">Estado</th>
                                </thead>
                                <tbody>
                                	@foreach($table->articulo as $articulo)
                                    <tr> 
                                        <td><input type="number" name="cantidad[]" required=""  class="form-control input-sm" value="{{$articulo->cantidad}}" disabled></td> 
                                        <td> <input type="text" name="umedida[]" value="Unidad" required="" class="form-control input-sm" value="{{$articulo->umedida}}" disabled> </td>
                                        <td> <input type="text" name="descripcion[]" required="" class="form-control input-sm" value="{{$articulo->descripcion}}" disabled> </td>
                                        <td>
                                            {{ Form::select('estado_articulo[]', $estadoarticulo , $articulo->estado_articulo, ['class'=> 'form-control input-sm']) }}
                                            <input type="hidden" name="idarticulo[]" value="{{ $articulo->idarticulos}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
               
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
    </div>

</div>



@endsection

@section('javascript')

@parent

<!-- InputMask -->
<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script>
    $(function () {
        
        $("[data-mask]").inputmask();
    });
</script>

<script type="text/javascript">
    $(function(){
            $("body").on("click",".eliminar",function(){
                     $(this).parents("tr").remove();
                });

            $("body").on("click","#agregar",function(){
                     $("#articulos tbody").append('<tr><td><input type="text" name="cantidad[]" required=""  class="form-control input-sm"></td>'+ 
                                        '<td> <input type="text" name="umedida[]" value="Unidad" required="" class="form-control input-sm"> </td>'+
                                        '<td> <input type="text" name="descripcion[]" required="" class="form-control input-sm"> </td>'+
                                        '<td><button type="button" class="btn btn-xs btn-danger eliminar"><i class="fa fa-trash"></i> Eliminar</button></td>'+
                                    '</tr>');
                });
                
                
            });
</script>

@endsection