@foreach ($proposal_items as $item)
<tr>
    <th scope="row">
        @if ($item->row_num)
            {{ $item->row_num }}
        @else
            <b style="font-size: 1em">.</b>
        @endif
    </th>
    <td>{{ $item->name }}</td>
    @if ($item->is_obj)
        <td colspan="5"></td>
        <input type="hidden" name="start_date[]">
        <input type="hidden" name="end_date[]">
        <input type="hidden" name="cohort_id[]">
        <input type="hidden" name="region_id[]" value="0-{{ $item->id }}">
        <input type="hidden" name="resources[]">
        <input type="hidden" name="assigned_to[]">
        <input type="hidden" name="proposal_item_id[]" value="{{ $item->id }}">
    @else
        <td>
            {{ Form::date('start_date[]', null, ['class' => 'form-control']) }}
            {{ Form::date('end_date[]', null, ['class' => 'form-control']) }}
        </td>
        <td>
            <select name="cohort_id[]" class="form-control target-group">
                <option value="">-- cohort --</option>
                @foreach ($cohorts as $cohort)
                    <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="region_id[]" class="form-control region" multiple>
                {{-- <option value="">-- select region --</option> --}}
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}-{{ $item->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </td>
        <td>{{ Form::textarea('resources[]', null, ['class' => 'form-control', 'rows' => '2']) }}</td>
        <td>{{ Form::text('assigned_to[]', null, ['class' => 'form-control']) }}</td>
        <input type="hidden" name="proposal_item_id[]" value="{{ $item->id }}">
    @endif
</tr>
@endforeach