<div class="tab-pane fade show" id="log-frame" role="tabpanel" aria-labelledby="log-frame-tab">
    Logical Framework As Of: 
    @if (@$proposal->log_frame)
        <a href="{{ route('log_frames.show', $proposal->log_frame) }}">
             {{ dateFormat($proposal->log_frame->date, 'd-M-Y') }}
        </a>
    @endif

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
    <div class="table-responsive">
        <table class="table table-bordered">
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