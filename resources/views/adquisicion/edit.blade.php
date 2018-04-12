@extends('back.app')

@section('title','Editar '. ucwords($modulo) )

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar {{ucwords($modulo)}}</h3>
            </div>


            <form method="POST" action="{{route( $modulo.'.update',$adquisicion->idadquisicion)}}">

                {{csrf_field()}}
                {!! method_field('PUT') !!}
                <div class="box-body">
                    <div class="form-group {{ $errors->has('adquisicion') ? ' has-error' : '' }}">
                        <label>Adquisición:</label>

                        <input type="text" class="form-control" name="adquisicion" id="adquisicion" value="{{ (old('adquisicion'))? old('adquisicion'): $adquisicion->adquisicion  }}" required>
                        {!! $errors->first('adquisicion','<span class="help-block">:message</span>') !!}
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