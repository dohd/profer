<div class="row mb-3">
    <div class="col-10">
        <label for="title">Project Title*</label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $proposal)
                <option value="{{ $proposal->id }}" {{ @$log_frame->proposal_id == $proposal->id? 'selected' : '' }}>
                    {{ $proposal->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-2">
        <label for="date">Date*</label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<br>
<!-- Default Tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="goal-tab" data-bs-toggle="tab" data-bs-target="#goal" type="button" role="tab" aria-controls="home" aria-selected="true">Goal (Impact)</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="outcome-tab" data-bs-toggle="tab" data-bs-target="#outcome" type="button" role="tab" aria-controls="outcome" aria-selected="false">Outcome (Objective)</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="result-tab" data-bs-toggle="tab" data-bs-target="#result" type="button" role="tab" aria-controls="result" aria-selected="false">Result (Activity)</button>
    </li>
</ul>
<div class="tab-content pt-2" id="myTabContent">
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
    <!-- impact/goal  -->
    <div class="tab-pane fade show active" id="goal" role="tabpanel" aria-labelledby="goal-tab">
        <table class="table table-striped" id="impact_tbl">
            <tbody>
                
                @foreach ($labels as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>
                            {{ Form::textarea('goal_'.$value, null, ['class' => 'form-control', 'rows' => '2']) }}
                        </td>
                    </tr>   
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- outcome/objective  -->
    <div class="tab-pane fade" id="outcome" role="tabpanel" aria-labelledby="outcome-tab">
        <table class="table table-striped" id="impact_tbl">
            <tbody>
                @foreach ($labels as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>
                            {{ Form::textarea('outcome_'.$value, null, ['class' => 'form-control', 'rows' => '2']) }}
                        </td>
                    </tr>   
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- result/activity  -->
    <div class="tab-pane fade" id="result" role="tabpanel" aria-labelledby="result-tab">
        <table class="table table-striped" id="impact_tbl">
            <tbody>
                @foreach ($labels as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>
                            {{ Form::textarea('result_'.$value, @$result_row[str_replace('[]', '', $value)], ['class' => 'form-control', 'rows' => '2']) }}
                        </td>
                    </tr>   
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- End Default Tabs -->
