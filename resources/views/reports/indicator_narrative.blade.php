@extends('layouts.core')

@section('title', 'Indicator Narrative Report')
    
@section('content')
    @include('reports.partial.indicator_narrative_header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p2">
                <div class="row">
                    <div class="col-7">
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
                    <div class="col-3">
                        <select name="region_id" id="region" class="form-select mt-3">
                            <option value="">-- Choose Region --</option>
                            @foreach ($regions as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
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
                <table class="table table-borderless" id="indicator_narrative_tbl">
                    <thead>
                      <tr>
                        <th scope="col">#No</th>
                        <th scope="col" width="15%">Date</th>
                        <th scope="col">Programme</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Region</th>
                        <th scope="col">Cohort</th>
                        <th scope="col" width="12%">Ps. Count</th>
                        <th scope="col">Response</th>
                      </tr>
                    </thead>
                    <tbody>
                        
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
    $.post("{{ route('reports.indicator_narrative_datatable') }}", {}, data => {
        $('#indicator_narrative_tbl tbody').html(data);
        dataTable = new simpleDatatables.DataTable($('#indicator_narrative_tbl')[0]);
    });

    // indicator on change
    $('#indicator').change(function() {
        $.post("{{ route('reports.indicator_narrative_datatable') }}", {narrative_pointer_id: $(this).val()}, data => {
            dataTable.destroy();
            $('#indicator_narrative_tbl tbody').html(data);
            dataTable = new simpleDatatables.DataTable($('#indicator_narrative_tbl')[0]);
        });
    });
</script>
@stop

