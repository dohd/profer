<div class="row mb-3">
    <div class="col-12">
        <label for="title">Project Title*</label>
        <select name="proposal_id" id="proposal" class="form-control">
            <option value="">-- select project --</option>
            @foreach ($proposals as $proposal)
                <option value="{{ $proposal->id }}">{{ $proposal->title }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-9">
        <label for="title">Key Programme*</label>
        <select name="programme_id" id="programme" class="form-control">
            <option value="">-- select programme --</option>
            @foreach ($programmes as $programme)
                <option value="{{ $programme->id }}">{{ $programme->name }}</option>
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
            <th>Cohort</th>
            <th>Region</th>
            <th>Resources</th>
            <th>Assigned To</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@section('script')
<script>
    // on proposal change
    $('#proposal').change(function() {
        $.post("{{ route('action_plans.proposal_items') }}", {proposal_id: $(this).val()}, data => {
            $('#objectivesTbl tbody').html(data);
        });
    });

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
            if (!row.siblings().length) return;
            if (row.find('.obj').length) objectiveIndex--;
            else activityIndex--;
            row.remove();
        }

        $('#objectivesTbl tbody tr').each(function(i) {
            $(this).find('.row-index').val(i);
        });
    });

    function objRow(i,v) {
        return `
            <tr>
                <th scope="row"><input type="text" name="row_num[]" id="rownum-${i+1}" value="${i+1}" class="form-control rownum"></th>
                <td class="pt-3">objective</td>
                <td><input type="text" name="name[]" id="obj-${i+1}" class="form-control obj"></td>
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
            </tr>
        `;
    }

    function actRow(v,i) {
        return `
            <tr>
                <th scope="row"><input type="hidden" name="row_num[]"></th>
                <td class="pt-3">activity</td>
                <td><input type="text" name="name[]" id="act-${i+1}" class="form-control act"></td>
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
            </tr>
        `;
    }
</script>
@stop