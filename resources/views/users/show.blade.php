@extends('layouts.main')

@section('title', 'View')

@section('content')

    @component('components.card')

        @slot('card_header')
            <h2 class="card-header-title mb-3">{{ $user->identity->full_name }}</h2>
            <!-- Text -->
            <p class="mb-0"><i class="fas fa-calendar mr-2"></i>{{ $user->identity->date_of_birth }}</p>
        @endslot

        @slot('card_body')
            <div class="container-fluid row">
                <div class="col-md-3 text-md-right">
                    <p class="card-text">Username: </p>
                    <p class="card-text">Email: </p>
                    <p class="card-text">Phone Number: </p>
                    <p class="card-text">Status: </p>
                </div>
                <div class="col-md-9">
                    <p class="card-text">{{ $user->username }}</p>
                    <p class="card-text">{{ $user->identity->email }}</p>
                    <p class="card-text">{{ $user->identity->phone_number }}</p>
                    <p class="card-text">{{ $user->status }}</p>
                </div>
            </div>

            <div class="row float-md-right">
                @if($user->deleted_at == null)
                    @if(Auth::id() == $user->id || Auth::user()->can('edit users'))
                        {!! Form::open(['route' => ['identities.edit', $user->identity->id], 'method' => 'get']) !!}
                        <button type="submit" class="btn btn-outline-orange">
                            Edit
                        </button>
                        {!! Form::close(); !!}

                        {!! Form::open(['route' => ['users.edit', $user->id], 'method' => 'get']) !!}
                        <button type="submit" class="btn btn-outline-primary">
                            Change Password
                        </button>
                        {!! Form::close(); !!}

                        @can('delete', $user)
                            @if(!$user->hasRole('admin'))
                                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Deactivate', ['class' => 'btn btn-outline-danger confirm',
                                    'data-confirm' => "Are you sure want to deactivate $user->username account?"]) !!}
                                {!! Form::close(); !!}
                            @endif
                        @endcan
                    @endif
                @else
                    @can('restore users')
                        {!! Form::open(['route' => ['users.restore', $user->id], 'method'=>'put']) !!}
                        {!! Form::submit('Restore', ['class' => 'btn btn-outline-danger confirm',
                            'data-confirm' => "Are you sure want to restore $user->username account?"]) !!}
                        {!! Form::close(); !!}
                    @endcan
                @endif
            </div>

        @endslot

    @endcomponent

    {{--    Roles Content--}}
    @if((Auth::user()->can('view user_roles') || $user->id == Auth::id()) && $user->deleted_at == null)
        @component('components.card')
            @slot('card_header')
                <h4>Roles</h4>
            @endslot

            @slot('card_body')
                @forelse($user->roles as $role)
                    <li class="card-text">
                        <a href="{{ route('roles.show', $role['id']) }}">
                            {{ ucwords($role['name']) }}
                        </a>

                        @can('delete user_roles')
                            @if($role->name != 'admin')
                                {!! Form::open(['route' => ['user_roles.destroy', $user->id, $role], 'method' => 'delete']) !!}
                                {!! Form::submit('Remove', ['class' => 'btn btn-link text-danger confirm',
            'data-confirm' => "Are you sure you want to remove {$role['name']} role?"]) !!}
                                {!! Form::close(); !!}
                            @endif
                        @endcan

                    </li>
                @empty
                    <p class="card-text">No Role Yet</p>
                @endforelse

                @can('create', App\Models\UserRole::class)
                    <div class="row float-md-right">

                        {!! Form::open(['route' => ['user_roles.create', $user->id], 'method' => 'get']) !!}
                        {!! Form::submit("Assign New Role", ['class' => 'btn btn-outline-deep-orange float-md-right']) !!}
                        {!! Form::close(); !!}

                    </div>
                @endcan

            @endslot

        @endcomponent
    @endif


    {{--    Learning Content--}}
    @if($user->hasRole('student') && (Auth::user()->can('view student_courses')
|| $user->id == Auth::id()))

        @component('components.card')
            @slot('card_header')
                <h4>Learning</h4>
            @endslot

            @slot('card_body')
                @forelse($user->courses_taking as $stu_course)
                    <li class="card-text">
                        <a href="{{ route('courses.show', $stu_course['course']['id']) }}">
                            {{ $stu_course['course']['code'] . ': ' .  $stu_course['course']['name'] }}
                        </a>

                        @if(Auth::user()->can('delete student_courses'))
                            {!! Form::open(['route' => ['student_courses.destroy', $stu_course['id']], 'method' => 'delete']) !!}
                            {!! Form::submit('Remove', ['class' => 'btn btn-link text-danger confirm',
        'data-confirm' => "Are you sure you want to remove {$stu_course['course']['code']} from learning?"]) !!}
                            {!! Form::close(); !!}
                        @endif
                    </li>
                @empty
                    <p class="card-text">No Course Yet</p>
                @endforelse

                @if(Auth::user()->can('create student_courses'))
                    <div class="row float-md-right">

                        {!! Form::open(['route' => ['student_courses.create', $user->id], 'method' => 'get']) !!}
                        {!! Form::submit("Enroll New Course", ['class' => 'btn btn-outline-deep-orange float-md-right']) !!}
                        {!! Form::close(); !!}

                    </div>
                @endif

            @endslot

        @endcomponent

    @endif

    {{--    Teaching Content--}}
    @if($user->hasRole('instructor') && (Auth::user()->can('view instructor_courses')
|| $user->id == Auth::id()))

        @component('components.card')
            @slot('card_header')
                <h4>Teaching</h4>
            @endslot

            @slot('card_body')
                @forelse($user->courses_teaching as $course)
                    <li class="card-text">
                        <a href="{{ route('courses.show', $course['id']) }}">
                            {{ $course['code'] . ': ' .  $course['name'] }}
                        </a>
                    </li>
                @empty
                    <p class="card-text">No Course Yet</p>
                @endforelse
            @endslot

        @endcomponent

    @endif




@endsection
