@extends('back.app')

@section('title','Registrar Bien')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Registrar Bien</h3>
            </div>

            <form method="POST" action="{{route('bien.store')}}">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group-sm {{ $errors->has('codinventario') ? ' has-error' : '' }}">
                            <label>Código Inventario:</label>

                            <input type="text" class="form-control" name="codinventario" id="codinventario" value="{{old('codinventario')}}">
                            {!! $errors->first('codinventario','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('codpatrimonial') ? ' has-error' : '' }}">
                            <label>Código Patrimonial:</label>

                            <input type="text" class="form-control" name="codpatrimonial" id="codpatrimonial" value="{{old('codpatrimonial')}}">
                            {!! $errors->first('codpatrimonial','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('orden_compra') ? ' has-error' : '' }}">
                            <label>Orden de Compra:</label>

                            <input type="text" class="form-control" name="orden_compra" id="orden_compra" value="{{old('orden_compra')}}" required>
                            {!! $errors->first('orden_compra','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('idmarca') ? ' has-error' : '' }}">
                            <label>Marca:</label>
                            <select class="form-control" name="idmarca" id="idmarca" value="{{old('idmarca')}}" required>
                                <option>Seleccione Marca</option>
                            </select>
                            {!! $errors->first('idmarca','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('modelo') ? ' has-error' : '' }}">
                            <label>Modelo:</label>

                            <input type="text" class="form-control" name="modelo" id="modelo" value="{{old('modelo')}}" required>
                            {!! $errors->first('modelo','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('modelo') ? ' has-error' : '' }}">
                            <label>Color:</label>

                            <input type="text" class="form-control" name="color" id="color" value="{{old('color')}}" required>
                            {!! $errors->first('color','<span class="help-block">:message</span>') !!}
                        </div>  

                        <div class="form-group-sm {{ $errors->has('num_serie') ? ' has-error' : '' }}">
                            <label>Número Serie:</label>

                            <input type="text" class="form-control" name="num_serie" id="num_serie" value="{{old('num_serie')}}">
                            {!! $errors->first('num_serie','<span class="help-block">:message</span>') !!}
                        </div>
                        
                        

                    </div>
                    
                    <div class="col-md-6 col-xs-12">

                        <div class="form-group-sm {{ $errors->has('estado') ? ' has-error' : '' }}">
                            <label>Estado:</label>

                            <select name="estado" id="estado" class="form-control">
                                <option value="">Estado</option>
                               
                            </select>
                            {!! $errors->first('estado','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('orden_compra') ? ' has-error' : '' }}">
                            <label>Valor:</label>

                            <input type="text" class="form-control" name="orden_compra" id="orden_compra" value="{{old('orden_compra')}}" required>
                            {!! $errors->first('orden_compra','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('orden_compra') ? ' has-error' : '' }}">
                            <label>Modo de Adquisición:</label>

                            <input type="text" class="form-control" name="orden_compra" id="orden_compra" value="{{old('orden_compra')}}" required>
                            {!! $errors->first('orden_compra','<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group-sm {{ $errors->has('fecha_adquisicion') ? ' has-error' : '' }}">
                            <label>Fecha de Adquisición:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" name="fecha_adquisicion" id="fecha_adquisicion">
                            </div>
                            {!! $errors->first('fecha_adquisicion','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group-sm {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label>Descripción:</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control" required >{{old('descripcion')}}</textarea>
                            {!! $errors->first('descripcion','<span class="help-block">:message</span>') !!}
                        </div>

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

@section('javascript')
    @parent()

    <!-- InputMask -->
    <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

    <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <script>
        $(function () {
            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            //Money Euro
            $("[data-mask]").inputmask();
        });
    </script>

@endsection