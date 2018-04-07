@extends('back.app')

@section('title','Editar Cargo')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar {{$modulo}}</h3>
            </div>


            <form method="POST" action="{{route('cargo.update',$cargo->idcargo)}}">

                {{csrf_field()}}
                {!! method_field('PUT') !!}
                <div class="box-body">
                    <div class="form-group {{ $errors->has('cargo') ? ' has-error' : '' }}">
                        <label>Cargo:</label>

                        <input type="text" class="form-control" name="cargo" id="cargo" value="{{ (old('cargo'))? old('cargo'): $cargo->cargo }}" required>
                        {!! $errors->first('cargo','<span class="help-block">:message</span>') !!}
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