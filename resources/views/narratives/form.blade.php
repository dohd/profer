<div class="row mb-3">
    <div class="col-12">
        <label for="name">Project Title*</label>
        <select name="proposal_id" id="proposal" class="form-select">
            <option value="">-- choose project --</option>
            @foreach ($proposals as $proposal)
                <option value="{{ $proposal->id }}">{{ $proposal->title }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        <label for="name">Activity*</label>
        <select name="proposal_item_id" id="activity" class="form-select">
            <option value="">-- choose activity --</option>
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        <label for="name">Note</label>
        {{ Form::text('note', null, ['class' => 'form-control']) }}
    </div>
</div>

<table class="table table-striped" id="narratives_tbl">
    <thead>
        <tr class="">
            <th scope="col">#</th>
            <th scope="col" width="30%">Narrative Indicator</th>
            <th scope="col">Response</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($narrative_pointers as $i => $item)
            @if ($item->pointer == 'pt_a')
                <tr>
                    <th scope="row" class="pt-2">{{ $i+1 }}</th>
                    <td class="pt-2">{{ $item->value }}</td>
                    <td class="pt-2"><input type="text" name="response[]" class="form-control"></td>
                    <input type="hidden" name="narrative_pointer_id[]" value="{{ $item->id }}">
                </tr>   
            @elseif ($item->pointer == 'pt_c')
                <tr>
                    <th scope="row" class="pt-2">{{ $i+1 }}</th>
                    <td class="pt-2">{{ $item->value }}</td>
                    <td class="pt-2"><input type="number" name="response[]" class="form-control"></td>
                    <input type="hidden" name="narrative_pointer_id[]" value="{{ $item->id }}">
                </tr>   
            @else
                <tr>
                    <th scope="row" class="pt-2">{{ $i+1 }}</th>
                    <td class="pt-2">{{ $item->value }}</td>
                    <td class="pt-2"><textarea name="response[]" class="form-control" rows="3"></textarea></td>
                    <input type="hidden" name="narrative_pointer_id[]" value="{{ $item->id }}">
                </tr>   
            @endif
        @endforeach
        
    </tbody>
</table>

@section('script')
<script>
    $('#proposal').change(function() {
        $.post("{{ route('proposals.items') }}", {proposal_id: $(this).val()}, data => {
            $('#activity option:not(:first)').remove();
            data.forEach(v => {
                if (v.is_obj == 0) $('#activity').append(`<option value="${v.id}">${v.name}</option>`);
            });
        });
    });
</script>
@stop