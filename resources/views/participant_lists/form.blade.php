<div class="row mb-3">
    <div class="col-8">
        <label for="title">Project Title*</label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $proposal)
                <option value="{{ $proposal->id }}" {{ @$participant_list->proposal_id == $proposal->id? 'selected' : '' }}>{{ $proposal->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <label for="plan">Action Plan No*</label>
        <select name="action_plan_id" id="action_plan" class="form-control select2" data-placeholder="Choose Action Plan" required disabled>
            <option value=""></option>
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-6">
        <label for="title">Activity*</label>
        <select name="proposal_item_id" id="activity" class="form-control select2" data-placeholder="Choose Activity" required disabled>
            <option value=""></option>
            @foreach ([] as $item)
                <option value="{{ $item->id }}" {{ @$participant_list->proposal_item_id == $item->id? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
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
            @foreach ($regions as $region)
                <option value="{{ $region->id }}" {{ @$participant_list->region_id == $region->id? 'selected' : '' }}>{{ $region->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-3">
        <label for="cohort">Cohort*</label>
        <select name="cohort_id" id="cohort" class="form-select select2" data-placeholder="Choose Cohort" required disabled>
            <option value=""></option>
            @foreach ($cohorts as $cohort)
                <option value="{{ $cohort->id }}" {{ @$participant_list->cohort_id == $cohort->id? 'selected' : '' }}>{{ $cohort->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-2">
        <label for="male_count">Male Count</label>
        {{ Form::number('male_count', null, ['class' => 'form-control', 'id' => 'male_count']) }}
    </div>
    <div class="col-2">
        <label for="female_count">Female Count</label>
        {{ Form::number('female_count', null, ['class' => 'form-control', 'id' => 'female_count']) }}
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

    // on change proposal fetch action plans
    $('#proposal').change(function() {
        const url = @json(route('action_plans.select_items'));
        const params = {
            proposal_id: $(this).val(),
            is_participant_list: 1,
        };
        $.post(url, params, data => {
            $('#action_plan option:not(:first)').remove();
            data.forEach(v => {
                const planId = @json(@$participant_list->action_plan_id);
                $('#action_plan').append(`<option value="${v.id}" ${v.id == planId? 'selected' : ''}>${v.code}</option>`);
            });
            $('#action_plan').prop('disabled', false);
        });
    });

    // on change action plan fetch plan activities
    $('#action_plan').change(function() {
        const url = @json(route('action_plans.proposal_items'));
        const params = {
            plan_id: $(this).val(),
            is_participant_list: 1,
        };
        $.post(url, params, data => {
            const activityId = @json(@$participant_list->proposal_item_id);
            $('#activity option:not(:first)').remove();
            data.forEach(v => {
                $('#activity').append(`<option value="${v.id}" ${v.id == activityId? 'selected' : ''}>${v.name}</option>`);
            });
            $('#activity').prop('disabled', false);
        });
    });


    /**
     * Edit Mode
     **/
    const isEdit = @json(isset($participant_list));
    if (isEdit) {
        $('#participants_tbl tbody tr:first').remove();
        rowCount = $('#participants_tbl tbody tr').length;
    }
</script>
@stop