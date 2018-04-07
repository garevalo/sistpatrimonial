@extends('back.app')

@section('title','Registrar Software')

@section('header')
    @parent()
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">

@endsection
@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Registrar Software</h3>
            </div>

            <form method="POST" action="{{route('software.update',$software->idsoftware)}}">

                {{csrf_field()}}
                {!! method_field('PUT') !!}

                <div class="box-body">
         
                    <div class="form-group {{ $errors->has('idtipo_software') ? ' has-error' : '' }}">
                        <label>Tipo Software:</label>
                        <select name="idtipo_software" id="idtipo_software" class="form-control input-sm">
                            <option>Seleccione Tipo</option>
                            @foreach($tiposoftwares as $tiposoftware)
                                <option value="{{$tiposoftware->id_tipo_software}}" @if($software->idtipo_software==$tiposoftware->id_tipo_software)  selected @endif() >{{$tiposoftware->tipo_software}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('idtipo_software','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('nombre_software') ? ' has-error' : '' }}">
                        <label>Nombre Software:</label>

                        <input type="text" class="form-control input-sm" name="nombre_software" id="nombre_software" value="{{$software->nombre_software or old('nombre_software')}}" required>
                        {!! $errors->first('nombre_software','<span class="help-block">:message</span>') !!}
                    </div>


                    <div class="form-group {{ $errors->has('arquitectura') ? ' has-error' : '' }}">
                        <label>Arquitectura:</label>

                        <input type="text" class="form-control input-sm" name="arquitectura" id="arquitectura" value="{{ $software->arquitectura }}" required>
                        {!! $errors->first('arquitectura','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('service_pack') ? ' has-error' : '' }}">
                        <label>Service Pack:</label>

                        <input type="text" class="form-control input-sm" name="service_pack" id="service_pack" value="{{$software->service_pack }}" required>
                        {!! $errors->first('service_pack','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('fecha_adquisicion') ? ' has-error' : '' }}">
                        <label>Fecha Adquisición:</label>
                        <input type="text" class="form-control input-sm" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" name="fecha_adquisicion" id="fecha_adquisicion" required value="{{$software->fecha_adquisicion->format('d/m/Y')}}">
                        {!! $errors->first('fecha_adquisicion','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="checkbox {{ $errors->has('licencia') ? ' has-error' : '' }}">
                        <label>
                            <input type="checkbox" name="licencia" value="1" @if($software->licencia==1) checked @endif() > Licencia Pagada
                        </label>
                        {!! $errors->first('licencia','<span class="help-block">:message</span>') !!}
                    </div>


                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
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