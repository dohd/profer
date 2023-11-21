@extends('layouts.core')

@section('title', 'Attendance Management')
    
@section('content')
    @include('attendances.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="overflow-auto">
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th>#No</th>
                                <th>Project</th>
                                <th>Activity</th>
                                <th>Date</th>
                                <th>Male Ps</th>
                                <th>Female Ps</th>
                                <th>Total Ps</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $i => $row)
                                <tr>
                                    <th scope="row" style="height: {{ count($attendances) == 1? '80px': '' }}">{{ $i+1 }}</th>
                                    <td>{{ @$row->proposal->title }}</td>
                                    <td>{{ @$row->activity->name }}</td>
                                    <td>{{ dateFormat($row->date) }}</td>
                                    <td>{{ $row->items->sum('male') }}</td>
                                    <td>{{ $row->items->sum('female') }}</td>
                                    <td>{{ $row->items->sum('total') }}</td>
                                    <td>{!! $row->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
