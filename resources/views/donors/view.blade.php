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
                            'Donor Name' => $donor->name,
                            'Donor Email' => $donor->email,
                            'Donor Phone' => $donor->phone,
                            'Contact Person' => $donor->contact_person,
                            'Contact Person Email' => $donor->alternative_email,
                            'Contact Person Phone' => $donor->alternative_phone,
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>{{ $val}}</td>
                        </tr>
                    @endforeach
                </table>
                <h5>Activity Report</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Activity</th>
                            <th scope="col">Region</th>
                            <th scope="col">Date</th>
                            <th scope="col">Male Ps.</th>
                            <th scope="col">Female Ps.</th>
                            <th scope="col">Ps.</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($proposal_items as $i => $item)
                                <tr>
                                    <th>{{ $i+1 }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ implode(', ', $item->regions)  }}</td>
                                    <td>{{ implode(', ', $item->dates) }}</td>
                                    <td>{{ $item->participant_lists->sum('male_count') }}</td>
                                    <td>{{ $item->participant_lists->sum('female_count') }}</td>
                                    <td>{{ $item->participant_lists->sum('total_count') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
