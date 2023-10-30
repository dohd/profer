<div class="row mb-3">
    <div class="col-md-9 col-12">
        <label for="programme">Programme Name<span class="text-danger">*</span></label>
        <select name="programme_id" id="programme" class="form-control select2" data-placeholder="Choose Programme" required>
            <option value=""></option>
            @foreach ($programmes as $item)
                <option value="{{ $item->id }}" {{ @$case_study->programme_id == $item->id? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 col-12">
        <label for="date">Date<span class="text-danger">*</span></label>
        {{ Form::date('date', null, ['class' => 'form-control datepicker', 'id' => 'date', 'required']) }}
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 col-12">
        <label for="title">Title<span class="text-danger">*</span></label>
        {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'required']) }}
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 col-12">
        <label for="situation">Situation (Before Intervention)<span class="text-danger">*</span></label>
        {{ Form::hidden('situation', null, ['id' => 'situation']) }}
        <div class="richtext" id="situation_text">{!! @$case_study->situation !!}</div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 col-12">
        <label for="intervention">Project Intervention<span class="text-danger">*</span></label>
        {{ Form::hidden('intervention', null, ['id' => 'intervention']) }}
        <div class="richtext" id="intervention_text">{!! @$case_study->intervention !!}</div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 col-12">
        <label for="impact">Impact (Intervention Results)<span class="text-danger">*</span></label>
        {{ Form::hidden('impact', null, ['id' => 'impact']) }}
        <div class="richtext" id="impact_text">{!! @$case_study->impact !!}</div>
    </div>
</div>

@section('script')
<script>
    // highlight required fields
    $('input,select,textarea').on('keyup focusout', function() {
        $('label.error').addClass('text-danger');
    });

    // form submit
    $(".form").validate({
        submitHandler: function (form) {
            event.preventDefault();
            $.post($(form).attr('action'), $(form).serialize())
            .done(function(data) {
                flashMessage(data);
            })
            .catch(function(data) {
                flashMessage(data)
            });
        },
    });
</script>
@stop