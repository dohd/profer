@extends('layouts.core')

@section('title', 'View | Log Frame Management')
    
@section('content')
    @include('log_frames.header')
    <div class="card">
        <div class="card-body">
            <div class="card-title h5">Project: <b>{{ @$log_frame->proposal->title }}</b></div>
            <div class="card-content p-2">
                <!-- Default Tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="goal-tab" data-bs-toggle="tab" data-bs-target="#goal" type="button" role="tab" aria-controls="home" aria-selected="true">Goal (Impact)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="outcome-tab" data-bs-toggle="tab" data-bs-target="#outcome" type="button" role="tab" aria-controls="outcome" aria-selected="false">Outcome (Objective)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="result-tab" data-bs-toggle="tab" data-bs-target="#result" type="button" role="tab" aria-controls="result" aria-selected="false">Result (Activity)</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="myTabContent">
                    @php
                        $labels = [
                            'Summary' => 'summary', 
                            'Indicator' => 'indicator', 
                            'Baseline' => 'baseline', 
                            'Target' => 'target', 
                            'Data Source' => 'data_source', 
                            'Frequency' => 'frequency', 
                            'Assign To' => 'assign_to'
                        ];
                    @endphp
                    <!-- impact/goal  -->
                    <div class="tab-pane fade show" id="goal" role="tabpanel" aria-labelledby="goal-tab">
                        <table class="table table-striped table-bordered" id="impact_tbl">
                            <tbody>
                                
                                @foreach ($labels as $key => $value)
                                    <tr>
                                        <th width="30%">{{ $key }}</th>
                                        <td>
                                            {{ $log_frame['goal_' . $value] }}
                                        </td>
                                    </tr>   
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- outcome/objective  -->
                    <div class="tab-pane fade" id="outcome" role="tabpanel" aria-labelledby="outcome-tab">
                        <table class="table table-striped table-bordered" id="outcome_tbl">
                            <tbody>
                                @foreach ($labels as $key => $value)
                                    <tr>
                                        <th width="30%">{{ $key }}</th>
                                        <td>
                                            {{ $log_frame['outcome_' . $value] }}
                                        </td>
                                    </tr>   
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- result/activity  -->
                    <div class="tab-pane fade" id="result" role="tabpanel" aria-labelledby="result-tab">
                        <table class="table table-striped table-bordered" id="result_tbl">
                            <tbody>
                                
                                @foreach ($labels as $key => $value)
                                    <tr>
                                        <th width="30%">{{ $key }}</th>
                                        <td>
                                            {{ $log_frame['result_' . $value] }}
                                        </td>
                                    </tr>   
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Default Tabs -->
            </div>
        </div>
    </div>
@stop
