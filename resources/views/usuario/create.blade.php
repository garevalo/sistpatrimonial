@extends('back.app')

@section('title','Registrar Usuario')

@section('header')
    @parent()
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">

@endsection
@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Registrar Usuario</h3>
            </div>

            <form method="POST" action="{{route('usuario.store')}}">

                {{csrf_field()}}
                <div class="box-body">

                    <div class="form-group-sm {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label>Nombre:</label>

                        <input type="text" class="form-control input-sm" name="name" id="name" value="{{old('name')}}" required>
                        {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('apellidos') ? ' has-error' : '' }}">
                        <label>Apellidos:</label>

                        <input type="text" class="form-control input-sm" name="apellidos" id="apellidos" value="{{old('apellidos')}}" required>
                        {!! $errors->first('apellidos','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('usuario') ? ' has-error' : '' }}">
                        <label>Usuario:</label>

                        <input type="text" class="form-control input-sm" name="usuario" id="usuario" value="{{old('usuario')}}" required>
                        {!! $errors->first('usuario','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label>Email:</label>

                        <input type="text" class="form-control input-sm" name="email" id="email" value="{{old('email')}}" required>
                        {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label>Contraseña:</label>

                        <input type="password" class="form-control input-sm" name="password" id="password" value="{{old('password')}}" required>
                        {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('rol') ? ' has-error' : '' }}">
                        <label>Rol:</label>

                        <select name="idrol" id="idrol" class="form-control input-sm" required>
                            <option value="">Seleccione Rol</option>
                            @foreach($roles as $rol)
                            <option value="{{$rol->idrol}}">{{$rol->rol}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('rol','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
                        <label>Estado:</label>

                        <select name="estado" id="estado" class="form-control input-sm" required>
                            <option value="">Seleccione Estado</option>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                        {!! $errors->first('estado','<span class="help-block">:message</span>') !!}
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