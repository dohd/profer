<div class="row mb-3">
    <div class="col-9">
        <label for="programme">Programme Name*</label>
        <select name="programme_id" id="programme" class="form-control select2" data-placeholder="Choose Programme" required>
            <option value=""></option>
            @foreach ($programmes as $item)
                <option value="{{ $item->id }}" {{ @$case_study->programme_id == $item->id? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <label for="date">Date*</label>
        {{ Form::date('date', null, ['class' => 'form-control datepicker', 'required']) }}
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <label for="content">Title*</label>
        {{ Form::text('title', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <label for="content">Content*</label>
        {{ Form::textarea('content', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>

@section('script')
<script>

</script>
@stop