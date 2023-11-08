@extends('layouts.core')

@section('title', 'Edit | Project Budget')
    
@section('content')
    @include('budgets.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Project Budget</h5>
            <div class="card-content p-2">
                {{ Form::model($budget, ['route' => ['budgets.update', $budget], 'method' => 'PATCH', 'class' => 'form']) }}
                    @include('budgets.form')
                    <div class="text-center">
                        <a href="{{ route('budgets.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
