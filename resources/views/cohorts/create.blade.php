@extends('layouts.core')

@section('title', 'Create Cohort')
    
@section('content')
    @include('cohorts.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Cohort</h5>
            <div class="card-content p-2">
                {{ Form::open(['route' => 'cohorts.store', 'method' => 'POST', 'class' => 'form']) }}
                    @include('cohorts.form')
                    <div class="text-center">
                        <a href="{{ route('cohorts.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
