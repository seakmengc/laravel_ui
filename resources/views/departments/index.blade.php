@extends('layouts.main')

@section('title', "Departments")

@section('content')

    <table id="myTable" class="cell-border display hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Faculty Name</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($departments as $department)
            <tr>
                <td>
                    @can('view departments')
                        <a href="{{ route('departments.show', $department->id) }}">{{$department->id}}</a>
                    @else
                        {{ $department->id }}
                    @endcan
                </td>
                <td>{{$department->code}}</td>
                <td>{{$department->name}}</td>
                <td>{{ $department->faculty['name'] }}</td>
                <td>{{ $department->status }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Empty</td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
