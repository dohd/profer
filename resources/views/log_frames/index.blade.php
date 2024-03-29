@extends('layouts.core')

@section('title', 'Log Frame Management')
    
@section('content')
    @include('log_frames.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="overflow-auto">
                    <table class="table table-borderless datatable" id="logframeTbl">
                        <thead>
                            <tr>
                                <th scope="col">#No</th>
                                <th scope="col">#Code</th>
                                <th scope="col">Project Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($log_frames as $i => $log_frame)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td><a href="{{ route('log_frames.show', $log_frame) }}">{{ tidCode('log_frame', $log_frame->tid) }}</a></td>
                                    <td>{{ @$log_frame->proposal->title }}</td>
                                    <td>{{ dateFormat($log_frame->date) }}</td>
                                    <td>{!! $log_frame->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    $.post("{{ route('log_frames.datatable') }}", {}, data => {
        $('#logframeTbl tbody').html(data);
        new simpleDatatables.DataTable($('#logframeTbl')[0]);
    });
</script>
@stop
