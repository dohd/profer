@extends('layouts.core')

@section('title', 'Agenda Management')

@section('content')
    @include('agenda.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                @if (@$curr_deadline)
                    <div class="text-center h5">
                        <span class="badge bg-warning">
                            Submission Deadline: {{ dateFormat($curr_deadline->date,'l, d-M-Y') }}
                        </span>
                    </div>
                @endif
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
                @can('view-deadline')
                    <div class="row g-0 mb-2">
                        <div class="col-md-2 px-0">Deadline Date</div>
                        <div class="col-md-2 px-0"><input type="date" id="dt-deadline"></div>
                    </div>
                @endcan
                <div class="row g-0 mb-2">
                    <div class="col-md-2 px-0">Search Between</div>
                    <div class="col-md-2 px-0"><input type="date" id="dt-from"></div>
                    <div class="col-md-2 px-0"><input type="date" id="dt-to"></div>
                    <div class="col-md-2 px-0">
                        <span class="badge bg-primary text-white" role="button" id="search">Search</span>
                        <span class="badge bg-success text-white" role="button" id="refresh" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Refresh"><i class="bi bi-arrow-clockwise"></i></span>    
                    </div>                     
                </div>
                <hr>

                <div class="table-responsive">
                    <table class="table table-borderless" id="agenda-tbl">
                        <thead>
                            <tr>
                                <th>#No</th>
                                <th>#Code</th>
                                <th>Agenda Title</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    $.post("{{ route('agenda.datatable') }}", data => {
        $('#agenda-tbl tbody').html(data);
        new simpleDatatables.DataTable($('#agenda-tbl')[0]);
    });

    // search click
    $('#search').click(fetchRecords);
    $('#refresh').click(function() {
        $('#dt-from').val('');
        $('#dt-to').val('');
        $('#dt-deadline').val('');
        $('#search').click();
    });

    function fetchRecords(e) {
        const params = {
            date_from: $('#dt-from').val(),
            date_to: $('#dt-to').val(),
            deadline: $('#dt-deadline').val(),
        };
        $.post(
            "{{ route('agenda.datatable') }}", 
            params, 
            data => {
                $('#agenda-tbl tbody').html(data);
                new simpleDatatables.DataTable($('#agenda-tbl')[0]);
            }
        );
    }
</script>
@stop
