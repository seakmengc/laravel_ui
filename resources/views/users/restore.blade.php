@extends('layouts.main')

@section('title', 'Restore Account Confirmation')


@section('content')

    @component('components.card')
        @slot('card_header')
            <h3>Your account has been deactivated.</h3>
        @endslot

        @slot('card_body')
            <h5>Do you want to restore your account?</h5>

            <div class="row">
                {!! Form::open(['route' => ['users.restore', $user->id], 'method' => 'put']) !!}

                {!! Form::submit('Recover', ['class' => 'btn btn-outline-primary']) !!}

                {!! Form::token() !!}

                {!! Form::close() !!}

                <a href="/users/login" class="btn btn-outline-secondary float-right">Cancel</a>
            </div>

        @endslot

    @endcomponent

@endsection
