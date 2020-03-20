@extends('layouts.main')

@section('title', 'Assign New Role')

@section('content')

    @php
        $route = ['route' => ['user_roles.store', $user->id], 'method' => 'post'];
    @endphp

    @component('components.form', ['route' => $route, 'title' => 'Assign New Role'])
        @slot('form_body')

            @component('components.inputs.select', ['name' => 'name', 'label' => 'Role', 'data' => $roles,
                'value' => array_key_first($roles)])
            @endcomponent

        @endslot
    @endcomponent

@endsection
