@extends('layouts.core')

@section('title', 'Create | Participant List Management')
    
@section('content')
    @include('participant_lists.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Participant List</h5>
            <div class="card-content p-2">
                {{ Form::open(['route' => 'participant_lists.store', 'method' => 'POST', 'class' => 'form']) }}
                    @include('participant_lists.form')
                    <div class="text-center">
                        <a href="{{ route('participant_lists.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
