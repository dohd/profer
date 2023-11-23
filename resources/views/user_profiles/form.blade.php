<div class="row mb-3">
    <div class="col-md-6 col-12">
        <label for="full_name">Full Name<span class="text-danger">*</span></label>
        {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-3 col-12">
        <label for="name">Username<span class="text-danger">*</span></label>
        {{ Form::text('username', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-3 col-12">
        <label for="email">Email<span class="text-danger">*</span></label>
        {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-6 col-12">
        <label for="role">User Role <span class="text-danger">*</span></label>
        <select name="role_id" id="role" class="custom-control col-12" style="height:30px;" required>
            <option value="">-- Select Role --</option>
            @foreach ($roles as $key => $role)
                <option value="{{ $role->id }}" {{ $role->id == @$user_profile->role_id? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 col-12">
        <label for="name">Phone<span class="text-danger">*</span></label>
        {{ Form::text('phone', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
