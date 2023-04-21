@extends('layouts.core')

@section('title', 'Edit | Role Management')
    
@section('content')
    @include('roles.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Role Details</h5>
            <div class="card-content p-2">
                {{ Form::model($role, ['route' => ['roles.update', $role], 'method' => 'PATCH', 'class' => 'form']) }}
                    @include('roles.form')
                    <div class="text-center">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop