<div class="row mb-3">
    <div class="col-md-8 col-12">
        <label for="title">Project Title<span class="text-danger">*</span></label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $row)
                <option value="{{ $row->id }}">{{ $row->title }}</option>
            @endforeach
        </select>   
    </div>
    <div class="col-md-4 col-12">
        <label for="plan">Action Plan<span class="text-danger">*</span></label>
        <select name="action_plan_id" id="action_plan" class="form-control" data-placeholder="Choose Action Plan" required>
            <option value=""></option>
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-8 col-12">
        <label for="title">Activity<span class="text-danger">*</span></label>
        <select name="proposal_item_id" id="activity" class="form-control" data-placeholder="Choose Activity" required>
            <option value=""></option>
        </select>
    </div>
    <div class="col-md-4 col-12">
        <label for="date">Activity Date<span class="text-danger">*</span></label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-8 col-12">
        <label for="file">Partipant List</label>
        {{ Form::file('file', ['class' => 'form-control', 'id' => 'file', 'accept' => '.csv, .pdf, .xls, .xlsx, .doc, .docx' ]) }}
    </div>
    <div class="col-md-4 col-12">
        <label for="prepared_by">Prepared By</label>
        {{ Form::text('prepared_by', null, ['class' => 'form-control']) }}
    </div>
</div>

<!-- Statistics section -->
<div class="row mb-2" data-repeater-list="statistics">
    <div class="col-md-12 col-12 my-1 stat-group" data-repeater-item>
        <fieldset class="border rounded-3 p-3">
            {{-- <legend class="float-none w-auto px-1 fs-5"></legend> --}}
            <div class="row mb-2">
                <div class="col-md-3 col-12">
                    <label for="region">Region<span class="text-danger">*</span></label>
                    <select name="region_id" id="region" class="form-select" data-placeholder="Choose Region" required>
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-md-3 col-12">
                    <label for="cohort">Cohort<span class="text-danger">*</span></label>
                    <select name="cohort_id" id="cohort" class="form-select" data-placeholder="Choose Cohort" required>
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-md-3 col-12">
                    <label for="age_group">Age Group<span class="text-danger">*</span></label>
                    <select name="age_group_id" id="age-group" class="form-select" data-placeholder="Choose Age-group" required>
                        <option value=""></option>
                        @foreach ($age_groups as $row)
                            <option value="{{ $row->id }}">{{ $row->bracket }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-12">
                    <label for="disability">Disability</label>
                    <select name="disability_id" id="disability" class="form-select" data-placeholder="Choose Disability">
                        <option value=""></option>
                        @foreach ($disabilities as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row mb-2">
                <div class="col-md-6 col-12">
                    <label for="no_participants">Participant Stats<span class="text-danger">*</span></label>
                    <div class="row g-0">
                        <div class="col-md-4">
                            {{ Form::text('male_count', null, ['class' => 'form-control', 'placeholder' => 'MALE', 'required' => 'required']) }}
                        </div>
                        <div class="col-md-4">
                            {{ Form::text('female_count', null, ['class' => 'form-control', 'placeholder' => 'FEMALE', 'required' => 'required']) }}
                        </div>
                        <div class="col-md-4">
                            {{ Form::text('total_count', null, ['class' => 'form-control', 'placeholder' => 'TOTAL', 'required' => 'required']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pt-4">
                    <button type="button" class="btn btn-danger float-end" data-repeater-delete>Delete</button>
                </div>
            </div>
        </fieldset>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 col-12">
        <span class="badge bg-success text-white add-row" role="button" data-repeater-create>
            <i class="bi bi-plus-lg"></i> Row
        </span>
    </div>
</div>
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


    /**
     * Edit Mode
     **/
    const psList = @json(@$participant_list);
    if (psList) {
        ['action_plan', 'activity', 'region', 'cohort'].forEach(v => {
            $('#'+v).prop('disabled', false);
        });
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