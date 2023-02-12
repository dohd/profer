@extends('layouts.core')

@section('title', 'Action Plan Management')
    
@section('content')
    @include('action_plans.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                        <th scope="col">#No</th>
                        <th scope="col">Project Title</th>
                        <th scope="col">Key Programme</th>
                        <th scope="col">Assigned To</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($action_plans as $plan)
                            <tr>
                                <th scope="row"><a href="#">{{ $plan->tid }}</a></th>
                                <td>{{ $plan->proposal ? $plan->proposal->title : '' }}</td>
                                <td>{{ $plan->programme ? $plan->programme->name : '' }}</td>
                                <td>{{ $plan->main_assigned_to }}</td>
                                <td>{{ dateFormat($plan->created_at) }}</td>
                                <td>{!! $plan->action_buttons !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
