<div class="row mb-3">
    <div class="col-md-8 col-12">
        <label for="agenda">Agenda*</label>
        <select name="agenda_id" id="agenda" class="form-control select2" data-placeholder="Choose Agenda" required>
            <option value=""></option>
            @foreach ($agenda as $item)
                <option value="{{ $item->id }}" {{ @$narrative->agenda_id == $item->id? 'selected' : '' }}>
                    {{ $item->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 col-12">
        <label for="date">Date*</label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required']) }}
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