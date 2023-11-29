@extends('layouts.core')

@section('title', 'Edit | Prefix Management')
    
@section('content')
    @include('prefixes.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Prefix Details</h5>
            <div class="card-content p-2">
                {{ Form::model($prefix, ['route' => ['prefixes.update', $prefix], 'method' => 'PATCH', 'class' => 'form']) }}
                    @include('prefixes.form')
                    <div class="text-center">
                        <a href="{{ route('prefixes.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
