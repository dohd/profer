<div class="tab-pane fade show" id="narrativeTab" role="tabpanel" aria-labelledby="narrativeTab">
    <div class="row mb-2">
        <div class="col-12">
            <div class="float-end">
                <a href="{{ route('narratives.create') }}" style="color:inherit">
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
                <th>#No</th>
                <th>#Code</th>
                <th>Activity</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($action_plan->narratives as $i => $narrative)
                    <tr>
                        <th scope="row">{{ $i+1 }}</th>
                        <td><a href="{{ route('narratives.show', $narrative) }}">{{ tidCode('narrative', $narrative->tid) }}</a></td>
                        <td>{{ @$narrative->proposal_item->name }}</td>
                        <td><span class="badge bg-{{ $narrative->status == 'approved'? 'success' : 'secondary' }}">{{ $narrative->status }}</span></td>
                        <td>{{ dateFormat($narrative->date) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>