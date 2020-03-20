<div class="form-group">
    {!! Form::label($name, $label) !!} <br>
    {!! Form::date($name, date('Y-m-d', strtotime($value ?? now())), ['class'=>'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) !!}

    @error($name)
    <p class="text-danger">{{ $message }}</p>
    @enderror

</div>
