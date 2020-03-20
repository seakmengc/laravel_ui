<div class="form-group">
    {!! Form::label($name, $label) !!}
    {!! Form::textarea($name, $value ?? '', ['class' => "form-control ". ($errors->has($name) ? 'is-invalid' : '')]) !!}

    @error($name)
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
