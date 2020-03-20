<div class="form-group">
    {!! Form::label('academic') !!}
    <div class="input-group">
        {!! Form::number('academic_y1', $y1 ?? date("Y"), ['class' => 'form-control half '. ($errors->has('academic_y1') ? 'is-invalid' : '')]) !!}
        {!! Form::number('academic_y2', $y2 ?? date("Y") + 1, ['class' => 'form-control '. ($errors->has('academic_y2') ? 'is-invalid' : '')]) !!}
    </div>

    @error('academic_y1')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    @error('academic_y2')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    @error('academic')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
