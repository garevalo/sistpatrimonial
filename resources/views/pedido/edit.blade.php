@extends('back.app')

@section('title','Atender '. ucwords($titulomod))

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Atender {{ucwords($titulomod)}}</h3>
        </div>
        {!! Form::model($table, ['route' => ['pedido.update',$table->idpedido]] ) !!}
            <div class="box-body">
                <div class="col-xs-12">
                    {{ Form::selectfield('cc_solicitante','Dependencia Solicitante',$centrocostos,'Seleccione Centro Costo',$table->centroCostoSolicitante->codcentrocosto,[]) }}

                    {{ Form::selectfield('cc_destino','Con Destino a',$centrocostos,'Seleccione Centro Costo',$table->CentroCostoDestino->codcentrocosto,[]) }}

                    {{ Form::selectfield('responsable','Entregar a',$personales,'Seleccione Personal',$table->PersonalResponsable->idpersonal,[]) }}

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
                                    <th width="65%">Articulos Solicitados</th>
                                </thead>
                                <tbody>
                                    @foreach($table->articulo as $articulo)
                                    <tr> 
                                        <td> <select type="text" name="descripcion[]" required="" class="form-control input-sm descripcion" ></select> </td>
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
                <button class="btn btn-sm btn-primary" type="button">Editar</button>
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
<script type="text/javascript">
    $(function(){
            $("body").on("click",".eliminar",function(){
                     $(this).parents("tr").remove();
                });

            $("body").on("click","#agregar",function(){
                     $("#articulos tbody").append('<tr>'+
                                        '<td> <select class="form-control input-sm descripcion" name="descripcion[]"  required > </select></td>'+
                                        '<td><button type="button" class="btn btn-xs btn-danger eliminar"><i class="fa fa-trash"></i> Eliminar</button></td>'+
                                    '</tr>');


                     $('.descripcion').select2({
                        language: "es",
                        minimumInputLength: 2,
                        ajax: {
                            url:  "{{route('bienitems')}}",
                            delay: 250,
                            dataType: 'json',
                            data: function(params) {
                                return {
                                    term: params.term
                                }
                            },
                            results: function (data) {
                                return {
                                    results: $.map(data, function (item) {
                                        return {
                                            text: item.text,
                                            id: item.id
                                        }
                                    })
                                };
                            }
                        }
                    });

                });
                               
    });
</script>

<script src="{{asset('plugins/select2//select2.full.min.js')}}"></script>

<script>
    
    $(".descripcion").select2({
        language: "es",
        minimumInputLength: 2,
        ajax: {
            url:  "{{route('bienitems')}}",
            delay: 250,
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term
                }
            },
            results: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.text,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
</script>

@endsection