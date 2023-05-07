<div class="tab-pane fade show" id="log-frame" role="tabpanel" aria-labelledby="log-frame-tab">
    <div class="mt-2 mb-2">
        <span>Logical Framework As Of: </span>
        @if (@$proposal->log_frame)
            <a href="{{ route('log_frames.show', $proposal->log_frame) }}">
                 {{ dateFormat($proposal->log_frame->date, 'd-M-Y') }}
            </a>
        @endif
        <div class="float-end">
            <a href="{{ route('log_frames.create') }}" style="color:inherit" target="_blank">
                <span class="badge bg-secondary text-white" role="button">
                    <i class="bi bi-plus-lg"></i> Log Frame
                </span>
            </a>
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