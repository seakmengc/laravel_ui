@extends('layouts.main')

@section('title', 'Log In')

@section('content')

    @component('components.form', ['route' => ['route' => ['login'], 'method' => 'post'],
     'title' => 'Log In'])

        @slot('form_body')
            @error('all')
            <p class="text-danger">{{ $message }}</p>
            @enderror

            @component('components.inputs.text', ['name' => 'username', 'label'=>'Username'])
            @endcomponent

            @component('components.inputs.password', ['name' => 'password', 'label'=>'Password'])
            @endcomponent

        @endslot

    @endcomponent

@endsection

