@extends('layouts.core')

@section('title', 'Edit | Proposal Management')
    
@section('content')
    @include('proposals.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Proposal Details</h5>
            <div class="card-content p-2">
                {{ Form::model($proposal, ['route' => ['proposals.update', $proposal], 'method' => 'PATCH', 'class' => 'form']) }}
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
