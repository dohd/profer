@extends('layouts.core')

@section('title', 'View | Proposal Management')
    
@section('content')
{{-- <div id="main" class="main"> --}}
    @include('proposals.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Proposal Details</h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            '#No.' => $proposal->tid,
                            'Title' => $proposal->title,
                            'Region' => $proposal->region,
                            'Sector' => $proposal->sector,
                            'Donor' => $proposal->donor,
                            'Date (start-end)' => date('d-m-Y', strtotime($proposal->start_date)) . ' to ' . date('d-m-Y', strtotime($proposal->end_date)),
                            'Estimated Budget' => number_format($proposal->budget, 2),
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
                        <tr class="">
                            <th scope="col" width="8%">#</th>
                            <th scope="col" width="10%">Item</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposal->items as $item)
                            <tr>
                                <th scope="row">
                                    @if ($item->row_num)
                                        {{ $item->row_num }}.
                                    @else
                                        <ul><li></li></ul>
                                    @endif
                                </th>
                                <td>{{ $item->is_obj? 'objective' : 'activity' }}</td>
                                <td>{{ $item->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{-- </div> --}}
@stop
