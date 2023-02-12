@extends('layouts.core')

@section('title', 'Edit | Action Plan Management')
    
@section('content')
    @include('action_plans.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Action Plan</h5>
            <div class="card-content p-2">
                {{ Form::model($action_plan, ['route' => ['action_plans.update', $action_plan], 'method' => 'PATCH', 'class' => 'form']) }}
                    @include('action_plans.form')
                    <div class="text-center">
                        <a href="{{ route('action_plans.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
