@extends('back.app')

@section('title','Editar Sede')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar Sede</h3>
            </div>


            <form method="POST" action="{{route('sede.update',$sede->idsede)}}">

                {{csrf_field()}}
                {!! method_field('PUT') !!}
                <div class="box-body">
                    <div class="form-group {{ $errors->has('sede') ? ' has-error' : '' }}">
                        <label>Sede:</label>

                        <input type="text" class="form-control" name="sede" id="sede" value="{{ (old('sede'))? old('sede'): $sede->sede  }}" required>
                        {!! $errors->first('sede','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('sede') ? ' has-error' : '' }}">
                        <label>Dirección:</label>

                        <input type="text" class="form-control" name="direccion" id="direccion" value="{{ (old('direccion'))? old('direccion'): $sede->direccion  }}" required>
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