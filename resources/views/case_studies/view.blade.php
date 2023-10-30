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
                <h4 class="text-center text-primary mt-2 mb-2"><b>{{ $case_study->title }}</b></h4>
                <div class="h5"><u><b>Situation (Before intervention)</b></u></div>
                <div class="mb-2">{!! @$case_study->situation !!}</div>
                <div class="h5"><u><b>Project Intervention</b></u></div>
                <div class="mb-2">{!! @$case_study->intervention !!}</div>
                <div class="h5"><u><b>Impact (Intervention Results)</b></u></div>
                <div class="mb-2">{!! @$case_study->impact !!}</div>
            </div>
        </div>
    </div>
@stop
