@extends('layouts.main')

@section('title', 'Update Course')

@section('content')

    @php
        $route = ['route'=> ['courses.update', $course->id], 'method' => 'put'];
    @endphp

    @component('components.form', ['route' => $route, 'title' => 'Update Course'])
        @slot('form_body')

            @component('components.inputs.academic', ['y1' => $course->academic_y1 ?? date('Y'),
            'y2' => $course->academic_y2 ?? date('Y') + 1])
            @endcomponent

            @component('components.inputs.select', ['name'=>'semester', 'label'=>'Semester',
                'data'=> [1 => 1, 2, 3, 4, 5, 6, 7, 8], 'value' => $course->semester ?? 1])
            @endcomponent

            @component('components.inputs.text', ['name'=>'name', 'label' =>'Course Name', 'value' => $course->name])
            @endcomponent

            @component('components.inputs.text', ['name'=>'code', 'label' =>'Course Code', 'value' => $course->code])
            @endcomponent

            @component('components.inputs.select', ['name'=>'department_id', 'label'=>'Department',
                'value' => $course->department_id ?? -1,'data'=> $departments])
            @endcomponent

            @component('components.inputs.select', ['name'=>'taught_by', 'label'=>'Instructor',
                'data' => $instructors, 'value' => $course->taught_by])
            @endcomponent

            @component('components.inputs.textarea', ['name'=>'description', 'label' =>'Course Description',
                'value' => $course->description ?? ''])
            @endcomponent

        @endslot
    @endcomponent

@endsection
