@extends('layouts.core')

@section('title', 'View | Action Plan Management')
    
@section('content')
    @include('action_plans.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Action Plan Details</h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            '#No.' => $action_plan->tid,
                            'Project Title' => $action_plan->proposal? $action_plan->proposal->title : '',
                            'Key Programme' => $action_plan->programme? $action_plan->programme->name : '',
                            'Created At' => dateFormat($action_plan->created_at),
                            'Assigned To' => $action_plan->main_assigned_to,
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>{{ $val}}</td>
                        </tr>
                    @endforeach
                </table>

                <table class="table table-striped" id="objectivesTbl">
                    <thead>
                        <tr>
                            <th scope="col" width="8%">#</th>
                            <th scope="col">Activity Description</th>
                            <th scope="col" width="12%">Dates</th>
                            <th>Cohort</th>
                            <th>Regions</th>
                            <th>Resources</th>
                            <th width="15%">Assigned To</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($action_plan->items as $item)
                            <tr>
                                <th scope="row">
                                    @if (@$item->proposal_item->row_num)
                                        {{ $item->proposal_item->row_num }}.
                                    @else
                                        <ul><li></li></ul>
                                    @endif
                                </th>
                                <td>{{ $item->proposal_item? $item->proposal_item->name : '' }}</td>
                                @if (@$item->proposal_item->is_obj)
                                    <td colspan="5"></td>
                                @else
                                    <td>
                                        <div>{{ dateFormat($item->start_date) }}</div>
                                        <div>{{ dateFormat($item->end_date) }}</div>
                                    </td>
                                    <td>{{ $item->cohort? $item->cohort->name : '' }}</td>
                                    <td>
                                        @php
                                            $regions = [];
                                            if (isset($item->proposal_item->regions))
                                                $regions = $item->proposal_item->regions->pluck('name')->toArray();
                                        @endphp
                                        {{ implode(', ', $regions) }}
                                    </td>
                                    <td>{{ $item->resources }}</td>
                                    <td>{{ $item->assigned_to }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
