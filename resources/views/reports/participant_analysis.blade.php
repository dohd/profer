@extends('layouts.core')

@section('title', 'Partipant Analysis')
    
@section('content')
    @include('reports.partials.participant_analysis_header')
    <div class="card">
        <div class="card-body">
            <div class="card-content pt-4">
                <div class="row mb-3">
                    <div class="col-6">
                        <select name="donor_id" id="donor" class="form-select select2 filter" data-placeholder="Choose Donor">
                            <option value=""></option>
                            @foreach ($donors as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <select name="programme_id" id="programme" class="form-select select2 filter" data-placeholder="Choose Programme">
                            <option value=""></option>
                            @foreach ($programmes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-3">
                        <select name="region_id" id="region" class="form-select select2 filter" data-placeholder="Choose Region">
                            <option value=""></option>
                            @foreach ($regions as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="cohort_id" id="cohort" class="form-select select2 filter" data-placeholder="Choose Cohort">
                            <option value=""></option>
                            @foreach ($cohorts as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="age_group_id" id="age_group" class="form-select select2 filter" data-placeholder="Choose Age Group">
                            <option value=""></option>
                            @foreach ($age_groups as $item)
                                <option value="{{ $item->id }}">{{ $item->bracket }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="disability_id" id="disability" class="form-select select2 filter" data-placeholder="Choose Disability">
                            <option value=""></option>
                            @foreach ($disabilities as $item)
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
            <div class="card-header">
                No. of Participants
            </div>
            <div class="card-content p-2">
                <div class="mt-1">
                    <label for="date" class="d-inline-block p2" style="margin-right: .5em">Date Between</label>
                    <div class="d-inline-block p2" style="margin-right: .5em"><input type="date" placeholder="dd-mm-yyyy" class="str_date"></div>
                    <div class="d-inline-block p2" style="margin-right: .5em"><input type="date" placeholder="dd-mm-yyyy" class="end_date"></div>
                    <div class="d-inline-block p2"><span class="badge bg-primary date_search" role="button">search</span></div>
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
                                <td>_</td>
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
    // fetch default participants count data
    function fetchParticipantCount() {
        $.post("{{ route('reports.participant_analysis_data') }}", {
            donor_id: $('#donor').val(),
            programme_id: $('#programme').val(),
            region_id: $('#region').val(),
            cohort_id: $('#cohort').val(),
            age_group_id: $('#age_group').val(),
            disability_id: $('#disability').val(),
            start_date: $('.str_date').val(),
            end_date: $('.end_date').val(),
        }, data => {
            $('#ps_analysis_tbl tbody td').each(function(i) {
                $(this).text('_');
                data.forEach(v => {
                    if (v.month == (i+1)) $(this).text(v.total_count);
                });
            });
        });
    }
    fetchParticipantCount();

    // on change filters 
    $(document).on('change', '.filter', function() {
        fetchParticipantCount();
    });

    // on date search dates
    $('.date_search').click(function() {
        fetchParticipantCount();
    });
    // on reset dates
    $(document).on('change', '.str_date, .end_date', function() {
        if (!$(this).val()) {
            fetchParticipantCount();
            $('.str_date').val('');
            $('.end_date').val('');
        }
    });
</script>
@stop

