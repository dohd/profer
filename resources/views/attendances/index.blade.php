@extends('layouts.core')

@section('title', 'Family Member List')
    
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
                                <th>Date</th>
                                <th>DF Name</th>
                                <th>Total Ct.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $i => $row)
                                <tr>
                                    <th scope="row" style="height: {{ count($attendances) == 1? '80px': '' }}">{{ $i+1 }}</th>
                                    <td>{{ dateFormat($row->date) }}</td>
                                    <td>{{ $row->family_name }}</td>
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
