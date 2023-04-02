<div class="row mb-3">
    <div class="col-9">
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
    <div class="col-3">
        <label for="date">Date*</label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>

@php
    $labels = [
        'summary' => 'Summary', 
        'indicator' => 'Indicator', 
        'baseline' => 'Baseline',
        'target' => 'Target',
        'data_source' => 'Data Source',
        'frequency' => 'Frequency',  
        'assign_to' => 'Assign To',
    ];

    $goal_placeholders = [
        'summary' => 'What is the overal broader impact to which the action will contribute?',
        'indicator' => 'What are the key indicators related to the overal goal?', 
        'baseline' => 'What is the current status of state of events?',
        'target' => 'What is the objective based on the broader impact?',
        'data_source' => 'What are the sources of information for these indicators?',
        'frequency' => 'How periodic is data collected and through which data source?',  
        'assign_to' => 'Person responsible',
    ];
    $objective_placeholders = array_replace($goal_placeholders, [
        'summary' => 'What are the immediate development outcome at the end of the project?',
        'indicator' => 'Which indicators clearly show that the objective of the action has been achieved?', 
        'target' => 'What are the objectives based on the development outcome?',
    ]);
    $result_placeholders = array_replace($goal_placeholders, [
        'summary' => 'What are the key activities to be carried out and in what sequence in order to produce the desired results?',
        'indicator' => 'What are the means required to implement these activites?', 
        'target' => 'What are the objective based on the key activities carried out?',
    ]);
@endphp

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
    <!-- impact/goal  -->
    <div class="tab-pane fade show active" id="goal" role="tabpanel" aria-labelledby="goal-tab">
        <table class="table table-striped" id="impact_tbl">
            <tbody>
                @foreach ($labels as $key => $value)
                    <tr>
                        <td class="p-3" width="15%">{{ $value }}</td>
                        <td>
                            {{ Form::textarea('goal_'.$key, null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => @$goal_placeholders[$key]]) }}
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
                        <td class="p-3" width="15%">{{ $value }}</td>
                        <td>
                            {{ Form::textarea('outcome_'.$key, null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => @$objective_placeholders[$key]]) }}
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
                        <td class="p-3" width="15%">{{ $value }}</td>
                        <td>
                            {{ Form::textarea('result_'.$key, @$result_row[str_replace('[]', '', $key)], ['class' => 'form-control', 'rows' => '2', 'placeholder' => @$result_placeholders[$key]]) }}
                        </td>
                    </tr>   
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- End Default Tabs -->
