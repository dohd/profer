@foreach ($proposals as $proposal)
<tr>
    <th scope="row">{{ $proposal->tid }}</th>
    <td><a href="{{ route('proposals.show', $proposal) }}" class="text-primary">{{ $proposal->title }}</a></td>
    <td>{{ dateFormat($proposal->start_date) }}</td>
    <td>{{ numberFormat($proposal->budget) }}</td>
    <td><span class="badge bg-{{ $proposal->status == 'approved'? 'success' : 'secondary' }}">{{ $proposal->status }}</span></td>
    <td>{{ $proposal->donor? $proposal->donor->name : '' }}</td>
    <td>{!! $proposal->action_buttons !!}</td>
</tr>
@endforeach