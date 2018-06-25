@extends('back.app')

@section('title','Editar Bien')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar Bien</h3>
            </div>

            <form method="POST" action="{{route('bien.update',$bien->idbien)}}"  enctype="multipart/form-data">
                {{csrf_field()}}

                {!! method_field('PUT') !!}
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
                                <option value="{{$bien->codcatalogo}}">{{ isset($bien->catalogo->denom_catalogo)?$bien->catalogo->denom_catalogo: ''}}</option>
                            </select>
                            {!! $errors->first('codcatalogo','<span class="help-block">:message</span>') !!}
                        </div>

                        {{ Form::textfield('codinventario','Código Inventario:',$bien->codinventario) }}
                        
                        {{ Form::textfield('codpatrimonial','Código Patrimonial:',$bien->codpatrimonial) }}
                        
                        {{ Form::textfield('ordencompra','Orden de Compra:',$bien->ordencompra) }}

                        {{ Form::selectfield('idmarca','Marca',$marcas,'Seleccione marca',$bien->idmarca) }}

                        {{ Form::selectfield('idmodelo','Modelo',$modelos,'Seleccione modelo',$bien->idmodelo) }}
                        
                        {{ Form::selectfield('idcolor','Color',$colores,'Seleccione color',$bien->idcolor) }}

                        <div class="form-group-sm {{ $errors->has('imagen') ? ' has-error' : '' }}">
                            <label>Imagen:</label>

                            <input type="file" class="form-control" name="imagen" id="imagen" value="{{old('imagen')}}">
                            {!! $errors->first('imagen','<span class="help-block">:message</span>') !!}
                        </div>  

                        {{ Form::textfield('numserie','Número de serie:',$bien->numserie) }}
        
                        {{ Form::selectfield('idproveedor','Proveedor',$proveedores,'Seleccione proveedor',$bien->idproveedor) }}

                    </div>
                    
                    <div class="col-md-6 col-xs-12">
                        {{ Form::selectfield('idlocal','Local',$locales,'Seleccione local',$bien->idlocal) }}
                        {{ Form::selectfield('idoficina','Oficina',$oficinas,'Seleccione oficina',$bien->idoficina) }}

                        {{ Form::selectfield('centrocosto','Centro Costo',$centrocostos,'Seleccione',$bien->centrocosto) }}

                        {{ Form::selectfield('idpersonal','Personal',$personals,'Seleccione',$bien->idpersonal) }}

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

                        
                        {{ Form::textfield('valor','Valor:',$bien->valor) }}

                        {{ Form::selectfield('idadquisicion','Modo de Adquisición',$adquisiciones,'Seleccione',$bien->idadquisicion) }}
         
                        {{ Form::textfield('fecha_adquisicion','Fecha de Adquisición:',$bien->fecha_adquisicion->format('d/m/Y') ,["data-mask"=>"","data-inputmask" => "'alias': 'dd/mm/yyyy'"]) }}

                        <div class="form-group-sm {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label>Descripción:</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control" required >{{ $bien->descripcion }}</textarea>
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
    <script src="{{asset('plugins/select2//select2.full.min.js')}}"></script>

    <script>
        
        $("#catalogo").select2({
            language: "es",
            minimumInputLength: 2,
            ajax: {
                url:  "{{route('catalogoitems',['id'=> substr($bien->codinventario,0,8)  ])}}",
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


        cascade('idlocal','idoficina','/data/Oficina/idlocal/','idoficina','oficina',);
        cascade('idlocal','centrocosto','/data/CentroCosto/idlocal/','codcentrocosto','centrocosto');
        cascade('centrocosto','idpersonal','/data/CentroCosto/codcentrocosto/','idpersonal','nombres','personal');


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
@endsection