@extends('back.app')

@section('title','Registrar Gerencia')

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Registrar Gerencia</h3>
        </div>

        <form method="POST" action="{{route('gerencia.store')}}">
        {{ csrf_field() }}
        <div class="box-body">

            <div class="form-group-sm {{ $errors->has('gerencia') ? ' has-error' : '' }}">
                <label>Cod Centro Costo:</label>
                <input type="text" class="form-control" name="gerencia" id="gerencia" value="{{old('gerencia')}}" required>
                {!! $errors->first('gerencia','<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group-sm {{ $errors->has('gerencia') ? ' has-error' : '' }}">
                <label>Gerencia:</label>
                <input type="text" class="form-control" name="gerencia" id="gerencia" value="{{old('gerencia')}}" required>
                {!! $errors->first('gerencia','<span class="help-block">:message</span>') !!}
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn-sm btn-primary">Guardar</button>
        </div>
        </form>
        <!-- /.box-body -->
    </div>

</div>

@endsection