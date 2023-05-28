<div class="row mb-3">
    <div class="col-1md-2 col-12">
        <label for="title">Project Title*</label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $proposal)
                <option value="{{ $proposal->id }}" {{ @$action_plan->proposal_id == $proposal->id? 'selected' : '' }}>
                    {{ $proposal->title }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-8 col-12">
        <label for="programme">Key Programme*</label>
        <select name="programme_id" id="programme" class="form-control select2" data-placeholder="Choose Programme" required>
            <option value=""></option>
            @foreach ($programmes as $programme)
                <option value="{{ $programme->id }}" {{ @$action_plan->programme_id == $programme->id ? 'selected' : '' }}>{{ $programme->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2 col-12">
        <label for="date">Date*</label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-2 col-12">
        <label for="assigned_to">Plan Overseen By*</label>
        {{ Form::text('main_assigned_to', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>

<!-- Initial activity -->
<fieldset class="border p-2 mb-3">
    <legend class="w-auto float-none h5">Initial Activity</legend>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col-12">
                <label for="activity">Activity*</label>
                <select name="activity_id" class="form-control select2" id="activity" data-placeholder="Choose Activity" required>
                    <option value=""></option>
                    @if(@$action_plan->plan_activity && $action_plan->plan_activity->activity)
                        <option value="{{ $action_plan->plan_activity->activity_id }}" selected>
                            {{ $action_plan->plan_activity->activity->name }}
                        </option>
                    @endif
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 col-12">
                <label for="start_date">Start Date*</label>
                {{ Form::date('start_date', null, ['class' => 'form-control', 'required']) }}
            </div>
            <div class="col-md-4 col-12">
                <label for="end_date">End Date*</label>
                {{ Form::date('end_date', null, ['class' => 'form-control', 'required']) }}
            </div>
            <div class="col-md-4 col-12">
                <label for="assigned_to">Activity Assigned To*</label>
                {{ Form::text('assigned_to', null, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-12">
                <label for="cohort">Cohort*</label>
                <select name="cohort_id" class="form-control select2" data-placeholder="Choose Cohort" required>
                    <option value=""></option>
                    @foreach ($cohorts as $cohort)
                        <option value="{{ $cohort->id }}" {{ @$action_plan->cohort_id == $cohort->id? 'selected' : '' }}>
                            {{ $cohort->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 col-12">
                <label for="target_no">Target Cohort No. *</label>
                {{ Form::number('target_no', null, ['class' => 'form-control', 'required']) }}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-12">
                <label for="region">Regions*</label>
                <select name="region_id[]" class="form-control select2" data-placeholder="Choose Region" multiple required>
                    <option value=""></option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" {{ @$action_plan && in_array($region->id, $action_plan->regions)? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 col-12">
                <label for="resources">Resources</label>
                {{ Form::textarea('resources', null, ['class' => 'form-control', 'rows' => '2']) }}
            </div>
        </div>
    </div>
</fieldset>


@section('script')
<script>
    // on proposal change fetch activities
    $('#proposal').change(function() {
        $('#activity option:not(:first)').remove();
        $.post("{{ route('action_plans.proposal_items') }}", {proposal_id: $(this).val()}, data => {
            data.forEach(v => $('#activity').append(`<option value="${v.id}">${v.name}</option>`));
        });
    });

    // on delete click
    $(document).on('click', '.del', function() {
        const row = $(this).parents('tr');
        if (!row.siblings().length) return;
        row.remove();
    });

    // short link from action plan
    const proposalId = @json(request('proposal_id'));
    if (proposalId) {
        $('#proposal').val(proposalId).change();
    }
</script>
@stop