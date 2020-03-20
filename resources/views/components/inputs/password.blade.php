<div class="form-group">
    {!! Form::label($name, $label) !!}
    {!! Form::password($name, ['class' => 'form-control '. ($errors->has($name) ? 'is-invalid' : '')]) !!}

    @error($name)
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
