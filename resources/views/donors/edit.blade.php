@extends('layouts.core')

@section('title', 'Edit | Donor Management')
    
@section('content')
    @include('donors.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Donor Details</h5>
            <div class="card-content p-2">
                {{ Form::model($donor, ['route' => ['donors.update', $donor], 'method' => 'PATCH', 'class' => 'form']) }}
                    @include('donors.form')
                    <div class="text-center">
                        <a href="{{ route('donors.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
