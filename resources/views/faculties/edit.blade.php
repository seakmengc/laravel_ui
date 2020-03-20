@extends('layouts.main')

@section('title', 'Update Faculty')

@section('content')

    @component('components.form', ['route' => ['route' => ['faculties.update', $faculty->id], 'method'=>'put'],
'title' => 'Update Faculty'])

        @slot('form_body')

            @component('components.inputs.text', ['name' => 'code', 'label' => 'Code', 'value' => $faculty->code])
            @endcomponent

            @component('components.inputs.text', ['name' => 'name', 'label' => 'Name', 'value' => $faculty->name])
            @endcomponent

        @endslot
    @endcomponent

@endsection

