@extends('layouts.core')

@section('title', 'Partipant Analysis')
    
@section('content')
    @include('reports.partial.participant_analysis_header')
    <div class="card">
        <div class="card-body">
            <div class="card-content pt-4">
                <div class="row mb-3">
                    <div class="col-6">
                        <select name="donor_id" id="donor" class="form-select select2 filter" data-placeholder="Search Donor">
                            <option value=""></option>
                            @foreach ($donors as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <select name="programme_id" id="programme" class="form-select select2 filter" data-placeholder="Search Programme">
                            <option value=""></option>
                            @foreach ($programmes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-3">
                        <select name="region_id" id="region" class="form-select select2 filter" data-placeholder="Search Region">
                            <option value=""></option>
                            @foreach ($regions as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="cohort_id" id="cohort" class="form-select select2 filter" data-placeholder="Search Cohort">
                            <option value=""></option>
                            @foreach ($cohorts as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="age_group_id" id="age_group" class="form-select select2 filter" data-placeholder="Search Age Group">
                            <option value=""></option>
                            @foreach ($age_groups as $item)
                                <option value="{{ $item->id }}">{{ $item->bracket }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="disability_id" id="disability" class="form-select select2 filter" data-placeholder="Search Disability">
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
            <div class="card-content p-2">
                <div class="mt-2">
                    <label for="date" class="d-inline-block p2" style="margin-right: .5em">Date Between</label>
                    <div class="d-inline-block p2" style="margin-right: .5em"><input type="date" placeholder="dd-mm-yyyy" class="str_date"></div>
                    <div class="d-inline-block p2" style="margin-right: .5em"><input type="date" placeholder="dd-mm-yyyy" class="end_date"></div>
                    <div class="d-inline-block p2"><span class="badge bg-primary date_search" role="button">search</span></div>
                    <hr>
                </div>
                <div class="overflow-auto">
                    <table class="table table-borderless" id="ps_analysis_tbl">
                        <thead>
                            <tr>
                                @php
                                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                @endphp
                                <th>&nbsp;</th>
                                @foreach ($months as $month)
                                    <th scope="col">{{ $month }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="male_r">
                                <th>Males</th>
                                @foreach (range(1,12) as $i)
                                    <td>_</td>
                                @endforeach
                            </tr>
                            <tr id="female_r">
                                <th>Females</th>
                                @foreach (range(1,12) as $i)
                                    <td>_</td>
                                @endforeach
                            </tr>
                            <tr id="total_r">
                                <th>Total</th>
                                @foreach (range(1,12) as $i)
                                    <td>_</td>
                                @endforeach
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
    // fetch default participants count data
    function fetchParticipantCount() {
        const url = "{{ route('reports.participant_analysis_data') }}";
        const params = {
            donor_id: $('#donor').val(),
            programme_id: $('#programme').val(),
            region_id: $('#region').val(),
            cohort_id: $('#cohort').val(),
            age_group_id: $('#age_group').val(),
            disability_id: $('#disability').val(),
            start_date: $('.str_date').val(),
            end_date: $('.end_date').val(),
        };
        $.post(url, params, data => {
            $('#ps_analysis_tbl tbody td').text('_');
            data.forEach(v => {
                $('#ps_analysis_tbl tbody tr').each(function() {
                    const row_id = $(this).attr('id');
                    $(this).find('td').each(function(i) {
                        if (v.month == i+1) {
                            let n;
                            if (row_id == 'male_r') n = v.male_count;
                            if (row_id == 'female_r') n = v.female_count;
                            if (row_id == 'total_r') n = v.total_count;
                            $(this).text(n);
                        }    
                    });
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

