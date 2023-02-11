@extends('layouts.core')

@section('title', 'Narrative Indicator')
    
@section('content')
    @include('reports.partials.narrative_indicator_header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p2">
                <div class="row">
                    <div class="col-12">
                        <select name="proposal_id" id="proposal" class="form-select mt-3">
                            <option value="">-- Choose Project --</option>
                            @foreach ($proposals as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <select name="narrative_pointer_id" id="indicator" class="form-select mt-3">
                            <option value="">-- Choose Narrative No. --</option>
                            @foreach (range(1,5) as $item)
                                <option value="{{ $item }}">{{ $item }}/{{ $item }}/2023 </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-8">
                        <select name="narrative_pointer_id" id="indicator" class="form-select mt-3">
                            <option value="">-- Choose Narrative Indicator --</option>
                            @foreach ($narrative_pointers as $item)
                                <option value="{{ $item->id }}">{{ $item->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
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
                    <div class="col-4">
                        <select name="cohort_id" id="cohort" class="form-select mt-3">
                            <option value="">-- Choose Cohort --</option>
                            @foreach ($cohorts as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-bordered mt-3">
                    <tr><th width="20%">Project</th> <td class="project"></td></tr>
                    <tr><th width="20%">Narrative No.</th> <td class="narrative_no"></td></tr>
                    <tr><th width="20%">Programme</th> <td class="programme"></td></tr>
                    <tr><th width="20%">Region</th> <td class="region"></td></tr>
                    <tr><th width="20%">Cohort</th> <td class="cohort"></td></tr>
                </table>
                <h5 class="narrative_ind">Narrative Indicator: </h5>
                <p class="response"></p>
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
    // $('#indicator').change(function() {
    //     $.post("{{ '#' }}", {narrative_pointer_id: $(this).val()}, data => {
    //         dataTable.destroy();
    //         $('#indicator_narrative_tbl tbody').html(data);
    //         dataTable = new simpleDatatables.DataTable($('#indicator_narrative_tbl')[0]);
    //     });
    // });
</script>
@stop

