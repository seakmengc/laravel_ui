@extends('layouts.main')

@section('title', 'Update Department')

@section('content')

    @component('components.form', ['route' => ['route' => ['departments.update', $department->id], 'method'=>'put'],
'title' => 'Update Department'])

        @slot('form_body')

            @component('components.inputs.text', ['name' => 'code', 'label' => 'Code', 'value' => $department->code])
            @endcomponent

            @component('components.inputs.text', ['name' => 'name', 'label' => 'Name', 'value' => $department->name])
            @endcomponent

            @component('components.inputs.select', ['name' => 'faculty_id', 'label' => 'Faculty',
'data' => $faculties, 'value' => $department->faculty_id])
            @endcomponent

        @endslot
    @endcomponent

@endsection


