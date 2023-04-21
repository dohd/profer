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
                            'Date' => dateFormat($action_plan->date),
                            'Overseen By' => $action_plan->main_assigned_to,
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
                    @if ($action_plan->status_note && $action_plan->status == 'review')
                        <tr>
                            <th width="30%">Review Remark</th>
                            <td>{{ $action_plan->status_note }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <!-- Default Tabs -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                        Activity
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                        Target Cohort
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="participant-list-tab" data-bs-toggle="tab" data-bs-target="#participant-list" type="button" role="tab" aria-controls="participant-list" aria-selected="false">
                        Participant List ({{ $action_plan->participant_lists->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="narrative-tab" data-bs-toggle="tab" data-bs-target="#narrative" type="button" role="tab" aria-controls="narrative" aria-selected="false">
                        Activity Narrative ({{ $action_plan->narratives->count() }})
                    </button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="myTabContent">
                <!-- activity  -->
                @include('action_plans.tabs.plan_activity_tab')
                <!-- cohort  -->
                @include('action_plans.tabs.plan_cohort_tab')
                <!-- participant list  -->
                @include('action_plans.tabs.participant_list_tab')
                <!-- narrative  -->
                @include('action_plans.tabs.narrative_tab')
            </div>
        </div>
    </div>
    <!-- End Default Tabs -->
    @include('action_plans.partial.status_modal')
    @include('action_plans.partial.activity_modal')
    @include('action_plans.partial.activity_view_modal')
    @include('action_plans.partial.cohort_modal')
@stop

@section('script')
<script>
    // on status change
    $('#status').change(function() {
        if ($(this).val() == 'review') 
            $('#note').parents('.row').removeClass('d-none');
        else $('#note').parents('.row').addClass('d-none');
    }).change();

    // select2 config
    $('select').each(function() { $(this).css('width', '100%') });
    ['activity', 'region'].forEach(v => {
        $('#'+v).select2({allowClear: true, dropdownParent: $('#activity_modal')});
    });


    /**
     * Activity Modal
     **/
    // reset activity modal
    $('#activity_modal').on('hide.bs.modal', function() {
        $('#activity_modal_label').html('Add Activity');
        $('#activity_form').attr('action', @json(route('action_plans.store_activity')));
        $('#activity_form').trigger('reset');
        $('#item_id').val('');
        $('select option').each(function() { $(this).prop('selected', false).change(); });
    });
    // edit activity modal
    $('#activity_tbl').on('click', '.edit', function() {
        const url = $(this).attr('data-url');
        const plan_activity_id = $(this).attr('data-id');
        $.post(url, {plan_activity_id}, data => {
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
                    if (v.id == opt.attr('value')) opt.prop('selected', true).change();
                })
            });
        });
    });
    // show activity modal
    $('#activity_tbl').on('click', '.view', function() {
        const url = $(this).attr('data-url');
        const plan_activity_id = $(this).attr('data-id');
        $.post(url, {plan_activity_id}, data => {
            if (!data.id) return;
            const values = new Array(5).fill(null);
            if (data.activity) values[0] = data.activity.name;
            values[1] = data.start_date.split('-').reverse().join('-') + ' || ' +
                data.end_date.split('-').reverse().join('-');
            values[2] = data.regions.map(v => v.name).join(', ');
            values[3] = data.resources;
            values[4] = data.assigned_to;
            
            $('table.activity_view tr').each(function(i) {
                values.forEach((v,j) => {
                    if (i == j) {
                        if (!v) v = '';
                        $(this).find('td').html(v);
                    }
                });
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
            $('.addrow').addClass('d-none');
            if (!data.id) return;
            $('#cohort_modal_label').html('Edit Cohort');
            $('#cohort_form').attr('action', @json(route('action_plans.update_cohort')));
            $('#cohort_item_id').val(data.id);
            if (data.plan_activity) $('#cohort_activity').val(data.plan_activity.activity_id).change();
            const row = $('#cohorts_tbl tbody tr:first');
            row.find('.cohort_id').val(data.cohort_id).change();
            row.find('.target_no').val(data.target_no);
        });
    });

    // reset cohort modal
    $('#cohort_modal').on('hide.bs.modal', function() {
        $('.addrow').removeClass('d-none');
        $('#cohort_modal_label').html('Add Cohort');
        $('#cohort_form').attr('action', @json(route('action_plans.store_cohort')));
        $('#cohort_item_id').val('');
        $('#cohort_activity').val('').change();
        const row = $('#cohorts_tbl tbody tr:first');
        row.find('.cohort_id').val('').change();
        row.find('.target_no').val('');
    });
</script>
@stop