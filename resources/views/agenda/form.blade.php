<div class="row mb-3">
    <div class="col-8">
        <label for="title">Project Title</label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $key => $value)
                <option value="{{ $key }}" {{ @$agenda->proposal_id == $key? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>   
    </div>
    <div class="col-4">
        <label for="plan">Action Plan No.</label>
        <select name="action_plan_id" id="action_plan" class="form-control select2" data-placeholder="Choose Action Plan" required disabled>
            <option value=""></option>
            @isset($agenda)
                <option value="{{ $agenda->action_plan_id }}" selected>
                    {{ tidCode('action_plan', $agenda->action_plan->tid) }}/{{ @explode('-', $agenda->action_plan->date)[1] }}
                </option>
            @endisset
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-8">
        <label for="title">Activity</label>
        <select name="proposal_item_id" id="activity" class="form-control select2" data-placeholder="Choose Activity" required disabled>
            <option value=""></option>
            @isset($agenda)
                <option value="{{ $agenda->proposal_item_id }}" selected>
                    {{ @$agenda->proposal_item->name }}
                </option>
            @endisset
        </select>
    </div>
    <div class="col-4">
        <label for="date">Date</label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        <label for="title">Agenda Title</label>
        {{ Form::text('title', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped" id="agendaItemsTbl">
        <thead>
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col" width="20%">Period (Start-End)</th>
                <th scope="col" width="50%">Topic</th>
                <th scope="col">Assigned To</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>
                    <div class="row g-0">
                        <div class="col-6"><input type="time" name="time_from[]" class="form-control time-to" required></div>
                        <div class="col-6"><input type="time" name="time_to[]" class="form-control time-from" required></div>
                    </div>
                </td>
                <td><input type="text" name="topic[]" class="form-control topic" required></td>
                <td><input type="text" name="assigned_to[]" class="form-control assigned-to" required></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item pt-1 pb-1 add" href="javascript:"><i class="bi bi-plus"></i>Add</a></li>
                          <li><a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs"></i>Delete</a></li>
                        </ul>
                    </div>
                </td>
                <input type="hidden" name="item_id[]" class="item_id">
            </tr>
            @isset($agenda->items)
                @foreach ($agenda->items as $i => $item)
                    <tr>
                        <th scope="row">{{ $i+1 }}</th>
                        <td>
                            <div class="row g-0">
                                <div class="col-6"><input type="time" name="time_from[]" value="{{ $item->time_from }}" class="form-control time-to" required></div>
                                <div class="col-6"><input type="time" name="time_to[]" value="{{ $item->time_to }}" class="form-control time-from" required></div>
                            </div>
                        </td>
                        <td><input type="text" name="topic[]" value="{{ $item->topic }}" class="form-control topic" required></td>
                        <td><input type="text" name="assigned_to[]" value="{{ $item->assigned_to }}" class="form-control assigned-to" required></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item pt-1 pb-1 add" href="javascript:"><i class="bi bi-plus"></i>Add</a></li>
                                <li><a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs"></i>Delete</a></li>
                                </ul>
                            </div>
                        </td>
                        <input type="hidden" name="item_id[]" value="{{ $item->id }}" class="item_id">
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
</div>

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

    // on click row add, delete
    const initRow = $('#agendaItemsTbl tbody tr:first').html();
    $('#agendaItemsTbl').on('click', '.add, .del', function() {
        const row = $(this).parents('tr');
        if ($(this).is('.add')) {
            row.after(`<tr>${initRow}</tr>`);
        } else {
            if (!row.siblings().length) return;
            row.remove();
        }

        $('#agendaItemsTbl tbody tr').each(function(i) {
            $(this).find('.row-index').val(i);
            $(this).find('th').text(i+1);
        });
    });    

    /**Edit Agenda**/
    const agenda = @json(@$agenda);
    if (agenda) {        
        $('#action_plan').attr('disabled', false);
        $('#activity').attr('disabled', false);
        $('#agendaItemsTbl tbody tr:first').remove();
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
