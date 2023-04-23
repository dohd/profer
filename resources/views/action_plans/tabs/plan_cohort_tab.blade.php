<div class="tab-pane fade" id="planCohortTab" role="tabpanel" aria-labelledby="planCohortTab">
    <div class="row mb-2">
        <div class="col-12">
            <div class="float-end">
                <span class="badge bg-primary text-white" role="button" id="cohort_md" data-bs-toggle="modal" data-bs-target="#cohort_modal">
                    <i class="bi bi-plus-lg"></i> Target Cohort
                </span>
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped datatable" id="cohort_list_tbl">
            <thead>
                <tr>
                    <th>#</th>
                    <th width="40%">Activity</th>
                    <th>Target Cohort</th>
                    <th>Target No.</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($action_plan->plan_cohorts as $i => $plan_cohort)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ isset($plan_cohort->plan_activity->activity)? $plan_cohort->plan_activity->activity->name : '' }}</td>
                        <td>{{ $plan_cohort->cohort? $plan_cohort->cohort->name : '' }}</td>
                        <td>{{ $plan_cohort->target_no }}</td>
                        <td>
                            <div class="dropdown"> 
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                                    Action 
                                </button> 
                                <ul class="dropdown-menu"> 
                                    <li>
                                        <a class="dropdown-item pt-1 pb-1 edit" href="#cohort_modal" data-bs-toggle="modal" data-id="{{ $plan_cohort->id }}" data-url="{{ route('action_plans.edit_cohort') }}">
                                            <i class="bi bi-pencil-square"></i>Edit
                                        </a>
                                    </li> 
                                    <li>
                                        <a class="dropdown-item pt-1 pb-1 destroy" href="javascript:"> 
                                            <i class="bi bi-trash text-danger icon-xs"></i>Delete 
                                            {{ Form::open(['route' => 'action_plans.destroy_cohort', 'method' => 'POST']) }}
                                                <input type="hidden" name="cohort_id" value="{{ $plan_cohort->id }}"> 
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
</div>