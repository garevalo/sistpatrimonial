@extends('back.app')

@section('title','Registrar Movimiento')

@section('content')

    <form method="POST" action="{{ route('bien.transferenciastore') }}"  enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="col-md-6 col-xs-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Origen:</h3>
                </div>
                <div class="box-body">
                    <div class="form-group-sm {{ $errors->has('centrocosto') ? ' has-error' : '' }}">
                        <label>Centro de Costo:</label>
                        <select name="centrocosto" id="centrocosto" class="form-control select2">
                            <option value="">Seleccione Personal</option>
                            @foreach($centrocostos as $centrocosto)
                            <option value="{{$centrocosto->codcentrocosto}}" @if($centrocosto->codcentrocosto == old('centrocosto') ) selected @endif >{{$centrocosto->FullCentroCosto}}</option>
                            @endforeach()
                        </select>
                        {!! $errors->first('centrocosto','<span class="help-block">:message</span>') !!}

                    </div>
                    <div class="form-group-sm {{ $errors->has('idpersonal') ? ' has-error' : '' }}">
                        <label>Personal:</label>

                        <select name="idpersonal" id="idpersonal" class="form-control select2">
                            <option value="">Seleccione Personal</option>
                            @foreach($personals as $personal)
                            <option value="{{$personal->idpersonal}}" @if($personal->idpersonal == old('idpersonal') ) selected @endif >{{$personal->FullName}}</option>
                            @endforeach()
                        </select>
                        {!! $errors->first('idpersonal','<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Destino:</h3>
                </div>
                <div class="box-body">
                    <div class="form-group-sm {{ $errors->has('centrocosto') ? ' has-error' : '' }}">
                        <label>Centro de Costo:</label>
                        <select name="centrocostodestino" id="centrocostodestino" class="form-control select2">
                            <option value="">Seleccione Personal</option>
                            @foreach($centrocostos as $centrocosto)
                            <option value="{{$centrocosto->codcentrocosto}}" @if($centrocosto->codcentrocosto == old('centrocosto') ) selected @endif >{{$centrocosto->FullCentroCosto}}</option>
                            @endforeach()
                        </select>
                        {!! $errors->first('centrocosto','<span class="help-block">:message</span>') !!}

                    </div>
                    <div class="form-group-sm {{ $errors->has('idpersonal') ? ' has-error' : '' }}">
                        <label>Personal:</label>

                        <select name="idpersonaldestino" id="idpersonaldestino" class="form-control select2">
                            <option value="">Seleccione Personal</option>
                            @foreach($personals as $personal)
                            <option value="{{$personal->idpersonal}}" @if($personal->idpersonal == old('idpersonal') ) selected @endif >{{$personal->FullName}}</option>
                            @endforeach()
                        </select>
                        {!! $errors->first('idpersonal','<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xs-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Bienes:</h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed " id="table-transferencia">
                    	<thead>
                    		<th>Id</th>
                    		<th>Bien</th>
                    		<th>Cod. Patrimonial</th>
                    		<th>Color</th>
                    		<th>Marca</th>
                    		<td><input type="checkbox" id="select_all"></td>
                    	</thead>
                    	<tbody id="contenidotransferencia">
                    		
                    	</tbody>
                    </table>
                </div>
                <div class="box-footer">
		            <button type="submit" class="btn btn-primary">Registrar Movimiento</button>
		        </div>
            </div>
        </div>


            
    </form>
                
@endsection

@section('javascript')
    @parent()

    <!-- InputMask -->
    <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

    <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <script src="{{asset('plugins/bootbox.min.js')}}"></script>

    <script>
        $(function () {
            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            //Money Euro
            $("[data-mask]").inputmask();

            $("#select_all").change(function () {

			    $('input[type="checkbox"]').prop("checked", $(this).prop("checked"));

			});  
        });

        cascade('centrocosto','idpersonal','/data/CentroCosto/codcentrocosto/','idpersonal','nombres','personal');
        cascade('centrocostodestino','idpersonaldestino','/data/CentroCosto/codcentrocosto/','idpersonal','nombres','personal');
        tableajax('data/Bien/centrocosto/','centrocosto','contenidotransferencia','');


        function cascade(parent,children,urlajax,id,column,withjoin=''){
            $('#' + parent).on('change',function(){
                var idvar = $(this).val();
                var namefield =  $("#"+children).attr('name').replace('id','');
                if(idvar){

                    if(withjoin===''){

                        $.ajax({
                            type:'GET',
                            url:urlajax+idvar,
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
                                           console.log(options);
                                        });
                                    }else{
                                        $('#'+children).html('<option value="">Seleccione '+ namefield +' </option>');
                                        $('#'+children).attr('disabled','disabled');
                                        console.log("no data");
                                    }
                            }
                        }); 

                    } else {

                         $.ajax({
                            type:'GET',
                            url:urlajax+idvar+'/'+withjoin,
                            success:function(data){
                                    
                                    var datapersonal = data[0].personal;
                                    //console.log(datapersonal);
                                    if(datapersonal){
                                        $('#'+children).html('<option value="">Seleccione '+ namefield +'</option>');
                                        $('#'+children).removeAttr('disabled');
                                        $.each(data,function(v,item){
                                            //console.log(item.personal); 
                                            var options = "<option value='"+item.personal.idpersonal+"' >"+ item.personal.nombres +' '+item.personal.apellido_paterno+' '+ item.personal.apellido_materno+"</option>";
                                           
                                           $('#'+children).append(options);
                                           console.log(options);
                                        });
                                    }else{
                                        $('#'+children).html('<option value="">Seleccione '+ namefield +' </option>');
                                        $('#'+children).attr('disabled','disabled');
                                        console.log("no data");
                                    }
                            }
                        }); 

                    }

                }
            });
        }

        function tableajax(urlajax,parent,children,withajax){
            $('#' + parent).on('change',function(){
                var idvar = $(this).val();
                
                $.ajax({
                    type:'GET',
                    url:urlajax+idvar,
                    contentType: false,
                    processData: false,
                    beforeSend: function( xhr ) {
                      $("#"+children).html("<tr><td align='center' colspan='6'><i class='fa fa-refresh fa-spin'></i></td></tr>");
                    },
                    timeout: 3000,
                    success:function(data){
                            
                        if(data.length>0){
                            $('#'+children).html("");
                            $.each(data,function(v,item){
                                var options = "<tr>"+
                                "<td>"+ (parseInt(v)+parseInt(1)) +"</td>"+
                                "<td>"+item.catalogo.denom_catalogo+"</td>"+
                                "<td>"+item.codpatrimonial+"</td>"+
                                "<td>"+item.color.color+"</td>"+
                                "<td>"+item.marca.marca+"</td>"+
                                "<td><input type='checkbox' name='bien["+item.idbien+"]' value='"+item.idbien+"' ></td></tr>";
                          
                                
                                $('#'+children).append(options);
                                //$( options ).appendTo( $( "#"+children ) );
                            });
                        }else{
                            $('#'+children).html("");
                            console.log("no data");
                            //bootbox.alert("Este centro de costos no tiene bienes");
                            bootbox.alert({ 
                              size: "small",
                              title: "<h3>Alerta</h3>",
                              message: "Este Centro de Costo no tiene bienes asignados"
                            });
                        }
                    }
                })
            }); 

        }

    </script>

    <!-- Select2 -->
    <script src="{{asset('plugins/select2//select2.full.min.js')}}"></script>

@endsection