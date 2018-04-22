@extends('back.app')

@section('title','Registrar Bien')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Registrar Bien</h3>
            </div>

            <form method="POST" action="{{route('bien.store')}}">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="col-md-6 col-xs-12">

                        <div class="form-group-sm {{ $errors->has('codinventario') ? ' has-error' : '' }}">
                            <label>Bien:</label>
                            <select class="form-control bien" name="bien" id="bien" required autofocus>
                                
                            </select>
                            {!! $errors->first('codinventario','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('codinventario') ? ' has-error' : 'has-info' }}">
                            <label>Código Inventario:</label>

                            <input type="text" class="form-control" name="codinventario" id="codinventario" value="{{old('codinventario')}}" required  >
                            {!! $errors->first('codinventario','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('codpatrimonial') ? ' has-error' : '' }}">
                            <label>Código Patrimonial:</label>

                            <input type="text" class="form-control" name="codpatrimonial" id="codpatrimonial" value="{{old('codpatrimonial')}}">
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
                                <option value="{{$marca->idmarca}}">{{$marca->marca}}</option>
                                @endforeach()
                            </select>
                            {!! $errors->first('idmarca','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('idmodelo') ? ' has-error' : '' }}">
                            <label>Modelo:</label>
                            <select class="form-control" name="idmodelo" id="idmodelo" value="{{old('idmodelo')}}" required>
                                <option value="">Seleccione Modelo</option>
                                @foreach($modelos as $modelo)
                                <option value="{{$modelo->idmodelo}}">{{$modelo->modelo}}</option>
                                @endforeach()
                            </select>
                            {!! $errors->first('idmodelo','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('idcolor') ? ' has-error' : '' }}">
                            <label>Color:</label>
                            <select class="form-control" name="idcolor" id="idcolor" value="{{old('idcolor')}}" required>
                                <option value="">Seleccione Color</option>
                                @foreach($colores as $color)
                                <option value="{{$color->idcolor}}">{{$color->color}}</option>
                                @endforeach()
                            </select>
                            {!! $errors->first('color','<span class="help-block">:message</span>') !!}
                        </div>  

                        <div class="form-group-sm {{ $errors->has('num_serie') ? ' has-error' : '' }}">
                            <label>Número Serie:</label>

                            <input type="text" class="form-control" name="num_serie" id="num_serie" value="{{old('num_serie')}}">
                            {!! $errors->first('num_serie','<span class="help-block">:message</span>') !!}
                        </div>
                        
                        

                    </div>
                    
                    <div class="col-md-6 col-xs-12">

                        <div class="form-group-sm {{ $errors->has('estado') ? ' has-error' : '' }}">
                            <label>Estado:</label>

                            <select name="estado" id="estado" class="form-control select2">
                                <option value="">Seleccione Estado</option>
                                <option value="1">Activos</option>
                                <option value="2">De baja</option>
                            </select>
                            {!! $errors->first('estado','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('valor') ? ' has-error' : '' }}">
                            <label>Valor:</label>

                            <input type="text" class="form-control" name="valor" id="valor" value="{{old('valor')}}" required>
                            {!! $errors->first('valor','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('idadquisicion') ? ' has-error' : '' }}">
                            <label>Modo de Adquisición:</label>
                            <select class="form-control" name="idadquisicion" id="idadquisicion" required>
                                <option value="">Seleccione Adquisición</option>
                                @foreach($adquisiciones as $adquisicion)
                                <option value="{{$adquisicion->idadquisicion}}">{{$adquisicion->adquisicion}}</option>
                                @endforeach()
                            </select>
                            {!! $errors->first('idadquisicion','<span class="help-block">:message</span>') !!}
                        </div>

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
    <script src="{{asset('plugins/select2//select2.full.min.js')}}"></script>

    <script>
        
        $("#bien").select2({
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
            templateResult: formatRepo,
        });

        function formatRepo (repo) {
          //if (repo.loading) {
            $("#codinventario").val(repo.id);
            return repo.text;
          //}
        }

    </script>
@endsection


