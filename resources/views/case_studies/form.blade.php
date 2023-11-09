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
<div class="row mb-3">
    <div class="col-md-4 col-12">
        <label class="form-label" for="file">Image 1</label>
        {{ Form::file('image1', ['class' => 'form-control', 'id' => 'image1', 'accept' => '.png, .jpg, .jpeg' ]) }}
        {{ Form::text('caption1', null, ['class' => 'form-control mt-1', 'placeholder' => 'Image 1 Caption']) }}
    </div>
    <div class="col-md-4 col-12">
        <label class="form-label" for="file">Image 2</label>
        {{ Form::file('image2', ['class' => 'form-control', 'id' => 'image2', 'accept' => '.png, .jpg, .jpeg' ]) }}
        {{ Form::text('caption2', null, ['class' => 'form-control mt-1', 'placeholder' => 'Image 2 Caption']) }}
    </div>
    <div class="col-md-4 col-12">
        <label class="form-label" for="file">Image 3</label>
        {{ Form::file('image3', ['class' => 'form-control', 'id' => 'image3', 'accept' => '.png, .jpg, .jpeg' ]) }}
        {{ Form::text('caption3', null, ['class' => 'form-control mt-1', 'placeholder' => 'Image 3 Caption']) }}
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
            const formData = new FormData(form);
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
            }).done((data) => flashMessage(data))
            .catch((data) => flashMessage(data));
        },
    });
</script>
@stop