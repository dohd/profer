@extends('layouts.core')

@section('title', 'Partipant Analysis')
    
@section('content')
    @include('reports.partials.participant_analysis_header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p2">
                <div class="row">
                    <div class="col-4">
                        <select name="donor_id" id="donor" class="form-select mt-3">
                            <option value="">-- Choose Donor --</option>
                            @foreach ($donors as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <select name="programme_id" id="programme" class="form-select mt-3">
                            <option value="">-- Choose Programme --</option>
                            @foreach ($programmes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <select name="region_id" id="region" class="form-select mt-3">
                            <option value="">-- Choose Region --</option>
                            @foreach ($regions as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <select name="cohort_id" id="cohort" class="form-select mt-3">
                            <option value="">-- Choose Cohort --</option>
                            @foreach ($cohorts as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <select name="disability_id" id="disability" class="form-select mt-3">
                            <option value="">-- Choose Disability --</option>
                            @foreach ($disabilities as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <select name="age_group_id" id="age_group" class="form-select mt-3">
                            <option value="">-- Choose Age Group --</option>
                            @foreach ($age_groups as $item)
                                <option value="{{ $item->id }}">{{ $item->bracket }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                No. of Participants
            </div>
            <div class="card-content p-2">
                <div class="mt-1">
                    <label for="date" class="d-inline-block p2" style="margin-right: .5em">Date Between</label>
                    <div class="d-inline-block p2" style="margin-right: .5em"><input type="date"></div>
                    <div class="d-inline-block p2" style="margin-right: .5em"><input type="date"></div>
                    <div class="d-inline-block p2"><span class="badge bg-primary" role="button">search</span></div>
                    <hr>
                </div>
                <table class="table table-borderless" id="ps_analysis_tbl">
                    <thead>
                      <tr>
                        @php
                            $months = [
                                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                            ];
                        @endphp
                        @foreach ($months as $month)
                            <th scope="col">{{ $month }}</th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach (range(1,12) as $item)
                                <td>{{ rand(0,100) }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    // initialize datatable
    let dataTable;
    // $.post("{{ '#' }}", {}, data => {
    //     $('#indicator_narrative_tbl tbody').html(data);
    //     dataTable = new simpleDatatables.DataTable($('#indicator_narrative_tbl')[0]);
    // });

    // indicator on change
    $('#indicator').change(function() {
        // $.post("{{ '#' }}", {narrative_pointer_id: $(this).val()}, data => {
        //     dataTable.destroy();
        //     $('#indicator_narrative_tbl tbody').html(data);
        //     dataTable = new simpleDatatables.DataTable($('#indicator_narrative_tbl')[0]);
        // });
    });
</script>
@stop

