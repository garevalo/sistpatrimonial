@extends('back.app')

@section('title','Editar Sede')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar Sede</h3>
            </div>


            <form method="POST" action="{{route('rol.update',$rol->idrol)}}">

                {{csrf_field()}}
                {!! method_field('PUT') !!}
                <div class="box-body">
                    <div class="form-group {{ $errors->has('rol') ? ' has-error' : '' }}">
                        <label>Rol:</label>

                        <input type="text" class="form-control" name="rol" id="rol" value="{{ (old('rol'))? old('rol'): $rol->rol  }}" required>
                        {!! $errors->first('sede','<span class="help-block">:message</span>') !!}
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