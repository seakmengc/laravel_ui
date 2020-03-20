@extends('layouts.main')

@section('title', "View $course->name Course")

@section('content')
    @component('components.card')

        @slot('card_header')
            <h4>Course: {{ $course->name }}</h4>
        @endslot

        @slot('card_body')
            <p>Academic: {{ $course->academic }}</p>
            <p>Semester: {{ $course->semester }}</p>
            <p>Code: {{ $course->code }}</p>
            <p>Name: {{ $course->name }}</p>
            <p>Department:
                @can('view departments')
                    <a href="{{ route('departments.show', $course->department->id) }}">
                        {{ $course->department->name }}
                    </a>
                @else
                    {{ $course->department->name }}
                @endcan
            </p>
            <p>Instructor:
                @if(Auth::user()->can('view users') && $course->taught_by != null)
                    <a href="{{ route('users.show', $course->taught_by) }}">
                        {{ $course->instructor->identity->full_name }}
                    </a>
                @else
                    {{ $course->instructor->identity->full_name ?? 'N/A' }}
                @endcan
            </p>
            <p>Status: {{ $course->status }}</p>

            @if($course->deleted_at == null)
                @can('delete courses')
                    {!! Form::open(['route' => ['courses.destroy', $course->id], 'method'=>'delete']) !!}
                    {!! Form::token() !!}

                    <button type="submit" class="btn btn-danger float-md-right confirm"
                            data-confirm="Do you want to remove {{ $course->name }} course?">
                        Remove
                    </button>

                    {!! Form::close() !!}
                @endcan

                @can('edit courses')
                    {!! Form::open(['route' => ['courses.edit', $course->id], 'method' => 'get']) !!}
                    {!! Form::token() !!}

                    <button type="submit" class="btn btn-light-green float-md-right">
                        Edit
                    </button>

                    {!! Form::close(); !!}

                @endcan
            @else

                @can('delete courses')
                    {!! Form::open(['route' => ['courses.restore', $course->id], 'method' => 'put']) !!}
                    {!! Form::token() !!}

                    <button type="submit" class="btn btn-light-green float-md-right">
                        Restore
                    </button>

                    {!! Form::close(); !!}
                @endcan

            @endif

        @endslot

    @endcomponent


@endsection
