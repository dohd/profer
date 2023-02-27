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