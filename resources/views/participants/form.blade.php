<div class="row mb-3">
    <div class="col-3">
        <label for="name">Participant Name*</label>
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-3">
        <label for="gender">Gender*</label>
        <select name="gender" id="gender" class="form-control">
            <option value="">-- select gender --</option>
            @foreach (['male', 'female'] as $val)
                <option value="{{ $val }}">{{ ucfirst($val) }}</option>
            @endforeach
        </select>
    </div>


    <div class="col-5">
        <label for="organisation">Organisation*</label>
        {{ Form::text('organisation', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="row mb-3">
    <div class="col-3">
        <label for="age_group">Age Bracket*</label>
        <select name="age_group_id" id="age_group" class="form-control">
            <option value="">-- select bracket --</option>
            @foreach ($age_groups as $group)
                <option value="{{ $group->id }}">{{ $group->bracket }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <label for="disability">Disability</label>
        <select name="disability_id" id="disability" class="form-control">
            <option value="">-- select disability --</option>
            @foreach ($disabilities as $item)
                <option value="{{ $item->id }}">{{ $item->code }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <label for="designation">Designation*</label>
        {{ Form::text('designation', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-3">
        <label for="phone">Phone*</label>
        {{ Form::text('phone', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="row mb-3">
    <div class="col-3">
        <label for="email">Email</label>
        {{ Form::text('email', null, ['class' => 'form-control']) }}
    </div>
</div>

@section('script')
<script>
    
</script>
@stop