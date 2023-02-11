<div class="row mb-3">
    <div class="col-6">
        <label for="name">Donor Name*</label>
        {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
    </div>

    <div class="col-3">
        <label for="name">Contact Person*</label>
        {{ Form::text('contact_person', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-3">
        <label for="phone">Alternative Phone*</label>
        {{ Form::text('alternative_phone', null, ['class' => 'form-control', 'required']) }}
    </div>
    
</div>

<div class="row mb-3">
    <div class="col-3">
        <label for="phone">Donor Phone*</label>
        {{ Form::text('phone', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-3">
        <label for="email">Donor Email*</label>
        {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
    </div>
    
    <div class="col-3">
        <label for="email">Alternative Email*</label>
        {{ Form::text('alternative_email', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
