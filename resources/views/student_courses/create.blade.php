@extends('layouts.main')

@section('title', 'Learning New Course')

@section('content')

    @php
        $route = ['route' => ['student_courses.store', $user->id], 'method' => 'post'];
    @endphp

    @component('components.form', ['route' => $route, 'title' => 'Learning New Course'])
        @slot('form_body')

            @component('components.inputs.select', ['name' => 'course_id', 'label' => 'Course', 'data' => $courses,
                'value' => array_key_first($courses)])
            @endcomponent

        @endslot
    @endcomponent

@endsection
