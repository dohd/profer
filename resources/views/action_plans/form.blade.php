<div class="row mb-3">
    <div class="col-12">
        <label for="title">Project Title*</label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $proposal)
                <option value="{{ $proposal->id }}" {{ @$action_plan->proposal_id == $proposal->id? 'selected' : '' }}>{{ $proposal->title }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-9">
        <label for="title">Key Programme*</label>
        <select name="programme_id" id="programme" class="form-control select2" data-placeholder="Choose Programme" required>
            <option value=""></option>
            @foreach ($programmes as $programme)
                <option value="{{ $programme->id }}" {{ @$action_plan->programme_id == $programme->id ? 'selected' : '' }}>{{ $programme->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <label for="assigned_to">Assigned To</label>
        {{ Form::text('main_assigned_to', null, ['class' => 'form-control']) }}
    </div>
</div>

<table class="table table-striped" id="objectivesTbl">
    <thead>
        <tr class="">
            <th scope="col" width="8%">#</th>
            <th scope="col">Project Activity</th>
            <th scope="col">Date(start-end)</th>
            <th width="12%">Cohort</th>
            <th width="12%">Region</th>
            <th>Resources</th>
            <th>Assigned To</th>
            @isset ($action_plan)
                <th>Action</th>
            @endisset
        </tr>
    </thead>
    <tbody>
        <!-- edit action plan items -->
        @isset($action_plan)
            @foreach ($action_plan->items as $item)
                @php
                    $proposal_item = $item->proposal_item;
                    if (!$proposal_item) co
                @endphp
                <tr>
                    <th scope="row">
                        @if ($proposal_item->row_num)
                            {{ $proposal_item->row_num }}
                        @else
                            <b style="font-size: 1em">.</b>
                        @endif
                    </th>
                    <td>{{ $proposal_item->name }}</td>
                    @if ($proposal_item->is_obj)
                        <td colspan="5"></td>
                        <input type="hidden" name="start_date[]">
                        <input type="hidden" name="end_date[]">
                        <input type="hidden" name="cohort_id[]">
                        <input type="hidden" name="region_id[]" value="0-{{ $proposal_item->id }}">
                        <input type="hidden" name="resources[]">
                        <input type="hidden" name="assigned_to[]">
                        <input type="hidden" name="proposal_item_id[]" value="{{ $proposal_item->id }}">
                        <input type="hidden" name="item_id[]" value="{{ $item->id }}">
                    @else
                        <td>
                            {{ Form::date('start_date[]', $item->start_date, ['class' => 'form-control']) }}
                            {{ Form::date('end_date[]', $item->end_date, ['class' => 'form-control']) }}
                        </td>
                        <td>
                            <select name="cohort_id[]" class="form-control select2 cohort" data-placeholder="Cohort">
                                <option value=""></option>
                                @foreach ($cohorts as $cohort)
                                    <option value="{{ $cohort->id }}" {{ $item->cohort_id == $cohort->id? 'selected' : '' }}>{{ $cohort->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="region_id[]" class="form-control select2 region" data-placeholder="Region" multiple>
                                <option value=""></option>
                                @foreach ($regions as $region)
                                    @php
                                        $selected = '';
                                        $region_ids = $proposal_item->regions->pluck('id')->toArray();
                                        if (in_array($region->id, $region_ids)) $selected = 'selected';
                                    @endphp
                                    <option value="{{ $region->id }}-{{ $proposal_item->id }}" {{ $selected }}>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>{{ Form::textarea('resources[]', $item->resources, ['class' => 'form-control', 'rows' => '3']) }}</td>
                        <td>{{ Form::text('assigned_to[]', $item->assigned_to, ['class' => 'form-control']) }}</td>
                        <input type="hidden" name="proposal_item_id[]" value="{{ $proposal_item->id }}">
                        <input type="hidden" name="item_id[]" value="{{ $item->id }}">
                    @endif
                    <td><a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs"></i></a></td>
                </tr>
            @endforeach
        @endisset
    </tbody>
</table>

@section('script')
<script>
    // on proposal change fetch activities
    $('#proposal').change(function() {
        $.post("{{ route('action_plans.proposal_items') }}", {proposal_id: $(this).val()}, data => {
            $('#objectivesTbl tbody').html(data);
            $('.select2').each(function() {
                $(this).select2({allowClear: true});
            });
        });
    });

    // on delete click
    $(document).on('click', '.del', function() {
        $(this).parents('tr').remove();
    });
</script>
@stop