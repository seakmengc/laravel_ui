@extends('layouts.main')

@section('title', 'Register')

@section('content')

    @component('components.form', ['route' => ['route' => ['users.store'], 'method' => 'post'],
     'title' => 'Register'])

        @slot('form_body')
            @component('components.inputs.text', ['name' => 'username', 'label' => 'Username'])
            @endcomponent

            @component('components.inputs.password', ['name' => 'password', 'label'=>'Password'])
            @endcomponent

            @component('components.inputs.password', ['name' => 'password_confirmation', 'label'=>'Password Confirmation'])
            @endcomponent

            {!! Form::label('User Roles:') !!} <br>
            @foreach($role_names as $index => $name)
                {!! Form::checkbox('roles[]', $name) !!}
                {!! Form::label($name) !!}
            @endforeach
            @error('roles.0')
            <p class="text-danger">{{ "The selected roles are invalid" }}</p>
            @enderror

            @component('components.inputs.text', ['name' => 'first_name', 'label' => 'First Name'])
            @endcomponent

            @component('components.inputs.text', ['name' => 'last_name', 'label' => 'Last Name'])
            @endcomponent

            @component('components.inputs.date', ['name' => 'dob', 'label'=> 'Date of Birth'])
            @endcomponent

            @component('components.inputs.email', ['name' => 'email', 'label' => 'Email'])
            @endcomponent

            @component('components.inputs.text', ['name' => 'phone_number', 'label' => 'Phone Number'])
            @endcomponent

        @endslot

    @endcomponent

@endsection
