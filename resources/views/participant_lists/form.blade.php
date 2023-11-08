<!-- Participants -->
<div class="row mb-3">
    <div class="col-md-12 col-12">
        <fieldset class="border rounded-3 p-3">
            <legend class="float-none w-auto px-1 fs-5">Participants</legend>
            <div class="row mb-3">
                <div class="col-md-8 col-12">
                    <label for="title">Project Title<span class="text-danger">*</span></label>
                    <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
                        <option value=""></option>
                        @foreach ($proposals as $key => $value)
                            <option value="{{ $key }}" {{ @$participant_list->proposal_id == $key? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>   
                </div>
                <div class="col-md-4 col-12">
                    <label for="plan">Action Plan No<span class="text-danger">*</span></label>
                    <select name="action_plan_id" id="action_plan" class="form-control select2" data-placeholder="Choose Action Plan" required disabled>
                        <option value=""></option>
                        @if(@$participant_list)
                            @foreach ($participant_list->action_plans as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $participant_list->action_plan_id? 'selected' : '' }}>{{ $item->code }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 col-12">
                    <label for="region">Region<span class="text-danger">*</span></label>
                    <select name="region_id" id="region" class="form-select select2" data-placeholder="Choose Region" required disabled>
                        <option value=""></option>
                        @if(@$participant_list)
                            @foreach ($participant_list->regions as $key => $value)
                                <option value="{{ $key }}" {{ $key == $participant_list->region_id? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3 col-12">
                    <label for="cohort">Cohort<span class="text-danger">*</span></label>
                    <select name="cohort_id" id="cohort" class="form-select select2" data-placeholder="Choose Cohort" required disabled>
                        <option value=""></option>
                        @if(@$participant_list)
                            @foreach ($participant_list->cohorts as $key => $value)
                                <option value="{{ $key }}" {{ $key == $participant_list->cohort_id? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
                <div class="col-md-6 col-12">
                    <label for="title">Activity<span class="text-danger">*</span></label>
                    <select name="proposal_item_id" id="activity" class="form-control select2" data-placeholder="Choose Activity" required disabled>
                        <option value=""></option>
                        @if(@$participant_list)
                            @foreach ($participant_list->proposal_items as $key => $value)
                                <option value="{{ $key }}" {{ $key == $participant_list->proposal_item_id? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6 col-12">
                    <label for="no_participants">Participants Count<span class="text-danger">*</span></label>
                    <div class="row g-0">
                        <div class="col-md-4">{{ Form::text('male_count', null, ['class' => 'form-control', 'placeholder' => 'MALE', 'required' => 'required']) }}</div>
                        <div class="col-md-4">{{ Form::text('female_count', null, ['class' => 'form-control', 'placeholder' => 'FEMALE', 'required' => 'required']) }}</div>
                        <div class="col-md-4">{{ Form::text('total_count', null, ['class' => 'form-control', 'placeholder' => 'TOTAL', 'required' => 'required']) }}</div>
                    </div>
                </div>
                
                <div class="col-md-6 col-12">
                    <label class="form-label" for="file">Partipant List</label>
                    {{ Form::file('file', ['class' => 'form-control', 'id' => 'file', 'accept' => '.csv, .pdf, .xls, .xlsx, .doc, .docx' ]) }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 col-12">
                    <label for="date">Activity Date<span class="text-danger">*</span></label>
                    {{ Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
                <div class="col-md-3 col-12">
                    <label for="prepared_by">Prepared By</label>
                    {{ Form::text('prepared_by', null, ['class' => 'form-control']) }}
                </div>
                
            </div>
        </fieldset>
    </div>
</div>
<!-- End Participants -->

<!-- Reimbursement -->
<div class="row mb-3">
    <div class="col-md-12 col-12">
        <fieldset class="border rounded-3 p-3">
            <legend class="float-none w-auto px-1 fs-5">Reimbursment</legend>
            <div class="row">
                <div class="col-md-2 col-12">
                    <label for="prepared_by">Total Amount</label>
                    {{ Form::text('refund_amount', null, ['class' => 'form-control mt-2']) }}
                </div>
                <div class="col-md-2 col-12">
                    <label for="prepared_by">Total Participants</label>
                    {{ Form::text('refund_ps_count', null, ['class' => 'form-control mt-2']) }}
                </div>
                <div class="col-md-5 col-12">
                    <label class="form-label" for="file">Reimbursement List</label>
                    {{ Form::file('file2', ['class' => 'form-control', 'id' => 'file2', 'accept' => '.csv, .pdf, .xls, .xlsx, .doc, .docx' ]) }}
                </div>
                <div class="col-md-3 col-12">
                    <label for="accounted_by">Accounted By</label>
                    {{ Form::text('accounted_by', null, ['class' => 'form-control mt-2']) }}
                </div>
            </div>
        </fieldset>
    </div>
</div>
<!-- End Reimbursement -->

<!-- Participants Table -->
{{-- @include('participant_lists.partial.participants_table') --}}

@section('script')
<script>
    // on submit form
    $('form').submit(function(e) {
        // validate first line
        let rows = $('#participants_tbl tbody tr');
        if (rows.length == 1 && !$(this).find('.name').val()) {
            e.preventDefault();
            rows.find('.name').attr('required', true);
            return;
        }
        // remove empty lines
        rows.each(function() {
            if (!$(this).find('.name').val()) $(this).remove();
        });
    });

    // add row
    let rowCount = 1;
    let initRow = $('#participants_tbl tbody tr:first').html();
    $('.addrow').click(function() {
        rowCount++;
        $('#participants_tbl tbody').append(`<tr>${initRow}</tr>`);
        const row = $('#participants_tbl tbody tr:last');
        row.find('.num').text(rowCount);
        // add select2 to added row
        row.find('select.custom').each(function() {
            $(this).select2({allowClear: true});
        });
    });
    // add select2 to default row
    $('#participants_tbl tbody tr:first').find('select.custom').select2({allowClear: true});

    // remove row
    $('#participants_tbl').on('click', '.del', function() {
        const row = $(this).parents('tr');
        if (!row.siblings().length) return;
        row.remove();
        rowCount--;
    });

    // on proposal change
    $('#proposal').change(function() {
        if ($(this).val()) {
            const url = @json(route('action_plans.select_items'));
            const params = {
                proposal_id: $(this).val(),
                is_participant_list: 1,
            };
            // fetch action plans
            $.post(url, params, data => {
                $('#action_plan option:not(:first)').remove();
                data.forEach(v => {
                    const planId = @json(@$participant_list->action_plan_id);
                    $('#action_plan').append(`<option value="${v.id}" ${v.id == planId? 'selected' : ''}>${v.code}</option>`);
                });
                $('#action_plan').prop('disabled', false);
            });
        } else {
            ['action_plan', 'activity', 'region', 'cohort'].forEach(v => {
                $('#'+v).prop('disabled', true);
                $('#'+v).find('option:not(:first)').remove();
            });
        }
    });

    // on action plan change
    $('#action_plan').change(function() {
        if ($(this).val()) {
            const url = @json(route('action_plans.proposal_items'));
            const params = {
                plan_id: $(this).val(),
                is_participant_list: 1,
            };
            // fetch activities
            $.post(url, params, data => {
                const activityId = @json(@$participant_list->proposal_item_id);
                $('#activity option:not(:first)').remove();
                data.forEach(v => {
                    $('#activity').append(`<option value="${v.id}" ${v.id == activityId? 'selected' : ''}>${v.name}</option>`);
                });
                $('#activity').prop('disabled', false);
            });
        } else {
            ['activity', 'region', 'cohort'].forEach(v => {
                $('#'+v).prop('disabled', true);
                $('#'+v).find('option:not(:first)').remove();
            });
        }
    });

    // on activity change
    $('#activity').change(function() {
        if ($(this).val()) { 
            const url = @json(route('action_plans.select_activity_items'));
            const params = {
                activity_id: $(this).val(),
                is_participant_list: 1,
            };
            // fetch regions & cohorts
            $.post(url, params, data => {
                $('#region option:not(:first)').remove();
                $('#cohort option:not(:first)').remove();
                if (!data.regions || !data.cohorts) return;
                data.regions.forEach(v => {
                    $('#region').append(`<option value="${v.id}">${v.name}</option>`);
                });
                data.cohorts.forEach(v => {
                    $('#cohort').append(`<option value="${v.id}">${v.name}</option>`);
                });
                ['region', 'cohort'].forEach(v => {
                    $('#'+v).prop('disabled', false);
                });
            });
        } else {
            ['region', 'cohort'].forEach(v => {
                $('#'+v).prop('disabled', true);
                $('#'+v).find('option:not(:first)').remove();
            });
        }
    });


    /**
     * Edit Mode
     **/
    const psList = @json(@$participant_list);
    if (psList) {
        $('#participants_tbl tbody tr:first').remove();
        ['action_plan', 'activity', 'region', 'cohort'].forEach(v => {
            $('#'+v).prop('disabled', false);
        });
        const row = $('#participants_tbl tbody tr:last');
        rowCount = row.find('.num').text()*1 || 0;
    }

    // short link from action plan
    const reqParams = @json(request()->only('proposal_id', 'action_plan_id'));
    if (!Array.isArray(reqParams)) {
        $('#proposal').val(reqParams.proposal_id).change();
        setTimeout(() => {
            $('#action_plan').val(reqParams.action_plan_id).change();
        }, 1000);
    }
</script>
@stop