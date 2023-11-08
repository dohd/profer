<!-- Objectives & Activities -->
@php
    $grp = 0;
@endphp
@foreach ($proposal_items as $i => $item)
    @if ($item->is_obj)
        @php
            $grp++;
        @endphp
        <tr class="bg-info bg-gradient">
            <td class="p-1" colspan="2"><b>{{ $item->name }}</b></td>
            <input type="hidden" name="budget[]" value="">
            <input type="hidden" name="name[]" value="{{ $item->name }}">
            <input type="hidden" name="proposal_item_id[]" value="{{ $item->id }}">
            <input type="hidden" name="type[]" value="objective">
        </tr>
    @else
        <tr>
            <td class="p-1">{{ $item->name }}</td>
            <td class="p-1"><input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]" value=""></td>
            <input type="hidden" name="name[]" value="{{ $item->name }}">
            <input type="hidden" name="proposal_item_id[]" value="{{ $item->id }}">
            <input type="hidden" name="type[]" value="activity">
        </tr>
    @endif
    @php
        $is_btwn = !$item->is_obj && isset($proposal_items[$i+1]) && $proposal_items[$i+1]->is_obj;
        $is_last = $proposal_items->last()->id == $item->id;
    @endphp
    @if ($is_btwn || $is_last)
        <tr class="bg-light bg-gradient">
            <td class="p-1"><b>Subtotal</b></td>
            <td class="grp-{{ $grp }} p-1 subtotal"><b>0.00</b></td>
            <input type="hidden" name="budget[]" value="">
            <input type="hidden" name="name[]" value="Subtotal">
            <input type="hidden" name="proposal_item_id[]" value="">
            <input type="hidden" name="type[]" value="subtotal">
        </tr>
    @endif
@endforeach
<!-- End Objectives & Activities -->

<!-- Personnel Costs -->
<tr class="bg-info bg-gradient">
    @php
        $grp++;
    @endphp
    <td class="p-1" colspan="2"><b>Personnel Costs</b></td>
</tr>
@php
    $labels = ['Director', 'Programme Officer', 'Project M&E Officer', 'Project Accountant', 'Medical Cover'];
@endphp
@foreach ($labels as $label)
    <tr>
        <td class="p-1">{{ $label }}</td>
        <td class="p-1"><input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]" value=""></td>
        <input type="hidden" name="name[]" value="{{ $label }}">
        <input type="hidden" name="proposal_item_id[]" value="">
        <input type="hidden" name="type[]" value="personnel_cost">
    </tr>
@endforeach
<tr class="bg-light bg-gradient">
    <td class="p-1"><b>Subtotal</b></td>
    <td class="grp-{{ $grp }} p-1 subtotal"><b>0.00</b></td>
    <input type="hidden" name="budget[]" value="">
    <input type="hidden" name="name[]" value="Subtotal">
    <input type="hidden" name="proposal_item_id[]" value="">
    <input type="hidden" name="type[]" value="personnel_cost">
</tr>
<!-- End Personnel Costs -->

<!-- Overhead Costs -->
<tr class="bg-info bg-gradient">
    @php
        $grp++;
    @endphp
    <td class="p-1" colspan="2"><b>Overhead Costs</b></td>
</tr>
@php
    $labels = ['Travel Cost', 'Office Rent Contribution', 'Direct Cost', 'Audit Fees', 'Communication', 'Motor Vehicle (Fuel, Maintenance, Insurance)'];
@endphp
@foreach ($labels as $label)
    <tr>
        <td class="p-1">{{ $label }}</td>
        <td class="p-1"><input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]" value=""></td>
        <input type="hidden" name="name[]" value="{{ $label }}">
        <input type="hidden" name="proposal_item_id[]" value="">
        <input type="hidden" name="type[]" value="overhead_cost">
    </tr>
@endforeach
<tr class="bg-light bg-gradient">
    <td class="p-1"><b>Subtotal</b></td>
    <td class="grp-{{ $grp }} p-1 subtotal"><b>0.00</b></td>
    <input type="hidden" name="budget[]" value="">
    <input type="hidden" name="name[]" value="Subtotal">
    <input type="hidden" name="proposal_item_id[]" value="">
    <input type="hidden" name="type[]" value="overhead_cost">
</tr>
<!-- End Overhead Costs -->
