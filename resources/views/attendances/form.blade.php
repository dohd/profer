<div class="row mb-3">
    <div class="col-md-8 col-12">
        <label for="title">Project Title<span class="text-danger">*</span></label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $row)
                <option value="{{ $row->id }}" {{ $row->id == @$attendance->proposal_id? 'selected' : '' }}>{{ $row->title }}</option>
            @endforeach
        </select>   
    </div>
    <div class="col-md-4 col-12">
        <label for="plan">Action Plan<span class="text-danger">*</span></label>
        <select name="action_plan_id" id="action_plan" class="form-control" data-placeholder="Choose Action Plan" required>
            <option value=""></option>
            @if (isset($attendance->action_plan))
                <option value="{{ $attendance->action_plan_id }}" selected>{{ tidCode('', $attendance->action_plan->tid) . '/' . dateFormat($attendance->action_plan->date, 'Y') }}</option>
            @endif
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-8 col-12">
        <label for="title">Activity<span class="text-danger">*</span></label>
        <select name="proposal_item_id" id="activity" class="form-control" data-placeholder="Choose Activity" required>
            <option value=""></option>
            @if (isset($attendance->activity))
                <option value="{{ $attendance->proposal_item_id }}" selected>{{ $attendance->activity->name }}</option>
            @endif
        </select>
    </div>
    <div class="col-md-4 col-12">
        <label for="date">Activity Date<span class="text-danger">*</span></label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-8 col-12">
        <label for="doc_file">Attendance List</label>
        {{ Form::file('doc_file', ['class' => 'form-control', 'id' => 'doc_file', 'accept' => '.csv, .pdf, .xls, .xlsx, .doc, .docx' ]) }}
    </div>
    <div class="col-md-4 col-12">
        <label for="prepared_by">Prepared By</label>
        {{ Form::text('prepared_by', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- Statistics section -->
@include('attendances.partial.stats_section')
<!-- End Statistics section -->

@section('script')
<script>
    // init form repeater
    $('form').repeater({
        isFirstItemUndeletable: true,
    });

    $('#action_plan').select2({
        allowClear: true, 
        ajax: {
            url: "{{ route('action_plans.select_items') }}",
            method: 'POST',
            dataType: 'json',
            delay: 250,
            cache: true,
            data: ({term}) => ({
                proposal_id: $('#proposal').val(),
                is_participant_list: 1,
            }),
            processResults: function (data) {
                return { results: data.map(v => ({id: v.id, text: v.code})) };
            },
        },
    });
    $('#activity').select2({
        allowClear: true, 
        ajax: {
            url: "{{ route('action_plans.proposal_items') }}",
            method: 'POST',
            dataType: 'json',
            delay: 250,
            cache: true,
            data: ({term}) => ({
                plan_id: $('#action_plan').val(),
                is_participant_list: 1,
            }),
            processResults: function (data) {
                return { results: data.map(v => ({id: v.id, text: v.name})) };
            },
        },
    });

    // on activity change
    let activityData = {};
    $('#activity').change(function() {
        $('select').each(function() {
            let id = $(this).attr('id');
            if (id.includes('region') || id.includes('cohort')) {
                $(this).find('option:not(:first)').remove();
            }
        });
        const params = {
            activity_id: $(this).val(),
            is_participant_list: 1,
        };
        // fetch regions & cohorts
        $.post("{{ route('action_plans.select_activity_items') }}", params, data => {
            if (!data.regions || !data.cohorts) {
                activityData = {};
            } else {
                activityData = data;
                $('select').each(function() {
                    let id = $(this).attr('id');
                    let el = $(this);
                    if (id.includes('region')) {
                        data.regions.forEach(v => el.append(`<option value="${v.id}">${v.name}</option>`));
                    }
                    if (id.includes('cohort')) {
                        data.cohorts.forEach(v => el.append(`<option value="${v.id}">${v.name}</option>`));
                    }
                });
            }
        });
    });

    // config select2 on default stat-group
    ['region', 'cohort', 'age-group', 'disability'].forEach(function(v) {
        $('#' + v).css('width', '100%').select2({allowClear: true});
    });

    // on add row config select2
    $('.add-row').click(function() {
        $('.stat-group').each(function(i) {
            if (i == 0) return;
            $(this).find('select').each(function() {
                let id = $(this).attr('id');
                $(this).attr('id', id + i);
                $(this).css('width', '100%').select2({allowClear: true});
                let el = $(this);
                if (id.includes('region')) {
                    let regions = activityData.regions || [];
                    regions.forEach(v => el.append(`<option value="${v.id}">${v.name}</option>`));
                }
                if (id.includes('cohort')) {
                    let cohorts = activityData.cohorts || [];
                    cohorts.forEach(v => el.append(`<option value="${v.id}">${v.name}</option>`));
                }
            });
        });
    });

    $('form').on('keyup focusout', '.male, .female', function(e) {
        const row = $(this).parents('div.row:first');
        const male = accounting.unformat(row.find('.male').val());
        const female = accounting.unformat(row.find('.female').val());
        row.find('.total').val(male+female);
    });
</script>
@stop