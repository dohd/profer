<div class="row g-0 mb-3">
    <div class="col-md-2 col-12"><label for="date">Date<span class="text-danger">*</span></label></div>
    <div class="col-md-8 col-12">
        {{ Form::date('date', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="row g-0 mb-3">
    <div class="col-md-2 col-12"><label for="subject">Subject<span class="text-danger">*</span></label></div>
    <div class="col-md-8 col-12">
        {{ Form::text('subject', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="row g-0 mb-3">
    <div class="col-md-2 col-12"><label for="doc_file">Material</label></div>
    <div class="col-md-8 col-12">
        {{ Form::file('doc_file', ['class' => 'form-control', 'id' => 'doc_file', 'accept' => '.csv, .pdf, .xls, .xlsx, .doc, .docx' ]) }}
    </div>
</div>
<div class="row g-0 mb-3">
    <div class="col-md-2 col-12"><label for="agegroup">Age Group<span class="text-danger">*</span></label></div>
    <div class="col-md-8 col-12">
        <select name="age_group_id" id="age-group" class="form-select" data-placeholder="Choose Age-group" required>
            <option value="">-- Select Age --</option>
            @foreach ($ageGroups as $agegroup)
                <option value="{{ $agegroup->id }}" {{ $agegroup->id == @$narrative->age_group_id? 'selected' : '' }}>
                    {{ $agegroup->bracket }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div id="table-container"></div>

@section('script')
<script>
    // on agenda change
    $('#agenda').change(function() {
        if (!this.value) return $('#table-container').html('');
        // fetch action plans
        const url = @json(route('narratives.table'));
        const params = {agenda_id: this.value, narrative_id: "{{ @$narrative->id }}"};
        $.post(url, params, data => {
            $('#table-container').html(data);
        });
    });

    /** Edit mode **/
    const narrative = @json(@$narrative);
    if (narrative) {
        $('#agenda').change();
    }
</script>
@stop