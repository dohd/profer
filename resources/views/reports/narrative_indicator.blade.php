@extends('layouts.core')

@section('title', 'Narrative Indicator')
    
@section('content')
    @include('reports.partials.narrative_indicator_header')
    <div class="card">
        <div class="card-body">
            <div class="card-content pt-4">
                <div class="row mb-3">
                    <div class="col-12">
                        <select name="proposal_id" id="proposal" class="form-select select2 filter" data-placeholder="Choose Project">
                            <option value=""></option>
                            @foreach ($proposals as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <select name="narrative_id" id="narrative_no" class="form-select select2 filter" data-placeholder="Choose Narrative No." disabled>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-8">
                        <select name="narrative_pointer_id" id="indicator" class="form-select select2 filter" data-placeholder="Choose Narrative Indicator" disabled>
                            <option value=""></option>
                            @foreach ($narrative_pointers as $item)
                                <option value="{{ $item->id }}">{{ $item->value }}</option>
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
                    <tr><th width="20%">Project</th> <td id="t_project"></td></tr>
                    <tr><th width="20%">Narrative No.</th> <td id="t_narrative_no"></td></tr>
                    <tr><th width="20%">Programme</th> <td id="t_programme"></td></tr>
                    <tr><th width="20%">Region</th> <td id="t_region"></td></tr>
                    <tr><th width="20%">Cohort</th> <td id="t_cohort"></td></tr>
                </table>
                <br>
                <h5>Indicator: <b><span id="t_indicator"></span></b></h5>
                <p id="t_response"></p>
            </div>
        </div>
    </div> 
@stop

@section('script')
<script>
    // on proposal change fetch narratives
    $('#proposal').change(function() {
        $('#t_project').text($(this).find(':selected').text());
        // fetch narratives
        if ($(this).val()) {
            $.post("{{ route('reports.narrative_options') }}", {
                proposal_id: $(this).val(),
            }, data => {
                $('#narrative_no option:not(:first)').remove();
                data.forEach(v => {
                    $('#narrative_no').append(`<option value="${v.id}">${v.code}</option>`);
                });
                $('#narrative_no').prop('disabled', false);
            });
        } else {
            ['narrative_no', 'indicator'].forEach(v => {
                $('#'+v).prop('disabled', true);
                $('#'+v).find('option:not(:first)').remove();
            });
        }
    });

    // on narrative change
    $('#narrative_no').change(function() {
        $('#t_narrative_no').text($('#narrative_no').find(':selected').text());
        $('#indicator').prop('disabled', false);
    });

    // on indicator change
    $('#indicator').change(function() {
        $('#t_indicator').text($('#indicator').find(':selected').text());
        $('#t_response').text('');
        $('#t_programme').text('');
        $('#t_region').text('');
        $('#t_cohort').text('');
        // fetch narrative item
        if ($(this).val() && $('#narrative_no').val()) {
            $.post("{{ route('reports.narrative_indicator_data') }}", {
                narrative_id: $('#narrative_no').val(),
                narrative_pointer_id: $(this).val(),
            }, data => {
                // console.log(data)
                if (data.narrative_item) $('#t_response').text(data.narrative_item?.response);
                if (data.programmes) $('#t_programme').text(data.programmes.join(', '));
                if (data.regions) $('#t_region').text(data.regions.join(', '));
                if (data.cohorts) $('#t_cohort').text(data.cohorts.join(', '));
            });
        }
    });
</script>
@stop

