<div class="row mb-3">
    <div class="col-md-12 col-12">
        <label for="title">Project Title*</label>
        {{ Form::text('title', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-2 col-12">
        <label for="date">Date*</label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-4 col-12">
        <label for="sector" class="col-12">Donor*</label>
        <select name="donor_id" id="donor" class="form-select select2" data-placeholder="Choose Donor" required>
            <option value=""></option>
            @foreach ($donors as $donor)
                <option value="{{ $donor->id }}" {{ @$proposal->donor_id == $donor->id? 'selected' : '' }}>{{ $donor->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2 col-12">
        <label for="start_date">Project Start*</label>
        {{ Form::date('start_date', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-2 col-12">
        <label for="end_date">Project End*</label>
        {{ Form::date('end_date', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-2 col-12">
        <label for="budget">Estimated Budget*</label>
        {{ Form::text('budget', numberFormat(@$proposal->budget), ['class' => 'form-control', 'id' => 'budget', 'required']) }}
    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table table-cstm" id="objectivesTbl">
        <thead>
            <tr class="table-primary">
                <th width="8%">#</th>
                <th width="10%">Item</th>
                <th width="70%">Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"><input type="text" name="row_num[]" id="rownum-0" value="1" class="form-control rownum" required></td>
                <td class="pt-3">objective</td>
                <td><input type="text" name="name[]" id="obj-0" class="form-control obj" required></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item pt-1 pb-1 add-obj" href="javascript:"><i class="bi bi-plus"></i>Objective</a></li>
                          <li><a class="dropdown-item pt-1 pb-1 add-act" href="javascript:"><i class="bi bi-plus"></i>Activity</a></li>
                          <li><a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs"></i>Delete</a></li>
                        </ul>
                    </div>
                </td>
                <input type="hidden" name="row_index[]" class="row-index">
                <input type="hidden" name="is_obj[]" value="1">
                <input type="hidden" name="item_id[]" class="item_id">
            </tr>
            @foreach(range(1,2) as $i)
                <tr>
                    <td colspan="100%">&nbsp;</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@section('script')
<script>
    let objectiveIndex = 0;
    let activityIndex = 0;
    $('#objectivesTbl').on('click', '.add-obj, .add-act, .del', function() {
        const row = $(this).parents('tr');
        if ($(this).is('.add-obj')) {
            objectiveIndex++;
            row.after(objRow(objectiveIndex));
        }
        if ($(this).is('.add-act')) {
            activityIndex++;
            row.after(actRow(activityIndex));
        }
        if ($(this).is('.del')) {
            let siblings = row.siblings();
            if (!siblings.find('.act').length && !siblings.find('.obj').length) 
                return;
            if (row.find('.obj').length) objectiveIndex--;
            else activityIndex--;
            row.remove();
        }

        // update row index and numbering
        let objectiveNum = 0;
        $('#objectivesTbl tbody tr').each(function(i) {
            let row = $(this);
            row.find('.row-index').val(i);
            if (row.find('.obj').length) {
                objectiveNum++;
                row.find('.rownum').val(objectiveNum);
            }
        });
    });

    function objRow(i,v) {
        return `
            <tr>
                <td scope="row"><input type="text" name="row_num[]" id="rownum-${i+1}" class="form-control rownum" required></td>
                <td class="pt-3">objective</td>
                <td><input type="text" name="name[]" id="obj-${i+1}" class="form-control obj" required></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                        </button>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item pt-1 pb-1 add-obj" href="javascript:"><i class="bi bi-plus"></i>Objective</a></li>
                        <li><a class="dropdown-item pt-1 pb-1 add-act" href="javascript:"><i class="bi bi-plus"></i>Activity</a></li>
                        <li><a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs"></i>Delete</a></li>
                        </ul>
                    </div>
                </td>
                <input type="hidden" name="row_index[]" class="row-index">
                <input type="hidden" name="is_obj[]" value="1">
                <input type="hidden" name="item_id[]" class="item_id">
            </tr>
        `;
    }

    function actRow(v,i) {
        return `
            <tr>
                <td scope="row"><input type="hidden" name="row_num[]"></td>
                <td class="pt-3">activity</td>
                <td><input type="text" name="name[]" id="act-${i+1}" class="form-control act" required  ></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                        </button>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item pt-1 pb-1 add-obj" href="javascript:"><i class="bi bi-plus"></i>Objective</a></li>
                        <li><a class="dropdown-item pt-1 pb-1 add-act" href="javascript:"><i class="bi bi-plus"></i>Activity</a></li>
                        <li><a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs"></i>Delete</a></li>
                        </ul>
                    </div>
                </td>
                <input type="hidden" name="row_index[]" class="row-index">
                <input type="hidden" name="is_obj[]" value="0">
                <input type="hidden" name="item_id[]" class="item_id">
            </tr>
        `;
    }

    // on edit load proposal items
    const proposalItems = @json(@$proposal->items);
    if (proposalItems) {
        $('#objectivesTbl tbody tr').remove();
        proposalItems.forEach((v,i) => {
            if (v.is_obj) {
                $('#objectivesTbl tbody').append(objRow(v,i));
                const row = $('#objectivesTbl tbody tr:last');
                row.find('.rownum').val(v.row_num);
                row.find('.obj').val(v.name);
                row.find('.item_id').val(v.id);
            } else {
                $('#objectivesTbl tbody').append(actRow(v,i));
                const row = $('#objectivesTbl tbody tr:last');
                row.find('.act').val(v.name);
                row.find('.item_id').val(v.id);
            }
        });
        $('#objectivesTbl tbody tr').each(function(i) {
            $(this).find('.row-index').val(i);
        });
    }
</script>
@stop