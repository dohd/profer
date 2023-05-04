<div class="row mb-3">
    <div class="col-8">
        <label for="agenda">Agenda*</label>
        <select name="agenda_id" id="agenda" class="form-control select2" data-placeholder="Choose Agenda" required>
            <option value=""></option>
            @foreach ($agenda as $item)
                <option value="{{ $item->id }}">
                    {{ $item->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
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
        const params = {agenda_id: this.value};
        $.post(url, params, data => {
            $('#table-container').html(data);
            // console.log(data)
        });
    });
</script>
@stop