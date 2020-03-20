@extends('layouts.main')

@section('title', 'Create Info')

@section('content')

    @component('components.form', ['route' => ['route' => ['identities.create'], 'method' => 'post'],
     'title' => 'Create Info'])

        @slot('form_body')

            @component('components.inputs.text', ['name' => 'first_name', 'label' => 'First Name'])
            @endcomponent

            @component('components.inputs.text', ['name' => 'last_name', 'label' => 'Last Name'])
            @endcomponent

            @component('components.inputs.date', ['name' => 'dob', 'label' => 'Date of Birth'])
            @endcomponent

            @component('components.inputs.email', ['name'=>'email', 'label'=>'Email'])
            @endcomponent

            @component('components.inputs.text', ['name' => 'phone_number', 'label' => 'Phone Number'])
            @endcomponent


        @endslot

    @endcomponent

@endsection



