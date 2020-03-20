@extends('layouts.main')

@section('title', "View $department->name Faculty")

@section('content')
    @component('components.card')

        @slot('card_header')
            <h4>Department: {{ $department->name }}</h4>
        @endslot

        @slot('card_body')
            <p class="card-text">Code: {{ $department->code }}</p>
            <p class="card-text">Faculty Name:
                @can('view faculties')
                    <a href="{{ route('faculties.show', $department->faculty['id']) }}">
                        {{ $department->faculty['name'] }}
                    </a>
                @else
                    {{ $department->faculty['name'] }}
                @endcan
            </p>
            <p class="card-text">Faculty Code: {{ $department->faculty['code'] }}</p>
            <p class="card-text">Status: {{ $department->status }}</p>

            @if($department->deleted_at == null)
                @can('delete departments')

                    {!! Form::open(['route' => ['departments.destroy', $department->id], 'method'=>'delete']) !!}
                    {!! Form::token() !!}

                    <button type="submit" class="btn btn-danger float-md-right confirm"
                            data-confirm="Do you want to remove {{ $department->name }} department?">
                        Remove
                    </button>

                    {!! Form::close(); !!}

                @endcan

                @can('edit departments')

                    {!! Form::open(['route' => ['departments.edit', $department->id], 'method' => 'get']) !!}
                    {!! Form::token() !!}

                    <button type="submit" class="btn btn-light-green float-md-right">
                        Edit
                    </button>

                    {!! Form::close(); !!}

                @endcan
            @elseif(Auth::user()->can('restore departments'))
                {!! Form::open(['route' => ['departments.restore', $department->id], 'method' => 'put']) !!}
                {!! Form::token() !!}

                <button type="submit" class="btn btn-light-green float-md-right">
                    Restore
                </button>

                {!! Form::close(); !!}
            @endif

        @endslot

    @endcomponent


@endsection
