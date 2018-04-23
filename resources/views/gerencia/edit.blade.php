@extends('back.app')

@section('title','Editar '.$modulo)


@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar {{$modulo}}</h3>
            </div>
            <form method="POST" action="{{route('gerencia.update',$gerencia->idgerencia )}}">

                {{csrf_field()}}
                {!! method_field('PUT') !!}

                <div class="box-body">

                    <div class="form-group-sm {{ $errors->has('centrocosto') ? ' has-error' : '' }}">
                        <label>Cod Centro Costo:</label>
                        <input type="text" class="form-control" name="centrocosto" id="centrocosto" value="{{ (old('centrocosto'))? old('centrocosto'): $gerencia->centrocosto  }}" required>
                        {!! $errors->first('centrocosto','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('gerencia') ? ' has-error' : '' }}">
                        <label>Gerencia:</label>
                        <input type="text" class="form-control" name="gerencia" id="gerencia" value="{{ (old('gerencia'))? old('gerencia'): $gerencia->gerencia  }}" required>
                        {!! $errors->first('gerencia','<span class="help-block">:message</span>') !!}
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>

    </div>

@endsection