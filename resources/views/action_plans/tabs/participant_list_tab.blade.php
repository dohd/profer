<div class="tab-pane fade show" id="psListTab" role="tabpanel" aria-labelledby="psListTab">
    <div class="row mb-2">
        <div class="col-12">
            <div class="float-end">
                <a href="{{ route('participant_lists.create') }}" style="color:inherit">
                    <span class="badge bg-secondary text-white" role="button">
                        <i class="bi bi-plus-lg"></i> Add
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
                <th scope="col">Activity</th>
                <th scope="col">Region</th>
                <th scope="col">Ps</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($action_plan->participant_lists as $i => $item)
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
</div>