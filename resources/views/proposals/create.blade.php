@extends('layouts.core')

@section('title', 'Create Proposal')
    
@section('content')
    @include('proposals.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Proposal</h5>
            <div class="card-content p-2">
                {{ Form::open(['route' => 'proposals.store', 'method' => 'POST', 'class' => 'form']) }}
                    @include('proposals.form')
                    <div class="text-center">
                        <a href="{{ route('proposals.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
