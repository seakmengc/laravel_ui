<div class="form-group">
    {!! Form::label($name) !!}
    {!! Form::email($name, $value ?? '', ['class'=>'form-control '. ($errors->has($name) ? 'is-invalid' : '')]) !!}

    @error($name)
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
