@extends('back.app')
@section('title')Reporte Inventario @endsection
@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Reporte Inventario</h3>
            </div>

            <form method="POST" action="{{route('reporteInventario')}}" target="_blank">

                {{csrf_field()}}
                <div class="box-body">

                    {{ Form::selectfield('year','Año Inventario',$years,'Seleccione Año','',['required'=>'required']) }}


                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Exportar </button>
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