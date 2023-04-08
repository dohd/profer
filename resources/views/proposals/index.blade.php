@extends('layouts.core')

@section('title', 'Proposal Management')
    
@section('content')
    @include('proposals.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content pt-4">
                <div class="row">
                    <div class="col-sm-5 col-xs-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th rowspan="2">Proposal Status <div>&nbsp;</div></th>
                                    <td rowspan="2">Pending <div>&nbsp;</div></td>
                                    <td rowspan="2">Approved <div>&nbsp;</div></td>
                                    <td rowspan="2">Review <div>&nbsp;</div></td>
                                </tr>
                                <tr></tr>
                                <tr>
                                    <th>Count</th>
                                    <td>{{ numberFormat(@$grp_status_count['pending'], 0) }}</td>
                                    <td>{{ numberFormat(@$grp_status_count['approved'], 0) }}</td>
                                    <td>{{ numberFormat(@$grp_status_count['review'], 0) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-7 col-xs-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Approved Proposal</th>
                                    <td>W/O Log Frame</td>
                                    <td>W/O Action Plan</td>
                                    <td>W/O Participant</td>
                                    <td>W/O Narrative</td>
                                </tr>
                                <tr>
                                    <th>Count</th>
                                    <td>{{ numberFormat(@$wo_logframe_count, 0) }}</td>
                                    <td>{{ numberFormat(@$wo_action_plan_count, 0) }}</td>
                                    <td>{{ numberFormat(@$wo_participants_count, 0) }}</td>
                                    <td>{{ numberFormat(@$wo_narrative_count, 0) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5 col-xs-12"></div>
                    <div class="col-sm-7 col-xs-12">
                        <select name="" id="wo_status_filter" class="custom-control col-4">
                            <option value="">-- Select Filter --</option>
                            <option value="wo_logframe">W/O Log Frame</option>
                            <option value="wo_action_plan">W/O Action Plan</option>
                            <option value="wo_participant">W/O Participant</option>
                            <option value="wo_narrative">W/O Narrative</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="overflow-auto">
                    <table class="table table-borderless" id="proposal_tbl">
                        <thead>
                        <tr>
                            <th scope="col">#No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Start Date</th>
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
