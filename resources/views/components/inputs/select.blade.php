<div class="form-group">
    {!! Form::label($name, $label) !!} <br>
    {!! Form::select($name, $data, $value ?? '', ['class' => 'form-control '. ($errors->has($name) ? 'is-invalid' : '')]) !!}

    @error($name)
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
