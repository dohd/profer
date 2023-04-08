@extends('layouts.core')

@section('title', 'Create User Profile')
    
@section('content')
    @include('user_profiles.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create User Profile</h5>
            <div class="card-content p-2">
                {{ Form::open(['route' => 'user_profiles.store', 'method' => 'POST', 'class' => 'form']) }}
                    @include('user_profiles.form')
                    <div class="text-center">
                        <a href="{{ route('user_profiles.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary', 'disabled']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
