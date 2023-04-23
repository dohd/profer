<div class="tab-pane fade" id="summaryTab" role="tabpanel" aria-labelledby="summaryTab">
    <table class="table table-bordered">
        @php
            $details = [
                'Code' => tidCode('action_plan', $action_plan->tid),
                'Project Title' => @$action_plan->proposal->title,
                'Key Programme' => @$action_plan->programme->name,
                'Date' => dateFormat($action_plan->date, 'd-M-Y'),
                'Overseen By' => $action_plan->main_assigned_to,
            ];
        @endphp
        @foreach ($details as $key => $val)
            <tr>
                <th width="30%">{{ $key }}</th>
                <td>
                    @if ($key == 'Code')
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

    <ul class="nav nav-tabs" id="activityTabList" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="planActivity" data-bs-toggle="tab" data-bs-target="#planActivityTab" type="button" role="tab" aria-controls="planActivityTab" aria-selected="false">
                Plan Activity
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="planCohort" data-bs-toggle="tab" data-bs-target="#planCohortTab" type="button" role="tab" aria-controls="planCohortTab" aria-selected="false">
                Plan Target Cohort
            </button>
        </li>
    </ul>
    <div class="tab-content pt-2" id="activityTabContent">
        <!-- activity  -->
        @include('action_plans.tabs.plan_activity_tab')
        <!-- cohort  -->
        @include('action_plans.tabs.plan_cohort_tab')
    </div>
    @include('action_plans.partial.status_modal')
    @include('action_plans.partial.activity_modal')
    @include('action_plans.partial.activity_view_modal')
    @include('action_plans.partial.cohort_modal')
</div> 
