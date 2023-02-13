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
                        $item = $participant_list;
                        $details = [
                            'Project Title' => $item->proposal? $item->proposal->title : '',
                            'Activity' => $item->proposal_item? $item->proposal_item->name : '',
                            'Date' => dateFormat($item->date),
                            'Region' => $item->region? $item->region->name : '',
                            'Key Programme' => $item->programme? $item->programme->name : '',
                            'Cohort' => $item->cohort? $item->cohort->name : '',
                            'Prepared By' => $item->prepared_by,
                            'Male Count' => $item->male_count,
                            'Female Count' => $item->female_count,
                            'Total Count' => $item->total_count,
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>{{ $val}}</td>
                        </tr>
                    @endforeach
                </table>

                <!-- participants -->                
                <table class="table table-striped" id="participants_tbl">
                    <thead>
                        <tr class="">
                            <th scope="col">#</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col" width="10%">Age Group</th>
                            <th scope="col">Disability</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Organisation</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participant_list->items as $i => $item)
                            <tr>
                                <th scope="row" class="p-3 num">{{ $i+1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->age_group? $item->age_group->bracket : '' }}</td>
                                <td>{{ $item->disability? $item->disability->code : ''}}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->designation }}</td>
                                <td>{{ $item->organisation }}</td>                            
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@stop
