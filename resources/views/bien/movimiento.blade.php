@extends('back.app')

@section('title','Editar Bien')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar Bien</h3>
            </div>

            <form method="POST" action="{{route('bien.store')}}"  enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="col-md-6 col-xs-12">

                        <div class="form-group-sm has-warning">
                            <label for="catalogo">Catálogo: </label>
                            <label id="catalogo" class="form-control disabled">{{ $bien->catalogo->denom_catalogo}} </label>
                        </div>

                        <div class="form-group-sm has-warning">
                            <label>Código Inventario:</label>

                            <label  class="form-control">{{ $bien->codinventario }} </label>
                        </div>

                        <div class="form-group-sm has-warning">
                            <label>Código Patrimonial:</label>
                            <label  class="form-control">{{ $bien->codpatrimonial }} </label>
                        </div>

                        <div class="form-group-sm has-warning">
                            <label>Orden de Compra:</label>
                            <label  class="form-control">{{ $bien->ordencompra }} </label>
                        </div>

                        <div class="form-group-sm has-warning">
                            <label>Marca:</label>
                            <label  class="form-control">{{ $bien->marca->marca }} </label>
                        </div>

                        <div class="form-group-sm has-warning">
                            <label>Modelo:</label>
                            <label  class="form-control">{{ $bien->modelo->modelo }} </label>
                        </div>

                        <div class="form-group-sm has-warning">
                            <label>Color:</label>
                            <label  class="form-control">{{ $bien->color->color }} </label>
                        </div>

                        <div class="form-group-sm has-warning">
                            <label>Imagen:</label>
                            <img src="{{ $bien->imagen }}" width="150" height="100">
                        </div>  

                        <div class="form-group-sm has-warning">
                            <label>Número Serie:</label>
                            <label  class="form-control">{{ $bien->numserie }} </label>
                        </div>
                        
                        

                    </div>
                    
                    <div class="col-md-6 col-xs-12">

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
                    <button type="submit" class="btn btn-primary">Registrar Movimiento</button>
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
        /*
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
            $("#codinventario").val(repo.id);
            return repo.text;
          //}
        }
	*/
    </script>
@endsection