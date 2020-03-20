@extends('layouts.main')

@section('title', 'Update Info')

@section('content')

    @component('components.form', ['route' => ['route' => ['identities.update', $identity->id], 'method' => 'put'],
     'title' => 'Update Info'])

        @slot('form_body')

            @component('components.inputs.text', ['name' => 'first_name', 'label' => 'First Name',
'value' => $identity->first_name])
            @endcomponent

            @component('components.inputs.text', ['name' => 'last_name', 'label' => 'Last Name',
'value' => $identity->last_name])
            @endcomponent

            @component('components.inputs.date', ['name' => 'dob', 'label' => 'Date of Birth',
'value' => $identity->dob])
            @endcomponent

            @component('components.inputs.email', ['name'=>'email', 'label'=>'Email',
'value' => $identity->email])
            @endcomponent

            @component('components.inputs.text', ['name' => 'phone_number', 'label' => 'Phone Number',
'value' => $identity->phone_number])
            @endcomponent


        @endslot

    @endcomponent

@endsection



