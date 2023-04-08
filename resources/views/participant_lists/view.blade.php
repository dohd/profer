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
                            'Cohort' => $item->cohort? $item->cohort->name : '',
                            'Prepared By' => $item->prepared_by,
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>{{ $val}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th width="30%">Participant Count</th>
                        <td>
                            Male: <b>{{ $item->male_count }}</b> || 
                            Female: <b>{{ $item->female_count }}</b> || 
                            Total: <b>{{ $item->total_count }}</b>
                        </td>
                    </tr>
                </table>

                <!-- participants -->     
                <div class="table-responsive">
                    <table class="table table-striped" id="participants_tbl">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th width="10%">Age Group</th>
                                <th>Disability</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Designation</th>
                                <th>Organisation</th>
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
    </div>
@stop
