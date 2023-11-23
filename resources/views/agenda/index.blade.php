@extends('layouts.core')

@section('title', 'Agenda Management')

@section('content')
    @include('agenda.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="row my-2">
                    <div class="col-md-6 col-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Status </th>
                                        <td>Pending ({{ numberFormat(@$status_grp['pending'], 0) }})</td>
                                        <td>Approved ({{ numberFormat(@$status_grp['approved'], 0) }})</td>
                                        <td>Review ({{ numberFormat(@$status_grp['review'], 0) }})</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                        <tr>
                            <th scope="col">#No</th>
                            <th scope="col">#Code</th>
                            <th scope="col">Agenda Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($agenda as $i => $row)
                                <tr>
                                    <th scope="row" style="height: {{ count($agenda) == 1? '80px' : '' }}">{{ $i+1 }}</th>
                                    <td><a href="{{ route('agenda.show', $row) }}">{{ tidCode('agenda', $row->tid) }}</a></td>
                                    <td>{{ $row->title }}</td>
                                    <td><span class="badge bg-{{ $row->status == 'approved'? 'success' : 'secondary' }}">{{ $row->status }}</span></td>
                                    <td>{{ dateFormat($row->date)  }}</td>
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
