<div class="tab-pane fade show" id="summary" role="tabpanel" aria-labelledby="summary-tab">
    <table class="table table-bordered">
        @php
            $details = [
                'Project Title' => @$action_plan->proposal->title,
                'Key Programme' => @$action_plan->programme->name,
                'Date' => dateFormat($action_plan->date),
                'Overseen By' => $action_plan->main_assigned_to,
            ];
        @endphp
        @foreach ($details as $key => $val)
            <tr>
                <th width="30%">{{ $key }}</th>
                <td>
                    @if ($key == 'Project Title')
                        @if ($action_plan->proposal)
                            <a href="{{ route('proposals.show', $action_plan->proposal) }}">{{ $val }}</a> 
                        @else
                            {{ $val }}
                        @endif
                        || <span class="badge bg-{{ $action_plan->status == 'approved'? 'success' : 'secondary' }}">{{ $action_plan->status }}</span>
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

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                Plan Activity
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                Plan Target Cohort
            </button>
        </li>
    </ul>
    <div class="tab-content pt-2" id="myTabContent2">
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
