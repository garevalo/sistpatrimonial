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
                    {{ Form::selectfield('cc_solicitante','Dependencia Solicitante',$centrocostos,'Seleccione Centro Costo','',["required"=>"required"]) }}

                    {{ Form::selectfield('cc_destino','Con Destino a (Oficina)',$oficinas,'Seleccione Oficina','',["required"=>"required"]) }}

                    {{ Form::selectfield('responsable','Entregar a',$personales,'Seleccione Personal','',["required"=>"required"]) }}
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
                                    <th width="80%">Articulos Solicitados</th>
                                    <th><button class="btn btn-xs btn-primary" id="agregar" type="button"><i class="fa fa-plus-circle"></i> Agregar  </button></th>
                                </thead>
                                <tbody>
                                    <tr> 
                                        <td><select class="form-control input-sm descripcion" name="descripcion[]"  required > </select></td>
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

            $("body").on("click","#agregar",function(event){
                     $("#articulos tbody").append(
                                        '<tr><td> <select class="form-control input-sm descripcion" name="descripcion[]"  required > </select></td>'+
                                        '<td><button type="button" class="btn btn-xs btn-danger eliminar"><i class="fa fa-trash"></i> Eliminar</button></td></tr>');


                    formatselect();
                });
                               
    });
</script>

<script src="{{asset('plugins/select2//select2.full.min.js')}}"></script>

<script>
    
cascade('cc_solicitante','responsable','/data/CentroCosto/codcentrocosto/','idpersonal','nombres','personal');

function cascade(parent,children,urlajax,id,column,withjoin=''){
        $('#' + parent).on('change',function(){
            var idvar = $(this).val();
            var namefield =  $("#"+children).attr('name').replace('id','');
            if(idvar){

                if(withjoin===''){

                    $.ajax({
                        type:'GET',
                        url:urlajax+idvar,
                        contentType: false,
                        processData: false,
                        beforeSend: function( xhr ) {
                          $("#"+children).html("<option>Cargando ...</option>");
                        },
                        success:function(data){
                            
                                if(data.length>0){
                                    $('#'+children).html('<option value="">Seleccione '+ namefield +'</option>');
                                    $('#'+children).removeAttr('disabled');
                                    $.each(data,function(v,item){
                                        var options = "<option ";
                                        $.each(item,function(i,val){
                                            if(i===id){ options += "value='" + val + "'>"; }
                                            if(i===column){ options +=  val; }
                                       });
                                        options += '</option>';
                                       
                                       $('#'+children).append(options);
                                       //console.log(options);
                                    });
                                }else{
                                    $('#'+children).html('<option value="">Seleccione '+ namefield +' </option>');
                                    $('#'+children).attr('disabled','disabled');
                                    //console.log("no data");
                                }
                        }
                    }); 

                } else {

                     $.ajax({
                        type:'GET',
                        url:urlajax+idvar+'/'+withjoin,
                        success:function(data){

                                if(data.length>0){
                                    $('#'+children).html('<option value="">Seleccione '+ namefield +'</option>');
                                    $('#'+children).removeAttr('disabled');
                                    $.each(data,function(v,item){
                                        //console.log(item.personal); 
                                        var options = "<option value='"+item.personal.idpersonal+"' >"+ item.personal.nombres +' '+item.personal.apellido_paterno+' '+ item.personal.apellido_materno+"</option>";
                                       
                                       $('#'+children).append(options);
                                       //console.log(options);
                                    });
                                }else{
                                    $('#'+children).html('<option value="">Seleccione '+ namefield +' </option>');
                                    $('#'+children).attr('disabled','disabled');
                                    //console.log("no data");
                                }
                        }
                    }); 

                }

            }
        });
    }


    

    formatselect();

    var arr = new Array();


    function formatselect(){

       

        $(".descripcion").on("change", function (e) { 
            console.log($(this).val());
            var idbien = $(this).val();
            if($.inArray(idbien.toString(), arr) > -1 ){
                event.preventDefault();
                alert("seleccione otro bien");
                $('.descripcion').val(null).trigger('change');
            }

        });

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
                cache: true
            },
            templateSelection: formatRepo
        });  

    }

    
    function formatRepo(repo){

        var cod = repo.id;   
        console.log(cod);
        if($.inArray(cod.toString(), arr) === -1 ){
            arr.push(repo.id);
        }

        return repo.text;
    }

    function remove(arr, item) {
        for (var i = arr.length; i--;) {
            if (arr[i] === item) {
                arr.splice(i, 1);
            }
        }
    }

</script>

@endsection