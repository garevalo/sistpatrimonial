<div class="form-group-sm {{ $errors->has($name) ? ' has-error' : '' }}">
  {!! Form::label($name, $label ,['class' => 'control-label'] ) !!}
  {!! Form::text($name, (old($name))? old($name) : $value , array_merge(['class' => 'form-control'], $attributes)) !!}

  {!! $errors->first($name,'<span class="help-block">:message</span>') !!}
</div>