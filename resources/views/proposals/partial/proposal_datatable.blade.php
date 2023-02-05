@foreach ($proposals as $proposal)
<tr>
    <th scope="row">{{ $proposal->tid }}</th>
    <td><a href="{{ route('proposals.show', $proposal) }}" class="text-primary">{{ $proposal->title }}</a></td>
    <td>{{ dateFormat($proposal->start_date) }}</td>
    <td>{{ numberFormat($proposal->budget) }}</td>
    <td><span class="badge bg-{{ $proposal->status == 'approved'? 'success' : 'secondary' }}">{{ $proposal->status }}</span></td>
    <td>{{ $proposal->donor }}</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Action
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item pt-1 pb-1 view" href="{{ route('proposals.show', $proposal) }}"><i class="bi bi-eye-fill"></i>View</a></li>
                <li><a class="dropdown-item pt-1 pb-1 edit" href="{{ route('proposals.edit', $proposal) }}"><i class="bi bi-pencil-square"></i>Edit</a></li>
                <li><a class="dropdown-item pt-1 pb-1 destroy" href="javascript:" onclick="confirm('Are You sure?')"><i class="bi bi-trash text-danger icon-xs"></i>Delete</a></li>
            </ul>
        </div>
    </td>
</tr>
@endforeach