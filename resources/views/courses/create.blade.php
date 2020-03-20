@extends('layouts.main')

@section('title', 'Create Course')

@section('content')

    @php
        $route = ['route'=> 'courses.store', 'method'=>'post'];
    @endphp

    @component('components.form', ['route' => $route, 'title' => 'Create Course'])
        @slot('form_body')

            @component('components.inputs.academic', ['y1' => date('Y'),
            'y2' => date('Y') + 1])
            @endcomponent

            @component('components.inputs.select', ['name'=>'semester', 'label'=>'Semester',
                'data'=> [1 => 1, 2, 3, 4, 5, 6, 7, 8], 'value' => 1])
            @endcomponent

            @component('components.inputs.text', ['name'=>'name', 'label' =>'Course Name'])
            @endcomponent

            @component('components.inputs.text', ['name'=>'code', 'label' =>'Course Code'])
            @endcomponent

            @component('components.inputs.select', ['name'=>'department_id', 'label'=>'Department',
                'data' => $departments])
            @endcomponent

            @component('components.inputs.select', ['name'=>'taught_by', 'label'=>'Instructor',
                'data' => $instructors])
            @endcomponent

            @component('components.inputs.textarea', ['name'=>'description', 'label' =>'Course Description'])
            @endcomponent

        @endslot
    @endcomponent

@endsection
