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
                    <th scope="col">Created At</th>
                    <th scope="col">Assigned Person</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($action_plans as $plan)
                        <tr>
                            <th scope="row"><a href="#">{{ $plan->tid }}</a></th>
                            <td>{{ $plan->proposal? $plan->proposal->title : '' }}</td>
                            <td>{{ $plan->programme()? $plan->programme()->name : '' }}</td>
                            <td>{{ dateFormat($plan->created_at) }}</td>
                            <td>{{ $plan->main_assigned_to }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item pt-1 pb-1 view" href="{{ route('action_plans.show', $plan) }}"><i class="bi bi-eye-fill"></i>View</a></li>
                                        <li><a class="dropdown-item pt-1 pb-1 edit" href="{{ route('action_plans.edit', $plan) }}"><i class="bi bi-pencil-square"></i>Edit</a></li>
                                        <li><a class="dropdown-item pt-1 pb-1 destroy" href="javascript:" onclick="confirm('Are You sure?')"><i class="bi bi-trash text-danger icon-xs"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
