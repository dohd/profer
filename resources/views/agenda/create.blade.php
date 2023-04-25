@extends('layouts.core')

@section('title', 'Create Agenda')
    
@section('content')
    @include('agenda.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Agenda</h5>
            <div class="card-content p-2">
                {{ Form::open(['route' => 'agenda.store', 'method' => 'POST', 'class' => 'form']) }}
                    @include('agenda.form')
                    <div class="text-center">
                        <a href="{{ route('agenda.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
