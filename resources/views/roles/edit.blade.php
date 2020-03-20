@extends('layouts.main')

@php
    $title = 'Update Role';
@endphp

@section('title', $title)

@section('content')

    @php
        $route = ['route' => ['roles.update', $role->id], 'method' => 'put'];
    @endphp

    @component('components.form', ['route' => $route, 'title' => $title])
        @slot('form_body')

            @component('components.inputs.text', ['name' => 'name', 'label' => 'Name (lowercase)*',
'value' => $role->name])
            @endcomponent

            <p>Permissions:</p>
            <div class="pl-5">
                @foreach($all_available_permissions as $key => $values)
                    @component('components.inputs.crud_checkboxes', ['name' => $key,
'value' => $permissions[$key] ?? [], 'data' => $values])
                    @endcomponent
                @endforeach
            </div>

            @component('components.inputs.textarea', ['name' => 'description', 'label' => 'Description*',
'value' => $role->description])
            @endcomponent


        @endslot
    @endcomponent

@endsection
