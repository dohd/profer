
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
                    <td class="pt-2">
                        @if (@$narrative)
                            @foreach ($narrative->items as $nar_item)
                                @if ($nar_item->narrative_pointer_id == $item->id)
                                    <input type="text" name="response[]" class="form-control" value="{{ $nar_item->response }}">
                                    <input type="hidden" name="item_id[]" value="{{ $nar_item->id }}">
                                @endif
                            @endforeach
                        @else
                            <input type="text" name="response[]" class="form-control">
                        @endif
                    </td>
                    <input type="hidden" name="narrative_pointer_id[]" value="{{ $item->id }}">
                </tr>   
            @elseif ($item->pointer == 'pt_c')
                <tr>
                    <th scope="row" class="pt-2">{{ $i+1 }}</th>
                    <td class="pt-2">{{ $item->value }}</td>
                    <td class="pt-2">
                        @if (@$narrative)
                            @foreach ($narrative->items as $nar_item)
                                @if ($nar_item->narrative_pointer_id == $item->id)
                                    <input type="number" name="response[]" class="form-control" value="{{ $nar_item->response }}">
                                    <input type="hidden" name="item_id[]" value="{{ $nar_item->id }}">
                                @endif
                            @endforeach
                        @else
                            <input type="number" name="response[]" class="form-control">
                        @endif
                    </td>
                    <input type="hidden" name="narrative_pointer_id[]" value="{{ $item->id }}">
                </tr>   
            @else
                <tr>
                    <th scope="row" class="pt-2">{{ $i+1 }}</th>
                    <td class="pt-2">{{ $item->value }}</td>
                    <td class="pt-2">
                        @if (@$narrative)
                            @foreach ($narrative->items as $nar_item)
                                @if ($nar_item->narrative_pointer_id == $item->id)
                                    <textarea name="response[]" class="form-control" rows="3">{{ $nar_item->response }}</textarea>
                                    <input type="hidden" name="item_id[]" value="{{ $nar_item->id }}">
                                @endif
                            @endforeach
                        @else
                            <textarea name="response[]" class="form-control" rows="3"></textarea>
                        @endif
                    </td>
                    <input type="hidden" name="narrative_pointer_id[]" value="{{ $item->id }}">
                </tr>   
            @endif
        @endforeach
    </tbody>
</table>