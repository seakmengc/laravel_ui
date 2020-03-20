@extends('layouts.main')

@section('title', "Roles")

@section('content')

    <table id="myTable" class="cell-border display hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
        </tr>
        </thead>

        <tbody>
        @forelse($roles as $role)
            <tr>
                <td>
                    @can('view roles')
                        <a href="{{ route('roles.show', $role->id) }}">{{ $role->id }}</a>
                    @else
                        {{ $role->id }}
                    @endcan
                </td>
                <td>{{ ucwords($role->name) }}</td>
                <td>{{ $role->description }}</td>
            </tr>
        @empty
            <tr>
                <td>Empty</td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
