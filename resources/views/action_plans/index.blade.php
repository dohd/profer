@extends('layouts.core')

@section('title', 'Action Plan Management')
    
@section('content')
    @include('action_plans.header')
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
                            <th scope="col">#No</th>
                            <th scope="col">#Code</th>
                            <th scope="col">Project Title</th>
                            <th scope="col">Key Programme</th>
                            <th scope="col">Status</th>
                            <th scope="col">Overseen By</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($action_plans as $plan)
                            <tr>
                                <th scope="row"><a href="#">{{ $plan->tid }}</a></th>
                                <td>AP-{{ $plan->tid }}</td>
                                <td>{{ $plan->proposal ? $plan->proposal->title : '' }}</td>
                                <td>{{ $plan->programme ? $plan->programme->name : '' }}</td>
                                <td><span class="badge bg-{{ $plan->status == 'approved'? 'success' : 'secondary' }}">{{ $plan->status }}</span></td>
                                <td>{{ $plan->main_assigned_to }}</td>
                                <td>{{ dateFormat($plan->date) }}</td>
                                <td>{!! $plan->action_buttons !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
