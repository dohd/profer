@extends('layouts.core')

@section('title', 'Agenda Management')

@section('content')
    @include('agenda.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content pt-4">
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Status</th>
                                    <td>Pending</td>
                                    <td>Approved</td>
                                    <td>Review</td>
                                </tr>
                                <tr>
                                    <th>Count</th>
                                    <td>{{ numberFormat(@$status_grp['pending'], 0) }}</td>
                                    <td>{{ numberFormat(@$status_grp['approved'], 0) }}</td>
                                    <td>{{ numberFormat(@$status_grp['review'], 0) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                        <tr>
                            <th scope="col">#No.</th>
                            <th scope="col">#Code</th>
                            <th scope="col">Agenda Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($agenda as $i => $agenda)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td><a href="{{ route('agenda.show', $agenda) }}">{{ tidCode('agenda', $agenda->tid) }}</a></td>
                                    <td>{{ $agenda->title }}</td>
                                    <td><span class="badge bg-{{ $agenda->status == 'approved'? 'success' : 'secondary' }}">{{ $agenda->status }}</span></td>
                                    <td>{{ dateFormat($agenda->date)  }}</td>
                                    <td>{!! $agenda->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
