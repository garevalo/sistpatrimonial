@extends('back.app')

@section('title','Registrar Bien')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Registrar Bien</h3>
            </div>

            <form method="POST" action="{{route('bien.store')}}"  enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="col-md-6 col-xs-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group-sm {{ $errors->has('codcatalogo') ? ' has-error' : '' }}">
                            <label>Bien:</label>
                            <select class="form-control bien" name="codcatalogo" id="catalogo" required autofocus>
                                
                            </select>
                            {!! $errors->first('codcatalogo','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('codinventario') ? ' has-error' : 'has-info' }}">
                            <label>Código Inventario:</label>

                            <input type="text" class="form-control" name="codinventario" id="codinventario" value="{{old('codinventario')}}" required >
                            {!! $errors->first('codinventario','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('codpatrimonial') ? ' has-error' : '' }}">
                            <label>Código Patrimonial:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="codpatrimonial" id="codpatrimonial" value="{{old('codpatrimonial')}}" >        
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="idbien" id="idbien" value="{{old('idbien')}}">        
                                </div>
                            </div>
                            
                            {!! $errors->first('codpatrimonial','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('ordencompra') ? ' has-error' : '' }}">
                            <label>Orden de Compra:</label>

                            <input type="text" class="form-control" name="ordencompra" id="ordencompra" value="{{old('ordencompra')}}" required>
                            {!! $errors->first('ordencompra','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('idmarca') ? ' has-error' : '' }}">
                            <label>Marca:</label>
                            <select class="form-control" name="idmarca" id="idmarca" value="{{old('idmarca')}}" required>
                                <option>Seleccione Marca</option>
                                @foreach($marcas as $marca)
                                <option value="{{$marca->idmarca}}" @if($marca->idmarca == old('idmarca') ) selected @endif >{{$marca->marca}}</option>
                                @endforeach()
                            </select>
                            {!! $errors->first('idmarca','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('idmodelo') ? ' has-error' : '' }}">
                            <label>Modelo:</label>
                            <select class="form-control" name="idmodelo" id="idmodelo" value="{{old('idmodelo')}}" required>
                                <option value="">Seleccione Modelo</option>
                                @foreach($modelos as $modelo)
                                <option value="{{$modelo->idmodelo}}" @if($modelo->idmodelo == old('idmodelo') ) selected @endif >{{$modelo->modelo}}</option>
                                @endforeach()
                            </select>
                            {!! $errors->first('idmodelo','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('idcolor') ? ' has-error' : '' }}">
                            <label>Color:</label>
                            <select class="form-control" name="idcolor" id="idcolor" value="{{old('idcolor')}}" required>
                                <option value="">Seleccione Color</option>
                                @foreach($colores as $color)
                                <option value="{{$color->idcolor}}" @if($color->idcolor == old('idcolor') ) selected @endif >{{$color->color}}</option>
                                @endforeach()
                            </select>
                            {!! $errors->first('color','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('imagen') ? ' has-error' : '' }}">
                            <label>Imagen:</label>

                            <input type="file" class="form-control" name="imagen" id="imagen" value="{{old('imagen')}}">
                            {!! $errors->first('imagen','<span class="help-block">:message</span>') !!}
                        </div>  

                        <div class="form-group-sm {{ $errors->has('numserie') ? ' has-error' : '' }}">
                            <label>Número Serie:</label>

                            <input type="text" class="form-control" name="numserie" id="numserie" value="{{old('numserie')}}">
                            {!! $errors->first('numserie','<span class="help-block">:message</span>') !!}
                        </div>
                        
                        {{ Form::selectfield('idproveedor','Proveedor',$proveedores,'Seleccione proveedor') }}

                    </div>
                    
                    <div class="col-md-6 col-xs-12">

                        {{ Form::selectfield('idlocal','Local',$locales,'Seleccione local') }}
                        {{ Form::selectfield('idoficina','Oficina',$oficinas,'Seleccione oficina') }}

                        <div class="form-group-sm {{ $errors->has('centrocosto') ? ' has-error' : '' }}">
                            <label>Centro de Costo:</label>
                            <select name="centrocosto" id="centrocosto" class="form-control select2">
                                <option value="">Seleccione Centro Costo</option>
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

                        <div class="form-group-sm {{ $errors->has('idestado') ? ' has-error' : '' }}">
                            <label>Estado:</label>

                            <select name="idestado" id="idestado" class="form-control select2" required="">
                                <option value="">Seleccione Estado</option>
                                @foreach($estados as $key => $estado)
                                <option value="{{$key}}" @if($key==old('idestado')) selected @endif >{{$estado}}</option>
                                @endforeach

                            </select>
                            {!! $errors->first('idestado','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('valor') ? ' has-error' : '' }}">
                            <label>Valor:</label>

                            <input type="text" class="form-control" name="valor" id="valor" value="{{old('valor')}}" required>
                            {!! $errors->first('valor','<span class="help-block">:message</span>') !!}
                        </div>

                        {{ Form::selectfield('idadquisicion','Modo de Adquisición',$adquisiciones,'Seleccione') }}

                        <div class="form-group-sm {{ $errors->has('fecha_adquisicion') ? ' has-error' : '' }}">
                            <label>Fecha de Adquisición:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" name="fecha_adquisicion" id="fecha_adquisicion">
                            </div>
                            {!! $errors->first('fecha_adquisicion','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group-sm {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label>Descripción:</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control" required >{{old('descripcion')}}</textarea>
                            {!! $errors->first('descripcion','<span class="help-block">:message</span>') !!}
                        </div>

                    </div>
                    
                </div>


                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
            <!-- /.box-body -->
        </div>

    </div>

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
        });
    </script>

    <!-- Select2 -->
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>

    <script>
        
        $("#catalogo").select2({
            language: "es",
            minimumInputLength: 2,
            ajax: {
                url:  "{{route('catalogoitems')}}",
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
            templateSelection: formatRepo,
        });

        function formatRepo (repo) {
            $("#codpatrimonial").val(repo.id);
            autoCompleteCod('/bien/getbiencod/',repo.id,"idbien");
            return repo.text;
        }

        cascade('idlocal','idoficina','/data/Oficina/idlocal/','idoficina','oficina',);
        cascade('idlocal','centrocosto','/data/CentroCosto/idlocal/','codcentrocosto','centrocosto');
        cascade('centrocosto','idpersonal','/data/CentroCosto/codcentrocosto/','idpersonal','nombres','personal');


        function autoCompleteCod(urlajax,cod,input){
            $.ajax({
                type:'GET',
                url:urlajax+cod,
                success:function(data){
                        console.log(data);
                        if(data){
                            $("#"+input).val(data.codpatrimonial);
                        }else{
                            console.log("no data"+ data.codpatrimonial);
                        }
                }
            });   
        }

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

    </script>
@endsection


