@extends('layouts.core')

@section('title', 'Participant List Management')
    
@section('content')
    @include('participant_lists.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#No</th>
                        <th scope="col">Project Title</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Region</th>
                        <th scope="col">Ps</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($participant_lists as $i => $item)
                            <tr>
                                <th scope="row">{{ $i+1 }}</th>
                                <td>{{ $item->proposal? $item->proposal->title : ''  }}</td>
                                <td>{{ $item->proposal_item? $item->proposal_item->name : '' }}</td>
                                <td>{{ $item->region? $item->region->name : '' }}</td>
                                <td>{{ $item->total_count }}</td>
                                <td>{{ dateFormat($item->date) }}</td>
                                <td>{!! $item->action_buttons !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@stop
