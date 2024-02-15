@foreach ($agenda as $i => $row)
    <tr>
        <th style="height: {{ count($agenda) == 1? '80px' : '' }}">{{ $i+1 }}</th>
        <td><a href="{{ route('agenda.show', $row) }}">{{ tidCode('agenda', $row->tid) }}</a></td>
        <td>{{ $row->title }}</td>
        <td><span class="badge bg-{{ $row->status == 'approved'? 'success' : 'secondary' }}">{{ $row->status }}</span></td>
        <td>{{ dateFormat($row->date)  }}</td>
        <td>{!! $row->action_buttons !!}</td>
    </tr>
@endforeach
