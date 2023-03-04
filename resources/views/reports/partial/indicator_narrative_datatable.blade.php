@foreach ($narrative_items as $i => $item)
    <tr>
        <th scope="row">{{ $i+1 }}</th>
        <td>{{ dateFormat() }}</td>
        <td>{{ '' }}</td>
        <td>{{ $item->proposal_item? $item->proposal_item->name : ''  }}</td>
        <td>{{ '' }}</td>
        <td>{{ '' }}</td>
        <td>{{ '' }}</td>
        <td>{{ $item->response }}</td>
    </tr>
@endforeach