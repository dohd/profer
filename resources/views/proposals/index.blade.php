@extends('layouts.core')

@section('title', 'Proposal Management')
    
@section('content')
    @include('proposals.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="my-3">
                    <div class="row mb-2">
                        <div class="col-md-7 col-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered mb-2">
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Status</th>
                                            <td rowspan="2">Pending ({{ numberFormat(@$grp_status_count['pending'], 0) }})</td>
                                            <td rowspan="2">Approved ({{ numberFormat(@$grp_status_count['approved'], 0) }})</td>
                                            <td rowspan="2">Rejected ({{ numberFormat(@$grp_status_count['rejected'], 0) }})</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
    
                        <div class="col-md-5 col-12">
                            <select id="wo_status_filter" class="custom-control col-8">
                                <option value="">Filter Approved Proposals</option>
                                <option value="wo_logframe">Pending Log Frame</option>
                                <option value="wo_action_plan">Pending Action Plan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered m-0">
                                    <tbody>
                                        <tr>
                                            <th>Approved</th>
                                            <td>Pending Log Frame ({{ numberFormat(@$wo_logframe_count, 0) }})</td>
                                            <td>Pending Action Plan ({{ numberFormat(@$wo_action_plan_count, 0) }})</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless" id="proposal_tbl">
                        <thead>
                        <tr>
                            <th scope="col">#No</th>
                            <th scope="col">#Code</th>
                            <th scope="col">Title</th>
                            <th scope="col" width="15%">Start Date</th>
                            <th scope="col">Budget</th>
                            <th scope="col">Status</th>
                            <th scope="col">Donor</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    $.post("{{ route('proposals.datatable') }}", data => {
        $('#proposal_tbl tbody').html(data);
        new simpleDatatables.DataTable($('#proposal_tbl')[0]);
    });

    // on change status filter
    $('#wo_status_filter').change(function() {
        $.post("{{ route('proposals.datatable') }}", {status: $(this).val()}, data => {
            $('#proposal_tbl tbody').html(data);
            new simpleDatatables.DataTable($('#proposal_tbl')[0]);
        });
    });
</script>
@stop
