@extends('layouts.core')

@section('title', 'Create Log Frame')
    
@section('content')
    @include('log_frames.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Log Frame</h5>
            <div class="card-content p-2">
                {{ Form::open(['route' => 'log_frames.store', 'method' => 'POST', 'class' => 'form']) }}
                    @include('log_frames.form')
                    <div class="text-center">
                        <a href="{{ route('log_frames.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
