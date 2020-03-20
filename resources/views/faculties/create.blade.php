@extends('layouts.main')

@section('title', 'Create Faculty')

@section('content')

    @component('components.form', ['route' => ['route' => ['faculties.store'], 'method'=>'post'],
'title' => 'Create Faculty'])

        @slot('form_body')

            @component('components.inputs.text', ['name' => 'code', 'label' => 'Code'])
            @endcomponent

            @component('components.inputs.text', ['name' => 'name', 'label' => 'Name'])
            @endcomponent

        @endslot
    @endcomponent

@endsection

