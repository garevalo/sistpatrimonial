<div class="form-group-sm {{ $errors->has($name) ? 'has-error' : '' }}">
    {!! Form::label($name, $label ,['class' => 'control-label'] ) !!}
    
    {{ Form::select($name, $options , $selected, array_merge(['placeholder' => $placeholder,'class'=>'form-control'],$attributes)) }}

    {!! $errors->first($name,'<span class="help-block">:message</span>') !!}
</div>
