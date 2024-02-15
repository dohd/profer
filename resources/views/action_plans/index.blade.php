@extends('layouts.core')

@section('title', 'Action Plan Management')
    
@section('content')
    @include('action_plans.header')
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
                <div class="my-2">
                    <div class="row mb-2">
                        <div class="col-md-7 col-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered mb-2">
                                    <tbody>
                                        <tr>
                                            <th>Status</th>
                                            <td>Pending ({{ numberFormat(@$grp_status_count['pending'], 0) }})</td>
                                            <td>Approved ({{ numberFormat(@$grp_status_count['approved'], 0) }})</td>
                                            <td>Review ({{ numberFormat(@$grp_status_count['review'], 0) }})</td>
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
                </div><hr>

                <div class="table-responsive">
                    <table class="table table-borderless" id="action_plans_tbl">
                        <thead>
                            <tr>
                                <th>#No</th>
                                <th>#Code</th>
                                <th>Project Title</th>
                                <th>Key Programme</th>
                                <th>Status</th>
                                <th>Overseer</th>
                                <th width="15%">Date</th>
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
    $.post("{{ route('action_plans.datatable') }}", data => {
        $('#action_plans_tbl tbody').html(data);
        new simpleDatatables.DataTable($('#action_plans_tbl')[0]);
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
            "{{ route('action_plans.datatable') }}", 
            params, 
            data => {
                $('#action_plans_tbl tbody').html(data);
                new simpleDatatables.DataTable($('#action_plans_tbl')[0]);
            }
        );
    }
</script>
@stop
