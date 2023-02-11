@extends('layouts.core')

@section('title', 'Edit | Cohort Management')
    
@section('content')
    @include('cohorts.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Cohort Details</h5>
            <div class="card-content p-2">
                {{ Form::model($cohort, ['route' => ['cohorts.update', $cohort], 'method' => 'PATCH', 'class' => 'form']) }}
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
