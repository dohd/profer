<div class="tab-pane fade show" id="summary" role="tabpanel" aria-labelledby="summary-tab">
    <div class="row">
        <div class="col-6">
            @if (in_array($proposal->status, ['approved', 'pending']))
                <span class="badge bg-{{ $proposal->status == 'approved'? 'success' : 'secondary' }}">{{ $proposal->status }}</span>
            @endif
            <div class="text-center">
                
                @if ($proposal->status_note && $proposal->status == 'rejected')
                    <span class="badge bg-danger text-white">
                        Rejected
                    </span>
                    <br>
                    {{ $proposal->status_note }}
                @endif
            </div>
            <h5>
                #Proposal No : <b>PR-{{ $proposal->tid }}</b> <br>
                Region : <b>{{ @$proposal->region->name }}</b> <br>
                Sector : <b>{{ $proposal->sector }}</b> <br>
                Donor : <b>{{ @$proposal->donor->name }}</b>
            </h5>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h4 class="text-center text-primary"><b>{{ strtoupper($proposal->title) }}</b></h4>
            <h5 class="text-center">
                Period <b>{{ date('d-M-Y', strtotime($proposal->start_date)) }}</b> to <b>{{ date('d-M-Y', strtotime($proposal->end_date)) }}</b> <br>
                Budget <b>{{ number_format($proposal->budget, 2) }}</b>
            </h5>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <br>
            <!-- Proposal items -->
            <table class="table table-striped" id="objectivesTbl">
                <thead>
                    <tr class="">
                        <th scope="col" width="8%" class="text-center">#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposal->items as $item)
                        <tr>
                            <th scope="row" class="text-center">{{ $item->row_num }} </th>
                            <td>{{ $item->is_obj? 'objective' : 'activity' }}</td>
                            <td>{{ $item->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
