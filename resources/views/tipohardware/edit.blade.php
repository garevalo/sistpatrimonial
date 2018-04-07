@extends('back.app')

@section('title','Editar Tipo Hardware')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar Tipo Hardware</h3>
            </div>

            <form method="POST" action="{{route('tipohardware.update',$tipohardware->id_tipo_hardware)}}">

                {{csrf_field()}}
                {!! method_field('PUT') !!}

                <div class="box-body">
                    <div class="form-group-sm {{ $errors->has('tipo_hardware') ? ' has-error' : '' }}">
                        <label>Marca:</label>

                        <input type="text" class="form-control" name="tipo_hardware" id="tipo_hardware" value="{{$tipohardware->tipo_hardware}}" required>
                        {!! $errors->first('tipo_hardware','<span class="help-block">:message</span>') !!}
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

@endsection