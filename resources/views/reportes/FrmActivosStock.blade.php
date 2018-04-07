@extends('back.app')
@section('title')Reporte de activos en stock @endsection
@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Reporte de activos en stock</h3>
            </div>

            <form method="POST" action="{{url('reporte/activos/stock')}}" target="_blank">

                {{csrf_field()}}
                <div class="box-body">
                                   
                    <div class="form-group-sm {{ $errors->has('hasta') ? ' has-error' : '' }}">
                         <label>Exportar a :</label>
                        <div class="radio">
                            <label for="">
                                <input type="radio" name="exportar" value="1" checked > <i class="fa fa-file-excel-o" ></i> Excel
                            </label>
                        </div>
                        <div class="radio">
                            <label for="">
                                <input type="radio" name="exportar" value="2" > <i class="fa fa-file-pdf-o"></i> PDF
                            </label>
                        </div>
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Exportar </button>
                </div>
            </form>
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