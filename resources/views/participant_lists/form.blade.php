<div class="row mb-3">
    <div class="col-12">
        <label for="title">Project Title*</label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $proposal)
                <option value="{{ $proposal->id }}" {{ @$participant_list->proposal_id == $proposal->id? 'selected' : '' }}>{{ $proposal->title }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-6">
        <label for="title">Activity*</label>
        <select name="proposal_item_id" id="activity" class="form-control select2" data-placeholder="Choose Activity" required>
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
        <select name="region_id" id="region" class="form-select select2" data-placeholder="Choose Region" required>
            <option value=""></option>
            @foreach ($regions as $region)
                <option value="{{ $region->id }}" {{ @$participant_list->region_id == $region->id? 'selected' : '' }}>{{ $region->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-6">
        <label for="title">Key Programme*</label>
        <select name="programme_id" id="programme" class="form-control select2" data-placeholder="Choose Programme" required>
            <option value=""></option>
            @foreach ($programmes as $programme)
                <option value="{{ $programme->id }}" {{ @$participant_list->programme_id == $programme->id? 'selected' : '' }}>{{ $programme->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <label for="cohort">Cohort*</label>
        <select name="cohort_id" id="cohort" class="form-select select2" data-placeholder="Choose Cohort" required>
            <option value=""></option>
            @foreach ($cohorts as $cohort)
                <option value="{{ $cohort->id }}" {{ @$participant_list->cohort_id == $cohort->id? 'selected' : '' }}>{{ $cohort->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <label for="prepared_by">Prepared By</label>
        {{ Form::text('prepared_by', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="row mb-3">
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
</div>

<table class="table table-striped" id="participants_tbl">
    <thead>
        <tr class="">
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Gender</th>
            <th scope="col" width="10%">Age Group</th>
            <th scope="col">Disability</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Designation</th>
            <th scope="col">Organisation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- row template -->
        <tr>
            <th scope="row" class="p-3 num">1</th>
            <td><input type="text" name="name[]" class="form-control name"></td>
            <td>
                <select name="gender[]" class="form-select gender">
                    @foreach (['male', 'female'] as $item)
                        <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select name="age_group_id[]" class="form-select custom agegrp" data-placeholder="Age">
                    <option value=""></option>
                    @foreach ($age_groups as $item)
                        <option value="{{ $item->id }}">{{ $item->bracket }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select name="disability_id[]" class="form-select custom dsblty" data-placeholder="Ds">
                    <option value=""></option>
                    @foreach ($disabilities as $item)
                        <option value="{{ $item->id }}">{{ $item->code }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="text" name="phone[]" class="form-control phone"></td>
            <td><input type="text" name="email[]" class="form-control email"></td>
            <td><input type="text" name="designation[]" class="form-control desig"></td>
            <td><input type="text" name="organisation[]" class="form-control org"></td>
            <td>
                <a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs ml-1"></i></a> 
            </td>
        </tr>
        <!-- end template -->

        <!-- edit participant list items -->
        @isset($participant_list)
            @foreach ($participant_list->items as $i => $list_item)
                <tr>
                    <th scope="row" class="p-3 num">{{ $i+1 }}</th>
                    <td><input type="text" name="name[]" class="form-control name" value="{{ $list_item->name }}"></td>
                    <td>
                        <select name="gender[]" class="form-select gender">
                            @foreach (['male', 'female'] as $item)
                                <option value="{{ $item }}" {{ $item == $list_item->gender? 'selected' : '' }}>{{ ucfirst($item) }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="age_group_id[]" class="form-select custom agegrp" data-placeholder="Age">
                            <option value=""></option>
                            @foreach ($age_groups as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $list_item->age_group_id? 'selected' : '' }}>{{ $item->bracket }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="disability_id[]" class="form-select custom dsblty" data-placeholder="Ds">
                            <option value=""></option>
                            @foreach ($disabilities as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $list_item->disability_id? 'selected' : '' }}>{{ $item->code }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="text" name="phone[]" class="form-control phone" value="{{ $list_item->phone }}"></td>
                    <td><input type="text" name="email[]" class="form-control email" value="{{ $list_item->email }}"></td>
                    <td><input type="text" name="designation[]" class="form-control desig" value="{{ $list_item->designation }}"></td>
                    <td><input type="text" name="organisation[]" class="form-control org" value="{{ $list_item->organisation }}"></td>
                    <td>
                        <a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs ml-1"></i></a> 
                    </td>
                    <input type="hidden" name="item_id[]" value="{{ $list_item->id }}">
                </tr>
            @endforeach
        @endisset
        <!-- end edit -->
    </tbody>
</table>
<h5>
    <span class="badge bg-primary addrow" role="button"><i class="bi bi-plus-lg"></i> add row</span>
</h5>

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
        const male = $('#male_count').val()*1 || 0;
        const female = $('#female_count').val()*1 || 0;
        $('#total_count').val(male+female);
    });

    // on proposal change fetch activites
    $('#proposal').change(function() {
        const url = @json(route('proposals.items'));
        const params = {
            proposal_id: $(this).val(),
            is_participant_list: 1,
        };
        $.post(url, params, data => {
            const activityId = @json(@$participant_list->proposal_item_id);
            $('#activity option:not(:first)').remove();
            data.forEach(v => {
                if (v.is_obj == 0) {
                    $('#activity').append(`<option value="${v.id}" ${v.id == activityId? 'selected' : ''}>${v.name}</option>`);
                }
            });
        });
    }).change();


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