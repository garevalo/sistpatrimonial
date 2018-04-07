@extends('back.app')

@section('title','Registrar Subgerencia')

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Registrar Subgerencia</h3>
        </div>


        <form method="POST" action="{{route('subgerencia.store')}}">

        {{csrf_field()}}
        <div class="box-body">
            <div class="form-group {{ $errors->has('subgerencia') ? ' has-error' : '' }}">
                <label>Subgerencia:</label>
                <input type="text" class="form-control" name="subgerencia" id="subgerencia" value="{{old('subgerencia')}}" required>
                {!! $errors->first('subgerencia','<span class="help-block">:message</span>') !!}
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