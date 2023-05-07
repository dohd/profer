<div class="row mb-3">
    <div class="col-8">
        <label for="title">Project Title*</label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $key => $value)
                <option value="{{ $key }}" {{ @$participant_list->proposal_id == $key? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>   
    </div>
    <div class="col-4">
        <label for="plan">Action Plan No*</label>
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
    <div class="col-6">
        <label for="title">Activity*</label>
        <select name="proposal_item_id" id="activity" class="form-control select2" data-placeholder="Choose Activity" required disabled>
            <option value=""></option>
            @if(@$participant_list)
                @foreach ($participant_list->proposal_items as $key => $value)
                    <option value="{{ $key }}" {{ $key == $participant_list->proposal_item_id? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="col-3">
        <label for="date">Date*</label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-3">
        <label for="region">Region*</label>
        <select name="region_id" id="region" class="form-select select2" data-placeholder="Choose Region" required disabled>
            <option value=""></option>
            @if(@$participant_list)
                @foreach ($participant_list->regions as $key => $value)
                    <option value="{{ $key }}" {{ $key == $participant_list->region_id? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-3">
        <label for="cohort">Cohort*</label>
        <select name="cohort_id" id="cohort" class="form-select select2" data-placeholder="Choose Cohort" required disabled>
            <option value=""></option>
            @if(@$participant_list)
                @foreach ($participant_list->cohorts as $key => $value)
                    <option value="{{ $key }}" {{ $key == $participant_list->cohort_id? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="col-2">
        <label for="male_count">Male Count</label>
        {{ Form::number('male_count', null, ['class' => 'form-control', 'id' => 'male_count', 'required']) }}
    </div>
    <div class="col-2">
        <label for="female_count">Female Count</label>
        {{ Form::number('female_count', null, ['class' => 'form-control', 'id' => 'female_count', 'required']) }}
    </div>
    <div class="col-2">
        <label for="total_count">Total Count</label>
        {{ Form::text('total_count', null, ['class' => 'form-control', 'id' => 'total_count', 'readonly']) }}
    </div>
    <div class="col-3">
        <label for="prepared_by">Prepared By</label>
        {{ Form::text('prepared_by', null, ['class' => 'form-control']) }}
    </div>
</div>
<!-- Participants Table -->
@include('participant_lists.partial.participants_table')

@section('script')
<script>
    // on submit form
    $('form').submit(function() {
        $('#participants_tbl tbody tr').each(function() {
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

    // on change count fields
    $(document).on('keyup', '#male_count, #female_count', function() {
        const m = $('#male_count').val()*1 || 0;
        const f = $('#female_count').val()*1 || 0;
        $('#total_count').val(m+f);
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
    }

    // short link from action plan
    const reqParams = @json(request()->only('proposal_id', 'action_plan_id'));
    if (reqParams) {
        $('#proposal').val(reqParams.proposal_id).change();
        setTimeout(() => {
            $('#action_plan').val(reqParams.action_plan_id).change();
        }, 500);
    }
</script>
@stop