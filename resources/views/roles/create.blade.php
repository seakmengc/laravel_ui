@extends('layouts.main')

@php
    $title = 'Create Role';
@endphp

@section('title', $title)

@section('content')

    @php
        $route = ['route' => ['roles.store'], 'method' => 'post'];
    @endphp

    @component('components.form', ['route' => $route, 'title' => $title])
        @slot('form_body')

            @component('components.inputs.text', ['name' => 'name', 'label' => 'Name (lowercase)*'])
            @endcomponent

            <p>Permissions:</p>
            <div class="pl-5">
                @foreach($all_available_permissions as $key => $values)
                    @component('components.inputs.crud_checkboxes', ['name' => $key, 'data' => $values])
                    @endcomponent
                @endforeach
            </div>

            @component('components.inputs.textarea', ['name' => 'description', 'label' => 'Description*'])
            @endcomponent

        @endslot
    @endcomponent

@endsection
