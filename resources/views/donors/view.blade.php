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
                <h5>Activities</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#No.</th>
                            <th scope="col">Proposal</th>
                            <th scope="col">Activity</th>
                            <th scope="col">Ps.</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($proposal_items as $i => $item)
                                <tr>
                                    <th>{{ $i+1 }}</th>
                                    <td>
                                        @if (@$item->proposal)
                                            <a href="{{ route('proposals.show', $item->proposal) }}">{{ $item->proposal->title }}</a>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
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
