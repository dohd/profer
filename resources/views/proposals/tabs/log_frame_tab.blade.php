<div class="tab-pane fade show" id="log-frame" role="tabpanel" aria-labelledby="log-frame-tab">
    <div class="row my-2">
        <div class="col-md-12 col-12">
            <a href="{{ route('log_frames.create', ['proposal_id' => $proposal]) }}" class="badge bg-secondary text-white float-end">
                <i class="bi bi-plus-lg"></i> Log Frame
            </a>
        </div>
        <div class="col-md-12 col-12">
            <span>Dated: 
                @if (@$proposal->log_frame)
                    <a href="{{ route('log_frames.show', $proposal->log_frame) }}">
                        {{ dateFormat($proposal->log_frame->date, 'd-M-Y') }}
                    </a>
                @endif
            </span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            @php
                $labels = [
                    'Summary' => 'summary', 
                    'Indicator' => 'indicator', 
                    'Baseline' => 'baseline', 
                    'Target' => 'target', 
                    'Data Source' => 'data_source', 
                    'Frequency' => 'frequency', 
                    'Assign To' => 'assign_to'
                ];
            @endphp
            <thead>
                <tr>
                    <th class="bg-light"></th>
                    @foreach ($labels as $key => $value)
                        <th>{{ $key }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Goal (Impact)</th>
                    @foreach ($labels as $key => $value)
                        <td>{{ @$proposal->log_frame['goal_' . $value] }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Outcome (Objective)</th>
                    @foreach ($labels as $key => $value)
                        <td>{{ @$proposal->log_frame['outcome_' . $value] }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Result (Activity)</th>
                    @foreach ($labels as $key => $value)
                        <td>{{ @$proposal->log_frame['result_' . $value] }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>