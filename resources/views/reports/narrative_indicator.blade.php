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
                        <select name="narrative_id" id="narrative_no" class="form-select select2 filter" data-placeholder="Choose Narrative No.">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-8">
                        <select name="narrative_pointer_id" id="indicator" class="form-select select2 filter" data-placeholder="Choose Narrative Indicator">
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
                    <tr><th width="20%">Narrative No.</th> <td id="t_narr"></td></tr>
                    <tr><th width="20%">Programme</th> <td id="t_prog"></td></tr>
                    <tr><th width="20%">Region</th> <td id="t_region"></td></tr>
                    <tr><th width="20%">Cohort</th> <td id="t_cohort"></td></tr>
                    <tr><th width="20%">Indicator</th> <td id="t_indicator"></td></tr>
                    <tr><th width="20%">Indicator Response</th> <td id="t_response"></td></tr>
                </table>
            </div>
        </div>
    </div> 
@stop

@section('script')
<script>
    // on proposal change fetch narratives
    $('#proposal').change(function() {
        $('#t_project').text($(this).find(':selected').text());

        $.post("{{ route('reports.narrative_indicator_narratives') }}", {
            proposal_id: $(this).val(),
        }, data => {
            $('#narrative_no option:not(:first)').remove();
            data.forEach(v => {
                const narr_no = `${v.tid}/${v.month}/${v.year}`;
                $('#narrative_no').append(`<option value="${v.id}" proposal_item_id="${v.proposal_item_id}">${narr_no}</option>`);
            });

        });
    });

    // on narrative no change
    $('#narrative_no').change(function() {
        $('#t_narr').text($('#narrative_no').find(':selected').text());
    });

    // on narrative indicator change
    $('#indicator').change(function() {
        $('#t_indicator').text($('#indicator').find(':selected').text());
    });
</script>
@stop

