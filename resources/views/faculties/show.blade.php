@extends('layouts.main')

@section('title', "View $faculty->name Faculty")

@section('content')

    @component('components.card')

        @slot('card_header')
            <h4>Faculty: {{ $faculty->name }}</h4>
        @endslot

        @slot('card_body')
            <p class="card-text">Code: {{ $faculty->code }}</p>
            <p class="card-text">
                Departments under this faculty:
            </p>
            <ul>
                @forelse($faculty->departments as $dept)
                    <li>
                        @can('view departments')
                            <a href="{{ route('departments.show', $dept->id) }}">
                                {{ $dept->code . ': ' .  $dept->name }}
                            </a>
                        @else
                            {{ $dept->code . ': ' .  $dept->name }}
                        @endcan
                    </li>
                @empty
                    <li>Empty</li>
                @endforelse
            </ul>
            <p class="card-text">Status: {{ $faculty->status }}</p>

            @if($faculty->deleted_at == null)
                @can('delete faculties')
                    {!! Form::open(['route' => ['faculties.destroy', $faculty->id], 'method'=>'delete']) !!}
                    {!! Form::token() !!}

                    <button type="submit" class="btn btn-danger float-md-right confirm"
                            data-confirm="Do you want to remove {{ $faculty->name }} faculty?">
                        Remove
                    </button>

                    {!! Form::close(); !!}

                @endcan

                @can('edit faculties')

                    {!! Form::open(['route' => ['faculties.edit', $faculty->id], 'method' => 'get']) !!}
                    {!! Form::token() !!}

                    <button type="submit" class="btn btn-light-green float-md-right">
                        Edit
                    </button>

                    {!! Form::close(); !!}

                @endcan
            @elseif(Auth::user()->can('restore faculties'))
                {!! Form::open(['route' => ['faculties.restore', $faculty->id], 'method' => 'put']) !!}
                {!! Form::token() !!}

                <button type="submit" class="btn btn-light-green float-md-right">
                    Restore
                </button>

                {!! Form::close(); !!}
            @endif

        @endslot

    @endcomponent
@endsection

