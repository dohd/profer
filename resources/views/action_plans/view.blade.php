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
                    <span class="badge bg-primary text-white" role="button" data-bs-toggle="modal" data-bs-target="#activity_modal">
                        <i class="bi bi-plus-lg"></i> Activity
                    </span>
                    <span class="badge bg-success text-white" role="button" data-bs-toggle="modal" data-bs-target="#cohort_modal">
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
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table table-striped datatable" id="activity_tbl">
                        <thead>
                            <tr>
                                <th scope="col" width="8%">#</th>
                                <th scope="col">Activity</th>
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                                <th width="14%">Region</th>
                                <th>Resources</th>
                                <th>Assigned To</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($action_plan->plan_activities as $i => $plan_activity)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $plan_activity->activity? $plan_activity->activity->name : '' }}</td>
                                    <td>{{ dateFormat($plan_activity->start_date) }}</td>
                                    <td>{{ dateFormat($plan_activity->end_date) }}</td>
                                    <td>{{ implode(', ', $plan_activity->regions->pluck('name')->toArray()) }}</td>
                                    <td>{{ $plan_activity->resources }}</td>
                                    <td>{{ $plan_activity->assigned_to }}</td>
                                    <td>
                                        <div class="dropdown"> 
                                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                                                Action 
                                            </button> 
                                            <ul class="dropdown-menu"> 
                                                <li>
                                                    <a class="dropdown-item pt-1 pb-1 edit" href="#activity_modal" data-bs-toggle="modal" data-id="{{ $plan_activity->id }}" data-url="{{ route('action_plans.edit_activity') }}">
                                                        <i class="bi bi-pencil-square"></i>Edit
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a class="dropdown-item pt-1 pb-1 destroy" href="javascript:"> 
                                                        <i class="bi bi-trash text-danger icon-xs"></i>Delete 
                                                        {{ Form::open(['route' => 'action_plans.destroy_activity', 'method' => 'POST']) }}
                                                            <input type="hidden" name="activity_id" value="{{ $plan_activity->id }}"> 
                                                        {{ Form::close() }}
                                                    </a>
                                                </li> 
                                            </ul> 
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- cohort  -->
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table table-striped datatable" id="cohort_tbl">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Activity</th>
                                <th width="50%">Cohort</th>
                                <th scope="col">Targeted No.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($action_plan->plan_cohorts as $i => $plan_cohort)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ isset($plan_cohort->action_plan_activity->activity)? $plan_cohort->action_plan_activity->activity->name : '' }}</td>
                                    <td>{{ $plan_cohort->cohort? $plan_cohort->cohort->name : '' }}</td>
                                    <td>{{ $plan_cohort->target_no }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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

</script>
@stop