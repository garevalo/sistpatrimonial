@extends('back.app')

@section('title','Atender '. ucwords($titulomod))

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Atender {{ucwords($titulomod)}}</h3>
        </div>
        {!! Form::model($table, ['action' => ['PedidoController@update',$table->idpedido],'method'=>'put'] ) !!}
            <div class="box-body">
                <div class="col-xs-12">
                    {{ Form::selectfield('cc_solicitante','Dependencia Solicitante',$centrocostos,'Seleccione Centro Costo',$table->centroCostoSolicitante->codcentrocosto,[]) }}

                    {{ Form::selectfield('cc_destino','Con Destino a (Oficina)',$oficinas,'Seleccione Oficina',isset($table->CentroCostoDestino->idoficina)? $table->CentroCostoDestino->idoficina : '',[] ) }}

                    {{ Form::selectfield('responsable','Entregar a',$personales,'Seleccione Personal',$table->PersonalResponsable->idpersonal,[]) }}

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
                                    <th width="65%">Articulos Solicitados</th>
                                </thead>
                                <tbody>
                                    @foreach($table->articulo as $articulo)
                                    <tr> 
                                        <td><select type="text" name="descripcion[{{$articulo->idarticulos}}]" required="" class="form-control input-sm descripcion" id="bien{{$articulo->bien->catalogo->codcatalogo}}" >
                                            <option value="{{$articulo->bien->idbien}}">{{$articulo->bien->catalogo->denom_catalogo}}</option>
                                        </select> </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
               
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Editar</button>
            </div>
        {!! Form::close() !!}  
    </div>

</div>



@endsection

@section('javascript')

@parent

<!-- InputMask -->
<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{asset('plugins/select2//select2.full.min.js')}}"></script>
<script>
    $(function () {
        
        $("[data-mask]").inputmask();
    });
</script>

<script>
    
@foreach($table->articulo as $articulo)
seleccion('{{ route('bienitems',['id'=>$articulo->bien->catalogo->codcatalogo]) }}', '{{ $articulo->bien->catalogo->codcatalogo }}' );
@endforeach



function seleccion(route,id){
     $("#bien"+id).select2({
        language: "es",
        minimumInputLength: 2,
        ajax: {
            url:  route,
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
        }
    });       
}


    
</script>

@endsection