@extends('layouts.core')

@section('title', 'Narrative Report')
    
@section('content')
    @include('reports.partial.narrative_report_header')
    <div class="card">
        <div class="card-body">
            <div class="card-content pt-4">
                <div class="row mb-3">
                    <div class="col-md-10 col-12">
                        <select id="activity" class="form-select select2 filter" data-placeholder="Search Activity Name">
                            <option value=""></option>
                            @foreach ($proposal_items as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }} ({{ @$item->proposal->title }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-12">
                        {{ Form::submit('Generate', ['class' => 'btn btn-primary btn-sm', 'id' => 'submit']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Agenda</th>
                                <th>Schedule</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><div>&nbsp;</div></td>
                            </tr>                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
@stop

@section('script')
<script>
    // on activity change
    const tableTempl = $('.table-responsive').html();
    $('#activity').change(function() {
        if (this.value) return;
        $('.table-responsive').html(tableTempl);     
    });
    $('#submit').click(function() {
        if (!$('#activity').val()) return $('.table-responsive').html(tableTempl); 
        $('.table-responsive').html("{{ spinner() }}");
        // fetch report
        const url = "{{ route('reports.narrative_data') }}";
        const params = {proposal_item_id: $('#activity').val() || 0};
        $.post(url, params, data => {
            $('.table-responsive').html(tableTempl);
            $('.table-responsive tbody').html(data);
        });   
    });
</script>
@stop

