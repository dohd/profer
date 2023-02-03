@extends('layouts.core')

@section('title', 'Create Proposal')
    
@section('content')
{{-- <div id="main" class="main"> --}}
    @include('proposals.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Proposal Details</h5>
            <div class="card-content p-2">
                {{ Form::open(['route' => 'proposals.store', 'method' => 'POST', 'class' => 'form']) }}
                    @include('proposals.form')
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
