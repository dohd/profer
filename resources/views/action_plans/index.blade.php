@extends('layouts.core')

@section('title', 'Action Plan Management')
    
@section('content')
    @include('action_plans.header')
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
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless" id="action_plans_tbl">
                        <thead>
                            <tr>
                                <th scope="col">#No</th>
                                <th scope="col">#Code</th>
                                <th scope="col">Project Title</th>
                                <th scope="col">Key Programme</th>
                                <th scope="col">Status</th>
                                <th scope="col">Overseer</th>
                                <th scope="col" width="15%">Date</th>
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
