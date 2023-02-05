@extends('layouts.core')

@section('title', 'View | Proposal Management')
    
@section('content')
    @include('proposals.header')
    <div class="card">
        <div class="card-body">
            <div class="card-title h5">Proposal Details 
                <span class="badge bg-secondary text-white float-end" role="button" data-bs-toggle="modal" data-bs-target="#status_modal">
                    <i class="bi bi-pencil-fill"></i> Status
                </span>
            </div>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            '#No.' => $proposal->tid,
                            'Title' => $proposal->title,
                            'Region' => $proposal->region,
                            'Sector' => $proposal->sector,
                            'Donor' => $proposal->donor,
                            'Date (start-end)' => date('d-m-Y', strtotime($proposal->start_date)) . ' || ' . date('d-m-Y', strtotime($proposal->end_date)),
                            'Estimated Budget' => number_format($proposal->budget, 2),
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>
                                @if ($key == 'Title')
                                    {{ $val }} || <span class="badge bg-{{ $proposal->status == 'approved'? 'success' : 'secondary' }}">{{ $proposal->status }}</span>
                                @else
                                    {{ $val }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                
                <!-- Proposal items -->
                <table class="table table-striped" id="objectivesTbl">
                    <thead>
                        <tr class="">
                            <th scope="col" width="8%">#</th>
                            <th scope="col">Item Description</th>
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
                                <td>{{ $item->is_obj? 'Obj' : 'Act' }} : {{ $item->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('proposals.partial.proposal_status')
@stop
