@extends('layouts.core')

@section('title', 'View | Case Study Management')
    
@section('content')
    @include('case_studies.header')
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Case Study Details</h6>
            <div class="card-content p-2">
                <p>
                    Date: <b>{{ dateFormat($case_study->date, 'd-M-Y') }}</b> <br>
                    Programme: <b>{{ @$case_study->programme->name }}</b>
                </p>
                <h4 class="text-center text-primary"><b>{{ $case_study->title }}</b></h4>
                <p class="text-center">{!! @$case_study->content !!}</p>
            </div>
        </div>
    </div>
@stop
