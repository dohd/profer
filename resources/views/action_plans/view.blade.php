@extends('layouts.core')

@section('title', 'View | Action Plan Management')
    
@section('content')
    @include('action_plans.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Action Plan Details
                <div class="float-end">
                    <span class="badge bg-secondary text-white" role="button" data-bs-toggle="modal" data-bs-target="#status_modal">
                        <i class="bi bi-pencil-fill"></i> Status
                    </span>
                </div>
            </h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            'Project Title' => $action_plan->proposal? $action_plan->proposal->title : '',
                            'Key Programme' => $action_plan->programme? $action_plan->programme->name : '',
                            'Assigned To' => $action_plan->main_assigned_to,
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>
                                @if ($key == 'Project Title')
                                    {{ $val }} || <span class="badge bg-{{ $action_plan->status == 'approved'? 'success' : 'secondary' }}">{{ $action_plan->status }}</span>
                                @else
                                    {{ $val }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <!-- Default Tabs -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <div class="float-end">
                    <span class="badge bg-primary text-white" role="button" id="activity_md" data-bs-toggle="modal" data-bs-target="#activity_modal">
                        <i class="bi bi-plus-lg"></i> Activity
                    </span>
                    <span class="badge bg-success text-white" role="button" id="cohort_md" data-bs-toggle="modal" data-bs-target="#cohort_modal">
                        <i class="bi bi-plus-lg"></i> Target Cohort
                    </span>
                </div>
            </h5>
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Activity</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Target Cohort</button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="myTabContent">
                <!-- activity  -->
                @include('action_plans.tabs.plan_activity_tab')
                <!-- cohort  -->
                @include('action_plans.tabs.plan_cohort_tab')
            </div>
        </div>
    </div>
    <!-- End Default Tabs -->
    @include('action_plans.partial.status_modal')
    @include('action_plans.partial.activity_modal')
    @include('action_plans.partial.cohort_modal')
@stop

@section('script')
<script>
    // select2 config
    $('select').each(function() { $(this).css('width', '100%') });

    ['activity', 'region'].forEach(v => {
        $('#'+v).select2({allowClear: true, dropdownParent: $('#activity_modal')});
    });
    // reset activity modal
    $('#activity_modal').on('hide.bs.modal', function() {
        $('#activity_modal_label').html('Add Activity');
        $('#activity_form').attr('action', @json(route('action_plans.store_activity')));
        $('#activity_form').trigger('reset');
        $('select option').each(function() { $(this).prop('selected', false).change(); });
    });
    // edit activity modal
    $('#activity_tbl').on('click', '.edit', function() {
        const url = $(this).attr('data-url');
        const activity_id = $(this).attr('data-id');
        $.post(url, {activity_id}, data => {
            if (!data.id) return;
            $('#activity_modal_label').html('Edit Activity');
            $('#activity_form').attr('action', @json(route('action_plans.update_activity')));
            $('#item_id').val(data.id)
            $('#start_date').val(data.start_date);
            $('#end_date').val(data.end_date);
            $('#assigned_to').val(data.assigned_to);
            $('#resources').val(data.resources);
            $('#activity').val(data.activity_id).change();
            $('#region option').each(function() {
                const opt = $(this);
                data.regions.forEach(v => {
                    if (v.id == opt.attr('value')) 
                        opt.prop('selected', true).change();
                })
            });
        });
    });

    /** 
     * Cohort Modal
    */
    $('#cohort_activity').select2({allowClear: true, dropdownParent: $('#cohort_modal')});
    // add cohort row
    let rowCount = 1;
    let initRow = $('#cohorts_tbl tbody tr:first').html();
    $('.addrow').click(function() {
        rowCount++;
        $('#cohorts_tbl tbody').append(`<tr>${initRow}</tr>`);
        const row = $('#cohorts_tbl tbody tr:last');
        row.find('.num').text(rowCount);
        // add select2 to added row
        row.find('select.custom').each(function() {
            $(this).select2({allowClear: true, dropdownParent: $('#cohort_modal')});
        });
    });
    // add select2 to default row
    $('#cohorts_tbl tbody tr:first').find('select.custom').select2({
        allowClear: true, dropdownParent: $('#cohort_modal')
    });

    // remove row
    $('#cohorts_tbl').on('click', '.del', function() {
        const row = $(this).parents('tr');
        if (!row.siblings().length) return;
        row.remove();
        rowCount--;
    });

    // edit cohorts modal
    $('#cohort_list_tbl').on('click', '.edit', function() {
        const url = $(this).attr('data-url');
        const cohort_id = $(this).attr('data-id');
        $.post(url, {cohort_id}, data => {
            if (!data.id) return;
            $('#cohort_modal_label').html('Edit Cohort');
            $('#cohort_form').attr('action', @json(route('action_plans.update_cohort')));
            $('#item_id').val(data.id);
            $('#cohort_activity').val(data.activity_id);
            console.log(data)
            // $('#end_date').val(data.end_date);
            // $('#assigned_to').val(data.assigned_to);
            // $('#resources').val(data.resources);
            // $('#activity').val(data.activity_id).change();
            // $('#region option').each(function() {
            //     const opt = $(this);
            //     data.regions.forEach(v => {
            //         if (v.id == opt.attr('value')) 
            //             opt.prop('selected', true).change();
            //     })
            // });
        });
    });
    
</script>
@stop