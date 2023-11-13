@php
    $budget_grandtotal = 0;
    $cost_grandtotal = 0;
    $act_cost_subtotals = 0;
@endphp
<!-- objectives & activities -->
@foreach ($budget->items as $item)
    @if ($item->type == 'objective')
        <tr class="bg-info bg-gradient">
            <td class="p-1" colspan="4"><b>{{ $item->name }}</b></td>
        </tr>
    @elseif ($item->type == 'activity')
        <tr>
            <td class="p-1">{{ $item->name }}</td>
            <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
            <td class="fw-bold">{{ numberFormat($item->total_cost) }}</td>
            <td class="fw-bold">{{ $item->burn_rate ?: 0 }}%</td>
        </tr>
        @php
            $act_cost_subtotals += $item->total_cost;
        @endphp
    @elseif ($item->type == 'subtotal')                                    
        <tr class="bg-light bg-gradient">
            <td class="p-1"><b>Subtotal</b></td>
            <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
            <td class="fw-bold">{{ numberFormat($act_cost_subtotals) }}</td>
            <td></td>
        </tr>  
        @php
            $budget_grandtotal += $item->budget;
            $cost_grandtotal += $act_cost_subtotals;
            $act_cost_subtotals = 0;
        @endphp     
    @endif
@endforeach
<!-- end objectives & activities -->

<!-- Personnel costs -->
<tr class="bg-info bg-gradient">
    <td class="p-1" colspan="4"><b>Personnel Costs</b></td>
</tr>
@php
    $c = 0;
    $personnel_cost_subtotals = 0;
@endphp
@foreach ($budget->items as $item)
    @php
        if ($item->type == 'overhead_cost') break;
    @endphp
    @if ($item->type == 'cost_item' && $c == 1)
        @if ($item->name == 'Subtotal')
            <tr class="bg-light bg-gradient">
                <td class="p-1"><b>Subtotal</b></td>
                <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                <td class="fw-bold">{{ numberFormat($personnel_cost_subtotals) }}</td>
                <td></td>
            </tr> 
            @php
                $cost_grandtotal += $personnel_cost_subtotals;
                $budget_grandtotal += $item->budget;
            @endphp  
        @else
            <tr>
                <td class="p-1">{{ $item->name }}</td>
                <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                <td class="fw-bold">{{ numberFormat($item->total_cost) }}</td>
                <td class="fw-bold">{{ $item->burn_rate ?: 0 }}%</td>
            </tr>     
            @php
                $personnel_cost_subtotals += $item->total_cost;
            @endphp  
        @endif
    @endif
    @php
        if ($item->type == 'personnel_cost') $c++;
    @endphp
@endforeach
<!--End personnel costs -->

<!-- overhead cost -->
<tr class="bg-info bg-gradient">
    <td class="p-1" colspan="4"><b>Overhead Costs</b></td>
</tr>
@php
    $c = 0;
    $overhead_cost_subtotals = 0;
@endphp
@foreach ($budget->items as $item)
    @if ($item->type == 'cost_item' && $c == 1)
        @if ($item->name == 'Subtotal')
            <tr class="bg-light bg-gradient">
                <td class="p-1"><b>Subtotal</b></td>
                <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                <td class="fw-bold">{{ numberFormat($overhead_cost_subtotals) }}</td>
                <td></td>
            </tr> 
            @php
                $budget_grandtotal += $item->budget;
                $cost_grandtotal += $overhead_cost_subtotals;
            @endphp 
        @else
            <tr>
                <td class="p-1">{{ $item->name }}</td>
                <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                <td class="fw-bold">{{ numberFormat($item->total_cost) }}</td>
                <td class="fw-bold">{{ $item->burn_rate ?: 0 }}%</td>
            </tr>     
            @php
                $overhead_cost_subtotals += $item->total_cost;
            @endphp
        @endif
    @endif
    @php
        if ($item->type == 'overhead_cost') $c++;
    @endphp
@endforeach
<!-- end overhead cost -->
<input type="hidden" id="budget-grandtotal" value="{{ $budget_grandtotal }}">
<input type="hidden" id="cost-grandtotal" value="{{ $cost_grandtotal }}">