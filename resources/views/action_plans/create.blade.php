@extends('layouts.core')

@section('title', 'Create Action Plan')
    
@section('content')
{{-- <div id="main" class="main"> --}}
    @include('action_plans.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Action Plan</h5>
            <div class="card-content p-2">
                {{ Form::open(['route' => 'action_plans.store', 'method' => 'POST', 'class' => 'form']) }}
                    @include('action_plans.form')
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary">Cancel</button>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
{{-- </div> --}}
@stop
