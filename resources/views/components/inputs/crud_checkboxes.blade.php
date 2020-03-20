<div class="form-group">
    {!! Form::label($name) !!}

    @foreach($data as $permission)
        {!! Form::checkbox($name . '[]', $permission, in_array($permission, $value ?? [$permission])); !!}
        {!! Form::label($permission) !!}
    @endforeach

    @error($name)
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
