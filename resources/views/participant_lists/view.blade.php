@extends('layouts.core')

@section('title', 'View | Participant List Management')
    
@section('content')
    @include('participant_lists.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Participant List Details</h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            // 'Name' => $participant->name,
                            // 'Gender' => $participant->gender,
                            // 'Age group' => $participant->age_group,
                            // 'Disability' => $participant->disability,
                            // 'Organisation' => $participant->organisation,
                            // 'Designation' => $participant->designation,
                            // 'Phone' => $participant->phone,
                            // 'Email' => $participant->email,
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
