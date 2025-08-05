<div class="row mb-3">
    <div class="col-md-10 col-12 mb-1">
        <label for="role">Authorized Role</label>
        <select name="role" id="role" class="form-control col-12"  required>
            <option value="">-- Select Role --</option>
            @foreach (['Deacon', 'Overseer', 'Shepherd'] as $role)
                <option name="role" value="{{ $role }}" {{ $role == @$user_profile->role? 'selected' : '' }}>
                {{ $role }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-10 col-12 mb-1">
        <label for="full_name">Full Name<span class="text-danger">*</span></label>
        {{ Form::text('name', null, ['class' => 'form-control',  'placeholder' => 'Full Name', 'required' => 'required']) }}
    </div>
    <div class="col-md-10 col-12 mb-1">
        <label for="name">Username<span class="text-danger">*</span></label>
        {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required']) }}
    </div>
    <div class="col-md-10 col-12 mb-1">
        <label for="email">Email<span class="text-danger">*</span></label>
        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'john@doe.com', 'required' => 'required']) }}
    </div>

    <div class="col-md-10 col-12 mb-3">
        <label for="name">Phone No.<span class="text-danger">*</span></label>
        {{ Form::text('phone', null, ['class' => 'form-control',  'placeholder' => '+254712300300', 'required' => 'required']) }}
    </div>
</div>
