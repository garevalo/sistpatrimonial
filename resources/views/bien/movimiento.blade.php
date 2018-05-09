@extends('back.app')

@section('title','Editar Bien')

@section('content')

    <div class="col-xs-12">

        <div class="box">
            <div class="box-body">
                <form method="POST" action="{{route('bien.movimientostore',$bien->idbien)}}"  enctype="multipart/form-data">
                    {{csrf_field()}}


                    <input type="hidden" name="idbien" value="{{$bien->idbien}}">
                    <div class="box-body">
                        <div class="col-md-6 col-xs-12">

                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Datos del Bien:</h3>
                                    </div>
                                    <div class="box-body box-profile">
                                      <img class="img img-responsive img-thumbnail" src="{{ $bien->imagen }}" alt="IMG" style="width: 300px;">

                                      <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                          <b>Bien:</b> <a class="pull-right">{{ $bien->catalogo->denom_catalogo}}</a>
                                        </li>
                                        <li class="list-group-item">
                                          <b>Código Inventario:</b> <a class="pull-right">{{ $bien->codinventario}}</a>
                                        </li>
                                        <li class="list-group-item">
                                          <b>Código Patrimonial:</b> <a class="pull-right">{{ $bien->codpatrimonial}}</a>
                                        </li>
                                        <li class="list-group-item">
                                          <b>Orden de Compra:</b> <a class="pull-right">{{ $bien->ordencompra}}</a>
                                        </li>
                                        <li class="list-group-item">
                                          <b>Marca:</b> <a class="pull-right">{{ $bien->marca->marca}}</a>
                                        </li>
                                        <li class="list-group-item">
                                          <b>Modelo:</b> <a class="pull-right">{{ $bien->modelo->modelo}}</a>
                                        </li>
                                        <li class="list-group-item">
                                          <b>Color:</b> <a class="pull-right">{{ $bien->color->color}}</a>
                                        </li>
                                        <li class="list-group-item">
                                          <b>Num. Serie:</b> <a class="pull-right">{{ $bien->numserie}}</a>
                                        </li>
                                      </ul>
                                    </div>
                                    <!-- /.box-body -->
                                  </div>
                        </div>
                        
                        <div class="col-md-6 col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                  <h3 class="box-title text text-danger">Origen:</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group-sm {{ $errors->has('centrocosto') ? ' has-error' : '' }}">
                                        <label>Centro de Costo:</label>
                                        <select name="centrocostoold" id="centrocosto" class="form-control select2" disabled>
                                            <option value="">Seleccione Personal</option>
                                            @foreach($centrocostos as $centrocosto)
                                            <option value="{{$centrocosto->codcentrocosto}}" @if($bien->centrocosto == $centrocosto->codcentrocosto ) selected @endif >{{$centrocosto->FullCentroCosto}}</option>
                                            @endforeach()
                                        </select>
                                        {!! $errors->first('centrocosto','<span class="help-block">:message</span>') !!}

                                    </div>
                                    <div class="form-group-sm {{ $errors->has('idpersonal') ? ' has-error' : '' }}">
                                        <label>Personal:</label>

                                        <select name="idpersonalold" id="idpersonal" class="form-control select2" disabled>
                                            <option value="">Seleccione Personal</option>
                                            @foreach($personals as $personal)
                                            <option value="{{$personal->idpersonal}}" @if($personal->idpersonal == $bien->idpersonal  ) selected @endif >{{$personal->FullName}}</option>
                                            @endforeach()
                                        </select>
                                        {!! $errors->first('idpersonal','<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="box box-danger">
                                <div class="box-header with-border">
                                  <h3 class="box-title text text-danger">Destino:</h3>
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
                            
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Registrar Movimiento</button>
                            </div>


                        </div>
                        
                    </div>

                </form>
            </div>
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