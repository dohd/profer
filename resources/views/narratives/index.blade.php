@extends('layouts.core')

@section('title', 'Study Materials')
    
@section('content')
    @include('narratives.header')    
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <!-- <div class="row my-2">
                    <div class="col-md-6 col-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Status</th>
                                        <td>Pending ({{ numberFormat(@$status_grp['pending'], 0) }})</td>
                                        <td>Approved ({{ numberFormat(@$status_grp['approved'], 0) }})</td>
                                        <td>Review ({{ numberFormat(@$status_grp['review'], 0) }})</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->

                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                        <tr>
                            <th>#No</th>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Age Group</th>
                            <th>Material</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($narratives as $i => $narrative)
                                <tr>
                                    <th style="height: {{ count($narratives) == 1? '80px': '' }}">{{ $i+1 }}</th>
                                    <td>{{ dateFormat($narrative->date) }}</td>
                                    <td>{{ $narrative->subject }}</td>
                                    <td>{{ @$narrative->age_group->bracket }}</td>
                                    <td><a href="{{ route('storage.file_download', 'narrative,' . $narrative->doc_file) }}" target="_blank">{{ $narrative->doc_file }}<i class="bi bi-download h5 ms-2"></i></a></td>
                                    <td>{!! $narrative->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
