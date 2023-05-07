<div class="tab-pane fade show" id="agendaListTab" role="tabpanel" aria-labelledby="agendaListTab">
    <div class="row mb-2">
        <div class="col-12">
            <div class="float-end">
                @php
                    $params = [
                        'proposal_id' => $action_plan->proposal_id,
                        'action_plan_id' => $action_plan->id,
                    ];
                @endphp
                <a href="{{ route('agenda.create', $params) }}" style="color:inherit" target="_blank">
                    <span class="badge bg-secondary text-white" role="button">
                        <i class="bi bi-plus-lg"></i> Agenda
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
                <th>Agenda Title</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($action_plan->agenda as $i => $item)
                    <tr>
                        <th scope="row">{{ $i+1 }}</th>
                        <td><a href="{{ route('agenda.show', $item) }}">{{ tidCode('agenda', $item->tid) }}</a></td>
                        <td>{{ $item->title }}</td>
                        <td><span class="badge bg-{{ $item->status == 'approved'? 'success' : 'secondary' }}">{{ $item->status }}</span></td>
                        <td>{{ dateFormat($item->date) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> 
