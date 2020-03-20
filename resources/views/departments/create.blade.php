@extends('layouts.main')

@section('title', 'Create Department')

@section('content')

    @component('components.form', ['route' => ['route' => ['departments.store'], 'method'=>'post'],
'title' => 'Create Department'])

        @slot('form_body')

            @component('components.inputs.text', ['name' => 'code', 'label' => 'Code'])
            @endcomponent

            @component('components.inputs.text', ['name' => 'name', 'label' => 'Name'])
            @endcomponent

            @component('components.inputs.select', ['name' => 'faculty_id', 'label' => 'Faculty',
'data' => $faculties, 'value' => array_key_first($faculties)])
            @endcomponent

        @endslot
    @endcomponent

@endsection


