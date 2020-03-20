@extends('layouts.main')

@section('title', 'Teaching New Course')

@section('content')

    @php
        $route = ['route' => ['instructor_courses.store'], 'method' => 'post'];
    @endphp

    @component('components.form', ['route' => $route, 'title' => 'Teaching New Course'])
        @slot('form_body')

            @component('components.inputs.select', ['name' => 'course_id', 'label' => 'Course', 'data' => $courses,
                'value' => array_key_first($courses)])
            @endcomponent

        @endslot
    @endcomponent

@endsection
