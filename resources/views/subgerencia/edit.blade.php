@extends('back.app')

@section('title','Editar Subgerencia')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Registrar Subgerencia</h3>
            </div>
            <form method="POST" action="{{route('subgerencia.update',$subgerencia->idsubgerencia )}}">

                {{csrf_field()}}
                {!! method_field('PUT') !!}

                <div class="box-body">
                    <div class="form-group-sm {{ $errors->has('centrocosto') ? ' has-error' : '' }}">
                        <label>Cod Centro Costo:</label>
                        <input type="text" class="form-control" name="centrocosto" id="centrocosto" value="{{ (old('centrocosto'))? old('centrocosto'): $gerencia->centrocosto  }}" required>
                        {!! $errors->first('centrocosto','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('subgerencia') ? ' has-error' : '' }}">
                        <label>Subgerencia:</label>

                        <input type="text" class="form-control" name="subgerencia" id="subgerencia" value="{{ (old('subgerencia'))? old('subgerencia'): $subgerencia->subgerencia  }}" required>
                        {!! $errors->first('subgerencia','<span class="help-block">:message</span>') !!}
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>

    </div>

@endsection