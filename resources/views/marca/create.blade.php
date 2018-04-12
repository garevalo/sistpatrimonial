@extends('back.app')

@section('title','Registrar '. $modulo)

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Registrar <?= ucwords($modulo) ?></h3>
        </div>


        <form method="POST" action="{{route('marca.store')}}">

            {{csrf_field()}}
            <div class="box-body">
                <div class="form-group {{ $errors->has('marca') ? ' has-error' : '' }}">
                    <label>Marca:</label>

                    <input type="text" class="form-control" name="marca" id="marca" value="{{old('marca')}}" required>
                    {!! $errors->first('marca','<span class="help-block">:message</span>') !!}
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