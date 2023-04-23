@foreach ($proposals as $i => $proposal)
<tr>
    <th scope="row">{{ $i+1 }}</th>
    <td><a href="{{ route('proposals.show', $proposal) }}">{{ tidCode('proposal', $proposal->tid) }}</a></td>
    <td>{{ $proposal->title }}</td>
    <td>{{ dateFormat($proposal->start_date) }}</td>
    <td>{{ numberFormat($proposal->budget) }}</td>
    <td><span class="badge bg-{{ $proposal->status == 'approved'? 'success' : 'secondary' }}">{{ $proposal->status }}</span></td>
    <td>{{ $proposal->donor? $proposal->donor->name : '' }}</td>
    <td>{!! $proposal->action_buttons !!}</td>
</tr>
@endforeach