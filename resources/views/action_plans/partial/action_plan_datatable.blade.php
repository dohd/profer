@foreach ($action_plans as $plan)
    <tr>
        <th scope="row"><a href="#">{{ $plan->tid }}</a></th>
        <td><a href="{{ route('action_plans.show', $plan) }}">{{ tidCode('action_plan', $plan->tid) }}</a></td>
        <td><a href="{{ route('proposals.show', $plan->proposal) }}">{{ $plan->proposal->title }}</a></td>
        <td>{{ @$plan->programme->name }}</td>
        <td><span class="badge bg-{{ $plan->status == 'approved'? 'success' : 'secondary' }}">{{ $plan->status }}</span></td>
        <td>{{ $plan->main_assigned_to }}</td>
        <td>{{ dateFormat($plan->date) }}</td>
        <td>{!! $plan->action_buttons !!}</td>
    </tr>
@endforeach