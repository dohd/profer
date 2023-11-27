<div class="row mb-3">
    <div class="col-md-6 col-12">
        <label for="name">Donor Name<span class="text-danger">*</span></label>
        {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-3 col-12">
        <label for="name">Contact Person</label>
        {{ Form::text('contact_person', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-3 col-12">
        <label for="phone">Contact Person Phone</label>
        {{ Form::text('alternative_phone', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3 col-12">
        <label for="phone">Donor Phone<span class="text-danger">*</span></label>
        {{ Form::text('phone', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-3 col-12">
        <label for="email">Donor Email<span class="text-danger">*</span></label>
        {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
    </div>

    
    
    <div class="col-md-3 col-12">
        <label for="email">Contact Person Email</label>
        {{ Form::text('alternative_email', null, ['class' => 'form-control']) }}
    </div>
</div>
