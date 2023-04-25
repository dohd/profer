@extends('layouts.core')

@section('title', 'Edit | Agenda Management')
    
@section('content')
    @include('agenda.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Agenda Details</h5>
            <div class="card-content p-2">
                {{ Form::model($agenda, ['route' => ['agenda.update', $agenda], 'method' => 'PATCH', 'class' => 'form']) }}
                    @include('agendas.form')
                    <div class="text-center">
                        <a href="{{ route('agenda.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
