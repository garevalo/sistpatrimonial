@extends('back.app')

@section('title','Registrar '. ucwords($titulomod))

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Registrar {{ucwords($titulomod)}}</h3>
        </div>
        {!! Form::model($table, ['route' => $modulo.'.store']) !!}
            <div class="box-body">

                <div class="col-xs-12">
                    {{ Form::selectfield('cc_solicitante','Dependencia Solicitante',$centrocostos,'Seleccione Centro Costo') }}

                    {{ Form::selectfield('cc_destino','Con Destino a',$centrocostos,'Seleccione Centro Costo') }}

                    {{ Form::selectfield('responsable','Entregar a',$personales,'Seleccione Personal') }}
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
                                    <th><button class="btn btn-xs btn-primary" id="agregar" type="button"><i class="fa fa-plus-circle"></i> Agregar  </button></th>
                                </thead>
                                <tbody>
                                    <tr> 
                                        <td><input type="number" name="cantidad[]" required=""  class="form-control input-sm"></td> 
                                        <td> <input type="text" name="umedida[]" value="Unidad" required="" class="form-control input-sm"> </td>
                                        <td> <input type="text" name="descripcion[]" required="" class="form-control input-sm"> </td>
                                    </tr>
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
                                        '<td> <input type="text" name="descripcion[]" required="" class="form-control input-sm descripcion"> </td>'+
                                        '<td><button type="button" class="btn btn-xs btn-danger eliminar"><i class="fa fa-trash"></i> Eliminar</button></td>'+
                                    '</tr>');
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
        },
        templateResult: formatRepo,
    });

    function formatRepo (repo) {
      //if (repo.loading) {
        $("#codpatrimonial").val(repo.id);
        return repo.text;
      //}
    }

</script>

@endsection