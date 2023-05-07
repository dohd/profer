<div class="tab-pane fade show" id="action-plan" role="tabpanel" aria-labelledby="action-plan-tab">
    <div class="row mt-2 mb-2">
        <div class="col-12">
            <div class="float-end">
                @php($params=['proposal_id' => $proposal->id])
                <a href="{{ route('action_plans.create', $params) }}" style="color:inherit" target="_blank">
                    <span class="badge bg-secondary text-white" role="button">
                        <i class="bi bi-plus-lg"></i> Action Plan
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#No</th>
                    <th scope="col">#Code</th>
                    <th scope="col">Key Programme</th>
                    <th scope="col">Status</th>
                    <th scope="col">Overseen By</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proposal->action_plans as $i => $plan)
                    <tr>
                        <th>{{ $i+1 }}</th>
                        <td><a href="{{ route('action_plans.show', $plan) }}">{{ tidCode('action_plan', $plan->tid) }}</a></td>
                        <td>{{ @$plan->programme->name }}</td>
                        <td><span class="badge bg-{{ $plan->status == 'approved'? 'success' : 'secondary' }}">{{ $plan->status }}</span></td>
                        <td>{{ $plan->main_assigned_to }}</td>
                        <td>{{ dateFormat($plan->date) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
