@extends('back.app')

@section('title','Registrar Rol')

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Registrar Rol</h3>
        </div>


        <form method="POST" action="{{route('rol.store')}}">

            {{csrf_field()}}
            <div class="box-body">
                <div class="form-group {{ $errors->has('rol') ? ' has-error' : '' }}">
                    <label>Rol:</label>

                    <input type="text" class="form-control" name="rol" id="rol" value="{{old('rol')}}" required>
                    {!! $errors->first('rol','<span class="help-block">:message</span>') !!}
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