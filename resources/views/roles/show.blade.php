@extends('layouts.main')

@section('title', 'View Role')

@section('content')

    @component('components.card')

        @slot('card_header')
            <h3>Role: {{ ucwords($role->name) }}</h3>
        @endslot

        @slot('card_body')
            <h5>Description: {{ $role->description }}</h5>

            <h5>Permissions:</h5>
            @forelse($permissions as $key => $section)
                @if(count($section) != 0)
                    <h6 class="pl-2"><b>{{ $key }}:</b></h6>
                    @foreach($section as $permission)
                        <span class="pl-5">{{ $permission }}</span>
                    @endforeach
                @endif
            @empty
                <p class="pl-2">No permission yet</p>
            @endforelse

            @can('delete roles')
                {!! Form::open(['route' => ['roles.destroy', $role->id], 'method'=>'delete']) !!}
                {!! Form::token() !!}

                <button type="submit" class="btn btn-danger float-md-right confirm"
                        data-confirm="Do you want to remove {{ $role->name }} role?">
                    Remove
                </button>

                {!! Form::close(); !!}
            @endcan

            @can('edit roles')
                {!! Form::open(['route' => ['roles.edit', $role->id], 'method' => 'get']) !!}
                {!! Form::token() !!}

                <button type="submit" class="btn btn-light-green float-md-right">
                    Edit
                </button>

                {!! Form::close(); !!}
            @endcan

        @endslot

    @endcomponent

@endsection
