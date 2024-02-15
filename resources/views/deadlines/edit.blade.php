@extends('layouts.core')

@section('title', 'Edit | Deadline Management')
    
@section('content')
    @include('deadlines.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Deadline Details</h5>
            <div class="card-content p-2">
                {{ Form::model($deadline, ['route' => ['deadlines.update', $deadline], 'method' => 'PATCH', 'class' => 'form']) }}
                    @include('deadlines.form')
                    <div class="text-center">
                        <a href="{{ route('deadlines.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
