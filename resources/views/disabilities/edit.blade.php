@extends('layouts.core')

@section('title', 'Edit | Disability Management')
    
@section('content')
    @include('disabilities.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Disability Details</h5>
            <div class="card-content p-2">
                {{ Form::open(['route' => 'disabilities.store', 'method' => 'POST', 'class' => 'form']) }}
                    @include('disabilities.form')
                    <div class="text-center">
                        <a href="{{ route('disabilities.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
