@extends('layouts.core')

@section('title', 'View | Donor Management')
    
@section('content')
    @include('donors.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Donor Details</h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            'Name' => $donor->name,
                            'Phone' => $donor->phone,
                            'Email' => $donor->email,
                            'Contact Person' => $donor->contact_person,
                            'Alternative Email' => $donor->alternative_email,
                            'Alternative Phone' => $donor->alternative_phone,
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
