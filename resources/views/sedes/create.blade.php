@extends('back.app')

@section('title','Registrar Subgerencia')

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Registrar Sede</h3>
        </div>


        <form method="POST" action="{{route('sede.store')}}">

        {{csrf_field()}}
        <div class="box-body">
            <div class="form-group {{ $errors->has('sede') ? ' has-error' : '' }}">
                <label>Sede:</label>

                <input type="text" class="form-control" name="sede" id="sede" value="{{old('sede')}}" required>
                {!! $errors->first('sede','<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('sede') ? ' has-error' : '' }}">
                <label>Dirección:</label>

                <input type="text" class="form-control" name="direccion" id="direccion" value="{{old('direccion')}}" required>
            {!! $errors->first('direccion','<span class="help-block">:message</span>') !!}

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