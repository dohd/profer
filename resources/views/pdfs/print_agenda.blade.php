<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda</title>
    <style>
        
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Agenda Details
                <span class="badge bg-secondary text-white float-end" role="button" data-bs-toggle="modal" data-bs-target="#status_modal">
                    <i class="bi bi-pencil-fill"></i> Status
                </span>
            </h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            'Agenda No.' => tidCode('agenda', $agenda->tid),
                            'Agenda Title' => $agenda->title,
                            'Date' => dateFormat($agenda->date, 'd-M-Y'),
                            'Project Title' => @$agenda->proposal->title,
                            'Activity' => @$agenda->proposal_item->name,
                            'Action Plan No.' => $agenda->action_plan? tidCode('action_plan', $agenda->action_plan->tid) : '',
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>
                                @if ($key == 'Agenda No.')
                                    {{ $val }} || 
                                    <span class="badge bg-{{ $agenda->status == 'approved'? 'success' : 'secondary' }}">
                                        {{ $agenda->status }}
                                    </span>
                                @elseif($key == 'Project Title' && $val)
                                    <a href="{{ route('proposals.show', $agenda->proposal) }}">{{ $val }}</a>
                                @elseif ($key == 'Action Plan No.' && $val)
                                    <a href="{{ route('action_plans.show', $agenda->action_plan) }}">{{ $val }}</a>
                                @else
                                {{ $val}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if ($agenda->status == 'review' && $agenda->status_note)
                        <tr>
                            <th width="30%">Review Remark</th>
                            <td>{{ $agenda->status_note }}</td>
                        </tr>
                    @endif
                </table>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped" id="agendaItemsTbl">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="20%">Period (Start-End)</th>
                                <th scope="col" width="50%">Topic</th>
                                <th scope="col">Assigned To</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agenda->items as $i => $item)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td><b>{{ timeFormat($item->time_from) }}</b> to <b>{{ timeFormat($item->time_to) }}</b></td>
                                    <td>{{ $item->topic }}</td>
                                    <td>{{ $item->assigned_to }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>