@extends('layouts.core')

@section('title', 'Edit | Narrative Management')
    
@section('content')
    @include('narratives.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Narrative Details</h5>
            <div class="card-content p-2">
                {{ Form::model($narrative, ['route' => ['narratives.update', $narrative], 'method' => 'PATCH', 'class' => 'form']) }}
                    @include('narratives.form')
                    <div class="text-center">
                        <a href="{{ route('narratives.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
