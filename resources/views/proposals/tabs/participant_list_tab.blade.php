<div class="tab-pane fade show" id="participant-list" role="tabpanel" aria-labelledby="participant-list-tab">
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#No</th>
            <th scope="col">#Code</th>
            <th scope="col">Activity</th>
            <th scope="col">Region</th>
            <th scope="col">Ps</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($proposal->participant_lists as $i => $item)
                <tr>
                    <th scope="row">{{ $i+1 }}</th>
                    <td><a href="{{ route('participant_lists.show', $item) }}">{{ tidCode('participant_list', $item->tid) }}</a></td>
                    <td>{{ @$item->proposal_item->name }}</td>
                    <td>{{ @$item->region->name }}</td>
                    <td>{{ $item->total_count }}</td>
                    <td>{{ dateFormat($item->date) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>