@extends('layouts.core')

@section('title', 'Edit | Log Frame Management')
    
@section('content')
    @include('log_frames.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Log Frame Details</h5>
            <div class="card-content p-2">
                {{ Form::model($log_frame, ['route' => ['log_frames.update', $log_frame], 'method' => 'PATCH', 'class' => 'form']) }}
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
