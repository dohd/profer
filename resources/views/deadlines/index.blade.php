@extends('layouts.core')

@section('title', 'Deadline Management')

@section('content')
    @include('deadlines.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th>#No.</th>
                                <th>Subject</th>
                                <th>Deadline</th>
                                <th>Module</th>
                                <th>Due Submissions</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deadlines as $i => $deadline)
                                <tr>
                                    <th style="height: {{ count($deadlines) == 1? '80px' : '' }}">{{ $i+1 }}</th>
                                    <td>{{ $deadline->subject }}</td>
                                    <td>{{ dateFormat($deadline->date, 'd-M-Y') }}</td>
                                    <td>{{ $deadline->module }}</td>
                                    <td>
                                        @php
                                            $due = 0;
                                            $total = 0;
                                            if ($deadline->module == 'ACTION-PLAN') {
                                                $due = $deadline->action_plans()->whereDate('created_at', '<=', $deadline->date)->count();
                                                $total = $deadline->action_plans()->count();
                                            } elseif ($deadline->module == 'AGENDA') {
                                                $due = $deadline->agendas()->whereDate('created_at', '<=', $deadline->date)->count();
                                                $total = $deadline->agendas()->count();
                                            }
                                            if ($due) echo "{$due} / {$total}";
                                            else echo "0";
                                        @endphp
                                    </td>
                                    <td><span class="badge bg-{{ $deadline->active? 'success' : 'secondary' }}">{{ $deadline->active_status }}</span></td>
                                    <td>{!! $deadline->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
