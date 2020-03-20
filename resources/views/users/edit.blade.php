@extends('layouts.main')

@section('title', 'Change Password')

@section('content')

    @component('components.form', ['route' => ['route' => ['users.update', $user->id], 'method' => 'put'],
     'title' => 'Change Password'])

        @slot('form_body')

            @component('components.inputs.password', ['name' => 'old_password', 'label'=>'Old Password'])
            @endcomponent

            @component('components.inputs.password', ['name' => 'password', 'label'=>'Password'])
            @endcomponent

            @component('components.inputs.password', ['name' => 'password_confirmation', 'label'=>'Password Confirmation'])
            @endcomponent

        @endslot

    @endcomponent

@endsection

