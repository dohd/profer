@extends('layouts.core')

@section('title', 'Edit | Participant List Management')
    
@section('content')
    @include('participant_lists.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Participant List Details</h5>
            <div class="card-content p-2">
                {{ Form::model($participant_list, ['route' => ['participant_lists.update', $participant_list], 'method' => 'PATCH', 'class' => 'form']) }}
                    @include('participant_lists.form')
                    <div class="text-center">
                        <a href="{{ route('participant_lists.index') }}" class="btn btn-secondary">Cancel</a>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
