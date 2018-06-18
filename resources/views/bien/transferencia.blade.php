@extends('back.app')

@section('title','Registrar Movimiento')

@section('content')

    <form method="POST" action=""  enctype="multipart/form-data">
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
                        <select name="centrocosto" id="centrocostodestino" class="form-control select2">
                            <option value="">Seleccione Personal</option>
                            @foreach($centrocostos as $centrocosto)
                            <option value="{{$centrocosto->codcentrocosto}}" @if($centrocosto->codcentrocosto == old('centrocosto') ) selected @endif >{{$centrocosto->FullCentroCosto}}</option>
                            @endforeach()
                        </select>
                        {!! $errors->first('centrocosto','<span class="help-block">:message</span>') !!}

                    </div>
                    <div class="form-group-sm {{ $errors->has('idpersonal') ? ' has-error' : '' }}">
                        <label>Personal:</label>

                        <select name="idpersonal" id="idpersonaldestino" class="form-control select2">
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
                    <table class="table table-condensed ">
                    	<thead>
                    		<th>Id</th>
                    		<th>Bien</th>
                    		<th>Cod. Patrimonial</th>
                    		<th>Color</th>
                    		<th>Marca</th>
                    		<td><input type="checkbox" name="bien[]" id="select_all"></td>
                    	</thead>
                    	<tbody>
                    		@foreach($bienes as $bien)
                    		<tr>
                    			<td>{{$bien->idbien}}</td>
                    			<td>{{$bien->catalogo->denom_catalogo }}</td>
                    			<td>{{$bien->codpatrimonial}}</td>
                    			<td>{{$bien->color->color}}</td>
                    			<td>{{$bien->marca->marca}}</td>
                    			<td><input type="checkbox" name="bien[]"></td>
                    		</tr>
                    		@endforeach
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

                                    if(data.length>0){
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

    </script>

    <!-- Select2 -->
    <script src="{{asset('plugins/select2//select2.full.min.js')}}"></script>

@endsection