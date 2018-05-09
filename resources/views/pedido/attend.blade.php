@extends('back.app')

@section('title','Atender '. ucwords($titulomod))

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Atender {{ucwords($titulomod)}}</h3>
        </div>
        {!! Form::model($table, ['route' => $modulo.'.store']) !!}
            <div class="box-body">
                <div class="col-xs-12">
                    {{ Form::selectfield('cc_solicitante','Dependencia Solicitante',$centrocostos,'Seleccione Centro Costo',$table->centroCostoSolicitante->codcentrocosto,['disabled'=>'disabled']) }}

                    {{ Form::selectfield('cc_destino','Con Destino a',$centrocostos,'Seleccione Centro Costo',$table->CentroCostoDestino->codcentrocosto,['disabled'=>'disabled']) }}

                    {{ Form::selectfield('responsable','Entregar a',$personales,'Seleccione Personal',$table->PersonalResponsable->idpersonal,['disabled'=>'disabled']) }}

                    {{ Form::selectfield('estado','Estado',$centrocostos,'Seleccione Centro Costo',$table->centroCostoSolicitante->codcentrocosto) }}
                    {{Form::textfield('fecha_entrega','Fecha de Entrega','',["data-inputmask"=>"alias: dd/mm/yyyy", "data-mask"=>"" ])}}
                    {{Form::textfield('descripcion','Descripción')}}
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
                                    <th width="80%">Articulos Solicitados</th>
                                </thead>
                                <tbody>
                                	@foreach($table->articulo as $articulo)
                                    <tr> 
                                        <td><input type="number" name="cantidad[]" required=""  class="form-control input-sm" value="{{$articulo->cantidad}}" disabled></td> 
                                        <td> <input type="text" name="umedida[]" value="Unidad" required="" class="form-control input-sm" value="{{$articulo->umedida}}" disabled> </td>
                                        <td> <input type="text" name="descripcion[]" required="" class="form-control input-sm" value="{{$articulo->descripcion}}" disabled> </td>
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

    <script>
        $(function () {
            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            //Money Euro
            $("[data-mask]").inputmask();
        });
    </script>
@endsection