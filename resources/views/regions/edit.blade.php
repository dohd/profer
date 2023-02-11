@extends('layouts.core')

@section('title', 'Edit | Region Management')
    
@section('content')
    @include('regions.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Region Details</h5>
            <div class="card-content p-2">
                {{ Form::model($region, ['route' => ['regions.update', $region], 'method' => 'PATCH', 'class' => 'form']) }}
                    @include('regions.form')
                    <div class="text-center">
                        <a href="{{ route('regions.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
