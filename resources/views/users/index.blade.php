@extends('layouts.main')

@section('title', "Users")

@section('content')

    <table id="myTable" class="cell-border display hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>DOB</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Status</th>
        </tr>
        </thead>

        <tbody>
        @forelse($users as $user)
            <tr>
                <td>
                    @can('view users')
                        <a href="/users/{{ $user->id }}">{{ $user->id }}</a>
                    @else
                        {{ $user->id }}
                    @endcan
                </td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->identity['full_name'] }}</td>
                <td>{{ $user->identity['date_of_birth'] }}</td>
                <td>{{ $user->identity['email'] }}</td>
                <td>{{ $user->identity['phone_number'] }}</td>
                <td>{{ $user->status }}</td>
            </tr>
        @empty
            <tr>
                <td>Empty</td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
