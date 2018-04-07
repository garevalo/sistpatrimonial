@extends('back.app')
@section('title')Reporte De Activos Operativos @endsection
@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Reporte de activos operativos</h3>
            </div>

            <form method="POST" action="{{url('reporte/activos/operativos')}}" target="_blank">

                {{csrf_field()}}
                <div class="box-body">

                    <div class="form-group-sm {{ $errors->has('idsede_personal') ? 'has-error' : '' }}">
                        <label>Sede:</label>
                        <select class="form-control" name="idsede_personal" id="idsede_personal" >
                            <option value="">Seleccione Sede</option>
                            @foreach($sedes as $sede)
                                <option value="{{$sede->idsede}}" @if(old('idsede_personal')== $sede->idsede) selected @endif>{{$sede->sede}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('idsede_personal','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('idgerencia_personal') ? 'has-error' : '' }}">
                        <label>Gerencia:</label>
                        <select class="form-control" name="idgerencia_personal" id="idgerencia_personal">
                            <option value="">Seleccione Gerencia</option>
                            @foreach($gerencias as $gerencia)
                                <option value="{{$gerencia->idgerencia}}" @if(old('idgerencia_personal')== $gerencia->idgerencia) selected @endif>{{$gerencia->gerencia}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('idsubgerencia_personal','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('idsubgerencia_personal') ? 'has-error' : '' }}">
                        <label>Sub Gerencia:</label>
                        <select class="form-control" name="idsubgerencia_personal" id="idsubgerencia_personal">
                            <option value="">Seleccione Subgerencia</option>
                            @foreach($subgerencias as $subgerencia)
                                <option value="{{$subgerencia->idsubgerencia}}" @if(old('idsubgerencia_personal')== $subgerencia->idsubgerencia) selected @endif>{{$subgerencia->subgerencia}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('idsubgerencia_personal','<span class="help-block">:message</span>') !!}
                    </div>

                    <input type="hidden" name="estado" value="1">
                    
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