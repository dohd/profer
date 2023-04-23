@foreach ($action_plans as $i => $plan)
    <tr>
        <th scope="row">{{ $i+1 }}</th>
        <td><a href="{{ route('action_plans.show', $plan) }}">{{ tidCode('action_plan', $plan->tid) }}</a></td>
        <td>{{ @$plan->proposal->title }}</td>
        <td>{{ @$plan->programme->name }}</td>
        <td><span class="badge bg-{{ $plan->status == 'approved'? 'success' : 'secondary' }}">{{ $plan->status }}</span></td>
        <td>{{ $plan->main_assigned_to }}</td>
        <td>{{ dateFormat($plan->date) }}</td>
        <td>{!! $plan->action_buttons !!}</td>
    </tr>
@endforeach