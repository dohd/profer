@extends('layouts.core')

@section('title', 'Action Plan Management')
    
@section('content')
    @include('action_plans.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content pt-4">
                <div class="row">
                    <div class="col-sm-5 col-12">
                        <div class="table-responsive">
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
                                        <td>{{ numberFormat(@$grp_status_count['pending'], 0) }}</td>
                                        <td>{{ numberFormat(@$grp_status_count['approved'], 0) }}</td>
                                        <td>{{ numberFormat(@$grp_status_count['review'], 0) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-7 col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Approved Plan</th>
                                        <td>Without Participant List</td>
                                        <td>Without Activity Narrative</td>
                                    </tr>
                                    <tr>
                                        <th>Count</th>
                                        <td>{{ numberFormat(@$wo_ps_list_count, 0) }}</td>
                                        <td>{{ numberFormat(@$wo_narrative_count, 0) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5 col-xs-12"></div>
                    <div class="col-sm-7 col-xs-12">
                        <select name="" id="wo_status_filter" class="custom-control col-6">
                            <option value="">-- Filter Approved Plan --</option>
                            <option value="wo_ps_list">Without Participant List</option>
                            <option value="wo_narrative">Without Activity Narrative</option>
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
                    <table class="table table-borderless" id="action_plans_tbl">
                        <thead>
                            <tr>
                                <th scope="col">#No</th>
                                <th scope="col">#Code</th>
                                <th scope="col">Project Title</th>
                                <th scope="col">Key Programme</th>
                                <th scope="col">Status</th>
                                <th scope="col">Overseen By</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
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

    // on change status filter
    $('#wo_status_filter').change(function() {
        $.post("{{ route('action_plans.datatable') }}", {status: $(this).val()}, data => {
            $('#action_plans_tbl tbody').html(data);
            new simpleDatatables.DataTable($('#action_plans_tbl')[0]);
        });
    });
</script>
@stop
