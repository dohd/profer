@extends('layouts.core')

@section('title', 'Narrative Management')
    
@section('content')
    @include('narratives.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content pt-4">
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Status</th>
                                    <td>Pending</td>
                                    <td>Approved</td>
                                    <td>Review</td>
                                </tr>
                                <tr>
                                    <th>Count</th>
                                    <td>{{ numberFormat($pending_count, 0) }}</td>
                                    <td>{{ numberFormat($approved_count, 0) }}</td>
                                    <td>{{ numberFormat($review_count, 0) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th>#No</th>
                        <th>#Code</th>
                        <th>Project Title</th>
                        <th>Activity</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($narratives as $i => $narrative)
                            <tr>
                                <th scope="row">{{ $i+1 }}</th>
                                <td>{{ tidCode('activity_narrative', $narrative->tid) }}</td>
                                <td>{{ $narrative->proposal? $narrative->proposal->title : '' }}</td>
                                <td>{{ $narrative->proposal_item? $narrative->proposal_item->name : '' }}</td>
                                <td><span class="badge bg-{{ $narrative->status == 'approved'? 'success' : 'secondary' }}">{{ $narrative->status }}</span></td>
                                <td>{!! $narrative->action_buttons !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@stop
