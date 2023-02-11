<div class="row mb-3">
    <div class="col-12">
        <label for="title">Project Title*</label>
        <select name="proposal_id" id="proposal" class="form-control">
            <option value="">-- Choose project --</option>
            @foreach ([] as $proposal)
                <option value="{{ $proposal->id }}">{{ $proposal->title }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-6">
        <label for="title">Activity*</label>
        <select name="proposal_item_id" id="activity" class="form-control">
            <option value="">-- Choose activity --</option>
            @foreach ([] as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <label for="date">Date*</label>
        {{ Form::text('date', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-3">
        <label for="region">Region*</label>
        <select name="region_id" id="region" class="form-select">
            <option value="">-- Choose Region --</option>
            @foreach ([] as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-6">
        <label for="title">Key Programme*</label>
        <select name="programme_id" id="programme" class="form-control">
            <option value="">-- Choose programme --</option>
            @foreach ([] as $programme)
                <option value="{{ $programme->id }}">{{ $programme->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <label for="cohort">Cohort*</label>
        <select name="cohort_id" id="cohort" class="form-select">
            <option value="">-- Choose Cohort --</option>
            @foreach ([] as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <label for="prepared_by">Prepared By*</label>
        {{ Form::text('prepared_by', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="row mb-3">
    <div class="col-2">
        <label for="male_count">Male Count</label>
        {{ Form::text('male_count', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-2">
        <label for="female_count">Female Count</label>
        {{ Form::text('female_count', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-2">
        <label for="total_count">Total Count</label>
        {{ Form::text('total_count', null, ['class' => 'form-control', 'readonly']) }}
    </div>
</div>

<table class="table table-striped" id="objectivesTbl">
    <thead>
        <tr class="">
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Age Group</th>
            <th scope="col">Disability</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Designation</th>
            <th scope="col">Organisation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row" class="p-3">1</th>
            <td><input type="text" name="name[]" id="obj-0" class="form-control obj"></td>
            <td><input type="text" name="name[]" id="obj-0" class="form-control obj"></td>
            <td><input type="text" name="name[]" id="obj-0" class="form-control obj"></td>
            <td><input type="text" name="name[]" id="obj-0" class="form-control obj"></td>
            <td><input type="text" name="name[]" id="obj-0" class="form-control obj"></td>
            <td><input type="text" name="name[]" id="obj-0" class="form-control obj"></td>
            <td><input type="text" name="name[]" id="obj-0" class="form-control obj"></td>
            <td><input type="text" name="name[]" id="obj-0" class="form-control obj"></td>
            <td>
                <a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs ml-1"></i></a> 
            </td>
            <input type="hidden" name="row_index[]" class="row-index">
            <input type="hidden" name="is_obj[]" value="1">
        </tr>
    </tbody>
</table>

<h5>
    <span class="badge bg-primary" role="button"><i class="bi bi-plus-lg"></i> row</span>
</h5>


@section('script')
<script>
    
</script>
@stop