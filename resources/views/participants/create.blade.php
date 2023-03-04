@extends('layouts.core')

@section('title', 'Create | Participant Management')
    
@section('content')
    @include('participants.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Participant</h5>
            <div class="card-content p-2">
                {{ Form::open(['route' => 'participants.store', 'method' => 'POST', 'class' => 'form']) }}
                    @include('participants.form')
                    <div class="text-center">
                        <a href="{{ route('participants.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
