@extends('layouts.main')

@section('title', "Faculties")

@section('content')

    <table id="myTable" class="cell-border display hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($faculties as $faculty)
            <tr>
                <td>
                    @can('view faculties')
                        <a href="/faculties/{{$faculty->id}}">{{$faculty->id}}</a>
                    @else
                        {{ $faculty->id }}
                    @endcan
                </td>
                <td>{{$faculty->code}}</td>
                <td>{{$faculty->name}}</td>
                <td>{{ $faculty->status }}</td>
            </tr>
        @empty
            <tr>
                <td>Empty</td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
