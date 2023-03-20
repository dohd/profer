<div class="row mb-3">
    <div class="col-8">
        <label for="title">Project Title*</label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $key => $value)
                <option value="{{ $key }}" {{ @$narrative->proposal_id == $key? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>   
    </div>
    <div class="col-4">
        <label for="plan">Action Plan No*</label>
        <select name="action_plan_id" id="action_plan" class="form-control select2" data-placeholder="Choose Action Plan" required disabled>
            <option value=""></option>
            @if(@$narrative)
                @foreach ($narrative->action_plans as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $narrative->action_plan_id? 'selected' : '' }}>{{ $item->code }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-8">
        <label for="activity">Activity*</label>
        <select name="proposal_item_id" id="activity" class="form-control select2" data-placeholder="Choose Activity" required disabled>
            <option value=""></option>
            @if(@$narrative)
                @foreach ($narrative->proposal_items as $key => $value)
                    <option value="{{ $key }}" {{ $key == $narrative->proposal_item_id? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="col-4">
        <label for="date">Date*</label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <label for="name">Note</label>
        {{ Form::text('note', null, ['class' => 'form-control']) }}
    </div>
</div>
<!-- Narratives Table -->
@include('narratives.partial.narr_pointer_table')

@section('script')
<script>
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
                    const planId = @json(@$narrative->action_plan_id);
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
                has_participant: 1
            };
            // fetch activities
            $.post(url, params, data => {
                const activityId = @json(@$narrative->proposal_item_id);
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

    /**
     * Edit Mode
     **/
     const psList = @json(@$narrative);
    if (psList) {
        $('#participants_tbl tbody tr:first').remove();
        ['action_plan', 'activity', 'region', 'cohort'].forEach(v => {
            $('#'+v).prop('disabled', false);
        });
    }
</script>
@stop