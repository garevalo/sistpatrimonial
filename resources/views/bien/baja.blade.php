@extends('back.app')

@section('title','Registrar baja de bien')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Registrar baja de bien</h3>
            </div>

            <form method="POST" action="{{route('bajaStore',$id)}}"  enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                   	<div class="col-md-6 col-xs-12">
                   		{{ Form::selectfield('idlocal','Local',$locales,'Seleccione local',$bien->idlocal) }}
                        {{ Form::selectfield('idoficina','Oficina',$oficinas,'Seleccione oficina',$bien->idoficina) }}

                        {{ Form::selectfield('centrocosto','Centro Costo',$centrocostos,'Seleccione',$bien->centrocosto) }}

                        {{ Form::selectfield('idpersonal','Personal',$personals,'Seleccione',$bien->idpersonal) }}

                        <div class="form-group-sm {{ $errors->has('imagen') ? ' has-error' : '' }}">
                            <label>Imagen:</label>

                            <input type="file" class="form-control" name="imagen" id="imagen" value="{{old('imagen')}}" required="">
                            {!! $errors->first('imagen','<span class="help-block">:message</span>') !!}
                        </div>
                   	</div>

                    <div class="col-md-6 col-xs-12">

                        <div class="form-group-sm {{ $errors->has('fechabaja') ? ' has-error' : '' }}">
                            <label>Fecha de Baja:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" name="fechabaja" id="fechabaja" required="">
                            </div>
                            {!! $errors->first('fechabaja','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group-sm {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label>Detalles:</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control" required >{{old('descripcion')}}</textarea>
                            {!! $errors->first('descripcion','<span class="help-block">:message</span>') !!}
                        </div>

                    </div>
                    
                </div>


                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Realizar Baja</button>
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
            $("[data-mask]").inputmask();
        });
    </script>

    <!-- Select2 -->
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>

    <script>
        
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