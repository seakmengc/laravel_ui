@extends('layouts.main')

@section('title', "Courses")

@section('content')

    <table id="myTable" class="cell-border display hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Academic</th>
            <th>Semester</th>
            <th>Code</th>
            <th>Name</th>
            <th>Department</th>
            <th>Instructor</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($courses as $course)
            <tr>
                <td>
                    @can('view courses')
                        <a href="{{ route('courses.show', $course->id) }}">{{$course->id}}</a>
                    @else
                        {{$course->id}}
                    @endcan
                </td>
                <td>{{ $course->academic }}</td>
                <td>{{ $course->semester }}</td>
                <td>{{ $course->code }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->department['name'] }}</td>
                <td>{{ $course->instructor->identity['full_name'] ?? 'N/A' }}</td>
                <td>{{ $course->status }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Empty</td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
