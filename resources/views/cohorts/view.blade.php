@extends('layouts.core')

@section('title', 'View | Cohort Management')
    
@section('content')
    @include('cohorts.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Cohort Details</h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            'Cohort' => $cohort->name,
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>{{ $val}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop
