@if (isset($attendance))
    <!-- Edit Template -->
    <div class="row mb-2" data-repeater-list="attendance_items">
        @foreach ($attendance->items as $row)
            <div class="col-md-12 col-12 my-1 stat-group" data-repeater-item>
                <fieldset class="border rounded-3 p-3">
                    <div class="row mb-2">
                        <div class="col-md-3 col-12">
                            <label for="member_name">Member Name</label>
                            {{ Form::text('member_name', $row->member_name, ['class' => 'form-control', 'placeholder' => 'Member Name']) }}
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="residence">Residence</label>
                            {{ Form::text('residence', $row->residence, ['class' => 'form-control', 'placeholder' => 'Residence']) }}
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="phone_no">Phone No.</label>
                            {{ Form::text('phone_no', $row->phone_no, ['class' => 'form-control', 'placeholder' => 'Phone No.']) }}
                        </div>
                        <div class="col-md-3 col-12">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-select">
                                <option value="">-- Select Gender --</option>
                                @foreach (['Male', 'Female'] as $gender)
                                    <option value="{{ $gender }}" {{ $row->gender == $gender? 'selected' : '' }}>
                                        {{ $gender }}
                                    </option>
                                @endforeach
                            </select>
                        </div>                        
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 col-12">
                            <label for="age_group">Age Group<span class="text-danger">*</span></label>
                            <select name="age_group_id" id="age-group" class="form-select" data-placeholder="Choose Age-group">
                                <option value=""></option>
                                @foreach ($age_groups as $agegroup)
                                    <option value="{{ $agegroup->id }}" {{ $agegroup->id == $row->age_group_id? 'selected' : '' }}>{{ $agegroup->bracket }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div class="col-md-6 col-12">
                            <label for="no_participants">Member List Stats<span class="text-danger">*</span></label>
                            <div class="row g-0">
                                <div class="col-md-4">
                                    {{ Form::text('male', $row->male, ['class' => 'form-control male', 'placeholder' => 'MALE']) }}
                                </div>
                                <div class="col-md-4">
                                    {{ Form::text('female', $row->female, ['class' => 'form-control female', 'placeholder' => 'FEMALE']) }}
                                </div>
                                <div class="col-md-4">
                                    {{ Form::text('total', $row->total, ['class' => 'form-control total', 'placeholder' => 'TOTAL', 'readonly' => 'readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 pt-4">
                            <button type="button" class="btn btn-danger float-end" data-repeater-delete>Delete</button>
                        </div>
                    </div>
                </fieldset>
            </div>
        @endforeach
    </div>
@else
    <!-- Create Template -->
    <div class="row mb-2" data-repeater-list="attendance_items">
        <div class="col-md-12 col-12 my-1 stat-group" data-repeater-item>
            <fieldset class="border rounded-3 p-3">
                <div class="row mb-2">
                    <div class="col-md-3 col-12">
                        <label for="member_name">Member Name</label>
                        {{ Form::text('member_name', null, ['class' => 'form-control', 'placeholder' => 'Member Name']) }}
                    </div>
                    <div class="col-md-3 col-12">
                        <label for="residence">Residence</label>
                        {{ Form::text('residence', null, ['class' => 'form-control', 'placeholder' => 'Residence']) }}
                    </div>
                    <div class="col-md-3 col-12">
                        <label for="phone_no">Phone No.</label>
                        {{ Form::text('phone_no', null, ['class' => 'form-control', 'placeholder' => 'Phone No.']) }}
                    </div>
                    <div class="col-md-3 col-12">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">-- Select Gender --</option>
                            @foreach (['Male', 'Female'] as $gender)
                                <option value="{{ $gender }}">
                                    {{ $gender }}
                                </option>
                            @endforeach
                        </select>
                    </div>                        
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 col-12">
                        <label for="age_group">Age Group<span class="text-danger">*</span></label>
                        <select name="age_group_id" id="age-group" class="form-select" data-placeholder="Choose Age-group">
                            <option value=""></option>
                            @foreach ($age_groups as $row)
                                <option value="{{ $row->id }}">{{ $row->bracket }}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="col-md-6 col-12">
                        <label for="no_participants">Member List Stats<span class="text-danger">*</span></label>
                        <div class="row g-0">
                            <div class="col-md-4">
                                {{ Form::text('male', null, ['class' => 'form-control male', 'placeholder' => 'MALE']) }}
                            </div>
                            <div class="col-md-4">
                                {{ Form::text('female', null, ['class' => 'form-control female', 'placeholder' => 'FEMALE']) }}
                            </div>
                            <div class="col-md-4">
                                {{ Form::text('total', null, ['class' => 'form-control total', 'placeholder' => 'TOTAL', 'readonly' => 'readonly']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pt-4">
                        <button type="button" class="btn btn-danger float-end" data-repeater-delete>Delete</button>
                    </div>                   
                </div>
            </fieldset>
        </div>
    </div>
@endif

<div class="row mb-3">
    <div class="col-md-12 col-12">
        <span class="badge bg-success text-white add-row" role="button" data-repeater-create>
            <i class="bi bi-plus-lg"></i> Row
        </span>
    </div>
</div>
