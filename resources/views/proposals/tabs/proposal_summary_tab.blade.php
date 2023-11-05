<div class="tab-pane fade show" id="summary" role="tabpanel" aria-labelledby="summary-tab">
    <div class="row mb-2">
        <div class="col-12">
            @if (in_array($proposal->status, ['approved', 'pending']))
                <span class="badge bg-{{ $proposal->status == 'approved'? 'success' : 'secondary' }}">{{ $proposal->status }}</span>
            @endif
            <p class="text-center">
                @if ($proposal->status_note && $proposal->status == 'rejected')
                    <span class="badge bg-danger text-white">
                        Rejected
                    </span>
                    <br>
                    {{ $proposal->status_note }}
                @endif
            </p>
            <h5>
                #Proposal No : <b>{{ tidCode('proposal', $proposal->tid) }}</b> <br>
                Donor : <b>{{ @$proposal->donor->name }}</b>
            </h5>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-12">
            <h4 class="text-center text-primary"><b>{{ strtoupper($proposal->title) }}</b></h4>
            <h5 class="text-center">
                Period <b>{{ date('d-M-Y', strtotime($proposal->start_date)) }}</b> to <b>{{ date('d-M-Y', strtotime($proposal->end_date)) }}</b>
            </h5>
            <h5 class="text-center">Budget <b>{{ number_format($proposal->budget, 2) }}</b></h5>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Proposal items -->
            <h6>Objectives & Activities</h6>
            <table class="table table-striped" id="objectivesTbl">
                <thead>
                    <tr class="table-primary">
                        <th scope="col" width="5%" class="text-center">No.</th>
                        <th scope="col" width="8%">Item</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposal->items as $item)
                        <tr>
                            <th scope="row" class="text-center">{{ $item->row_num }}</th>
                            <td>{{ $item->is_obj? 'objective' : 'activity' }}</td>
                            <td>{{ $item->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
