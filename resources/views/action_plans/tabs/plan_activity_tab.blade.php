<div class="tab-pane fade" id="planActivityTab" role="tabpanel" aria-labelledby="planActivityTab">
    <div class="row mb-2">
        <div class="col-12">
            <div class="float-end">
                <span class="badge bg-primary text-white" role="button" id="activity_md" data-bs-toggle="modal" data-bs-target="#activity_modal">
                    <i class="bi bi-plus-lg"></i> Activity
                </span>
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped datatable" id="activity_tbl">
            <thead>
                <tr>
                    <th scope="col" width="8%">#</th>
                    <th scope="col">Activity</th>
                    <th scope="col">Start</th>
                    <th scope="col">Region</th>
                    <th>Assigned To</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($action_plan->plan_activities as $i => $plan_activity)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>
                            {{ @$plan_activity->activity->name }}
                        </td>
                        <td>{{ dateFormat($plan_activity->start_date) }}</td>
                        <td>{{ implode(', ', $plan_activity->regions->pluck('name')->toArray()) }}</td>
                        <td>{{ $plan_activity->assigned_to }}</td>
                        <td>
                            <div class="dropdown"> 
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                                    Action 
                                </button> 
                                <ul class="dropdown-menu"> 
                                    <li>
                                        <a class="dropdown-item pt-1 pb-1 view" href="#activity_view_modal" data-bs-toggle="modal" data-id="{{ $plan_activity->id }}" data-url="{{ route('action_plans.edit_activity') }}">
                                            <i class="bi bi-eye-fill"></i>View
                                        </a>
                                    </li>
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
</div>
