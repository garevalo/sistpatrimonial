@extends('back.app')

@section('title','Editar '. ucwords($modulo) )

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar {{ucwords($modulo)}}</h3>
            </div>


            <form method="POST" action="{{route( $modulo.'.update',$color->idcolor)}}">

                {{csrf_field()}}
                {!! method_field('PUT') !!}
                <div class="box-body">
                    <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
                        <label>Color:</label>

                        <input type="text" class="form-control" name="color" id="color" value="{{ (old('color'))? old('color'): $color->color  }}" required>
                        {!! $errors->first('color','<span class="help-block">:message</span>') !!}
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