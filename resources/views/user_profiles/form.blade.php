<div class="row mb-3">
    <div class="col-md-6 col-12">
        <label for="name">First Name*</label>
        {{ Form::text('fname', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-6 col-12">
        <label for="name">Last Name*</label>
        {{ Form::text('lname', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6 col-12">
        <label for="name">Phone*</label>
        {{ Form::text('phone', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-6 col-12">
        <label for="name">Email*</label>
        {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6 col-12">
        <label for="name">Address*</label>
        {{ Form::text('address', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-6 col-12">
        <label for="name">Town*</label>
        {{ Form::text('country', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>

