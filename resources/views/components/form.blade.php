<div class="card col-6 m-auto">
    <h5 class="card-header blue-gradient white-text text-center py-4">
        <strong>{{ $title }}</strong>
    </h5>

    <div class="card-body px-lg-5">

        {!! Form::open($route) !!}

        {{ $form_body }}

        <div class="form-group">
            {!! Form::submit(explode(' ', $title)[0], ['class'=>'btn btn-outline-primary']) !!}
        </div>


        {!! Form::close() !!}

    </div>

</div>

