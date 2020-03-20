<div class="card col-6 m-auto">
    <h5 class="card-header info-color white-text text-center py-4">
        <strong>{{ ucfirst($form['btn_label']) }}</strong>
    </h5>

    <div class="card-body px-lg-5">
        {!! Form::open(['route' => $form['route'], 'method' => $form['method']]) !!}

        @include('layouts.partials.users.form')

        @if($form['route'] == 'users.store')
            @include('layouts.partials.identities.form')
        @endif

        <div class="form-group">
            {!! Form::submit($form['btn_label'], ['class'=>'btn btn-outline-primary']) !!}
        </div>

        {!! Form::token() !!}

        {!! Form::close() !!}
    </div>
</div>
