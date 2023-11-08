@extends('layouts.core')

@section('title', 'Project Budget Management')
    
@section('content')
    @include('budgets.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                        <tr>
                            <th scope="col">#No.</th>
                            <th scope="col">Budgeted Project</th>
                            <th scope="col">Budget Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($budgets as $i => $budget)
                                <tr>
                                    <th scope="row" style="height: {{ !$i? '80px': '' }}">{{ $i+1 }}</th>
                                    <td>({{ tidCode('proposal', @$budget->proposal->tid) }}) {{ @$budget->proposal->title }}</td>
                                    <td><span class="badge bg-{{ $budget->status == 'approved'? 'success' : 'secondary' }}">{{ $budget->status }}</span></td>
                                    <td>{!! $budget->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
