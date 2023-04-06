<div class="tab-pane fade show" id="narrative" role="tabpanel" aria-labelledby="narrative-tab">
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>#No</th>
            <th>#Code</th>
            <th>Activity</th>
            <th>Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($proposal->narratives as $i => $narrative)
                <tr>
                    <th scope="row">{{ $i+1 }}</th>
                    <td><a href="{{ route('narratives.show', $narrative) }}">{{ tidCode('activity_narrative', $narrative->tid) }}</a></td>
                    <td>{{ $narrative->proposal_item? $narrative->proposal_item->name : '' }}</td>
                    <td><span class="badge bg-{{ $narrative->status == 'approved'? 'success' : 'secondary' }}">{{ $narrative->status }}</span></td>
                    <td>{{ dateFormat($narrative->date) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>