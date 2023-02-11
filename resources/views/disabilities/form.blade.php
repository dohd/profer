<div class="row mb-3">
    <div class="col-8">
        <label for="name">Name*</label>
        {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-4">
        <label for="code">Code*</label>
        {{ Form::text('code', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>

