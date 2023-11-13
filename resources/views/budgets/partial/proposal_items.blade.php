<!-- Edit template -->
@if (request('is_edit') == 'true')
    @php
        $grp = 0;
        $is_oc = false;
    @endphp
    <!-- End Objectives & Activities -->
    @foreach ($budget_items as $i => $item)
        @php
            $prev_item = $i? $budget_items[$i-1] : null; 
        @endphp
        @if ($item->type == 'objective')
            @php
                $grp++;
            @endphp
            <tr class="bg-info bg-gradient">
                <td class="p-1" colspan="2"><b>{{ $item->name }}</b></td>
                <input type="hidden" name="budget[]">
                <input type="hidden" name="name[]" value="{{ $item->name }}">
                <input type="hidden" name="proposal_item_id[]" value="{{ $item->proposal_item_id }}">
                <input type="hidden" name="type[]" value="objective">
            </tr>
        @elseif ($item->type == 'activity')
            <tr>
                <td class="p-1">{{ $item->name }}</td>
                <td class="p-1"><input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]" value="{{ $item->budget }}"></td>
                <input type="hidden" name="name[]" value="{{ $item->name }}">
                <input type="hidden" name="proposal_item_id[]" value="{{ $item->proposal_item_id }}">
                <input type="hidden" name="type[]" value="activity">
            </tr>
        @elseif ($item->type == 'subtotal' && $prev_item && in_array($prev_item->type, ['objective', 'activity']))
            <tr class="bg-light bg-gradient">
                <td class="p-1"><b>Subtotal</b></td>
                <td class="grp-{{ $grp }} p-1 subtotal"><b>{{ numberFormat($item->budget) }}</b></td>
                <input type="hidden" name="budget[]">
                <input type="hidden" name="name[]" value="Subtotal">
                <input type="hidden" name="proposal_item_id[]">
                <input type="hidden" name="type[]" value="subtotal">
            </tr>
        @endif
    @endforeach
    <tr><td colspan="2" style="height: 30px"></td></tr>
    <!-- End Objectives & Activities -->

    <!-- Personnel Costs -->
    @foreach ($budget_items as $i => $item)
        @php
            if ($item->type == 'overhead_cost') break;
        @endphp
        @if ($item->type == 'personnel_cost')
            @php
                $grp++;
            @endphp
            <tr class="bg-info bg-gradient">
                <td class="p-1" colspan="2"><b>Personnel Costs</b></td>
                <input type="hidden" name="name[]" value="Personnel Costs">
                <input type="hidden" name="budget[]">
                <input type="hidden" name="proposal_item_id[]">
                <input type="hidden" name="type[]" value="personnel_cost">
            </tr>
        @elseif ($item->type == 'cost_item')
            @if ($item->name == 'Subtotal')
                {{-- js row template --}}
                <tr class="d-none tmp-row">
                    <td class="p-1"><input type="text" class="form-control p-1 cost-item" name="name[]" placeholder="Cost Item"></td>
                    <td class="p-1">
                        <div class="row g-1">
                            <div class="col-md-10">
                                <input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]">
                            </div>
                            <div class="col-md-2">
                                <span class="del" style="cursor: pointer;">
                                    <i class="bi bi-trash text-danger icon-xs"></i>
                                </span>
                            </div>
                        </div>
                    </td>
                    <input type="hidden" name="proposal_item_id[]">
                    <input type="hidden" name="type[]" value="cost_item">
                </tr>
                {{-- end js row template --}}
                <tr class="bg-light bg-gradient">
                    <td class="p-1"><b>Subtotal</b></td>
                    <td class="grp-{{ $grp }} p-1 subtotal"><b>{{ numberFormat($item->budget) }}</b></td>
                    <input type="hidden" name="budget[]" value="{{ numberFormat($item->budget) }}">
                    <input type="hidden" name="name[]" value="Subtotal">
                    <input type="hidden" name="proposal_item_id[]">
                    <input type="hidden" name="type[]" value="cost_item">
                </tr>
                <tr>
                    <td colspan="2" style="height: 30px" class="text-center">
                        <span class="badge bg-success text-white add-row" role="button">
                            <i class="bi bi-plus-lg"></i> Row
                        </span>
                    </td>
                </tr>
            @else
                <tr>
                    <td class="p-1"><input type="text" class="form-control p-1 cost-item" name="name[]" value="{{ $item->name }}" placeholder="Cost Item"></td>
                    <td class="p-1">
                        <div class="row g-1">
                            <div class="col-md-10">
                                <input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]" value="{{ numberFormat($item->budget) }}">
                            </div>
                            <div class="col-md-2">
                                <span class="del" style="cursor: pointer;">
                                    <i class="bi bi-trash text-danger icon-xs"></i>
                                </span>
                            </div>
                        </div>
                    </td>
                    <input type="hidden" name="proposal_item_id[]" value="{{ $item->proposal_item_id }}">
                    <input type="hidden" name="type[]" value="cost_item">
                </tr>
            @endif
        @endif
    @endforeach

    <!-- Overhead Costs -->
    @foreach ($budget_items as $i => $item)
        @if ($item->type == 'overhead_cost')
            @php
                $grp++;
                $is_oc = true;
            @endphp
            <tr class="bg-info bg-gradient">
                <td class="p-1" colspan="2"><b>Overhead Costs</b></td>
                <input type="hidden" name="name[]" value="Overhead Costs">
                <input type="hidden" name="budget[]">
                <input type="hidden" name="proposal_item_id[]">
                <input type="hidden" name="type[]" value="overhead_cost">
            </tr>
        @elseif ($item->type == 'cost_item' && $is_oc)
            @if ($item->name == 'Subtotal')
                {{-- js row template --}}
                <tr class="d-none tmp-row">
                    <td class="p-1"><input type="text" class="form-control p-1 cost-item" name="name[]" placeholder="Cost Item"></td>
                    <td class="p-1">
                        <div class="row g-1">
                            <div class="col-md-10">
                                <input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]">
                            </div>
                            <div class="col-md-2">
                                <span class="del" style="cursor: pointer;">
                                    <i class="bi bi-trash text-danger icon-xs"></i>
                                </span>
                            </div>
                        </div>
                    </td>
                    <input type="hidden" name="proposal_item_id[]">
                    <input type="hidden" name="type[]" value="cost_item">
                </tr>
                {{-- end js row template --}}
                <tr class="bg-light bg-gradient">
                    <td class="p-1"><b>Subtotal</b></td>
                    <td class="grp-{{ $grp }} p-1 subtotal"><b>{{ numberFormat($item->budget) }}</b></td>
                    <input type="hidden" name="budget[]" value="{{ numberFormat($item->budget) }}">
                    <input type="hidden" name="name[]" value="Subtotal">
                    <input type="hidden" name="proposal_item_id[]">
                    <input type="hidden" name="type[]" value="cost_item">
                </tr>
                <tr>
                    <td colspan="2" style="height: 30px" class="text-center">
                        <span class="badge bg-success text-white add-row" role="button">
                            <i class="bi bi-plus-lg"></i> Row
                        </span>
                    </td>
                </tr>
            @else
                <tr>
                    <td class="p-1"><input type="text" class="form-control p-1 cost-item" name="name[]" value="{{ $item->name }}" placeholder="Cost Item"></td>
                    <td class="p-1">
                        <div class="row g-1">
                            <div class="col-md-10">
                                <input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]" value="{{ numberFormat($item->budget) }}">
                            </div>
                            <div class="col-md-2">
                                <span class="del" style="cursor: pointer;">
                                    <i class="bi bi-trash text-danger icon-xs"></i>
                                </span>
                            </div>
                        </div>
                    </td>
                    <input type="hidden" name="proposal_item_id[]" value="{{ $item->proposal_item_id }}">
                    <input type="hidden" name="type[]" value="cost_item">
                </tr>
            @endif
        @endif
    @endforeach
@endif
<!-- End Edit template -->




<!-- Create template -->
@if (request('is_edit') == 'false')
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
                <input type="hidden" name="budget[]">
                <input type="hidden" name="name[]" value="Subtotal">
                <input type="hidden" name="proposal_item_id[]">
                <input type="hidden" name="type[]" value="subtotal">
            </tr>
        @endif
    @endforeach
    <tr><td colspan="2" style="height: 30px"></td></tr>
    <!-- End Objectives & Activities -->

    <!-- Personnel Costs -->
    <tr class="bg-info bg-gradient">
        @php
            $grp++;
        @endphp
        <td class="p-1" colspan="2"><b>Personnel Costs</b></td>
        <input type="hidden" name="name[]" value="Personnel Costs">
        <input type="hidden" name="budget[]">
        <input type="hidden" name="proposal_item_id[]">
        <input type="hidden" name="type[]" value="personnel_cost">
    </tr>
    <tr>
        <td class="p-1"><input type="text" class="form-control p-1 cost-item" name="name[]" placeholder="Cost Item"></td>
        <td class="p-1">
            <div class="row g-1">
                <div class="col-md-10">
                    <input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]">
                </div>
                <div class="col-md-2">
                    <span class="del" style="cursor: pointer;">
                        <i class="bi bi-trash text-danger icon-xs"></i>
                    </span>
                </div>
            </div>
        </td>
        <input type="hidden" name="proposal_item_id[]">
        <input type="hidden" name="type[]" value="cost_item">
    </tr>
    {{-- js row template --}}
    <tr class="d-none tmp-row">
        <td class="p-1"><input type="text" class="form-control p-1 cost-item" name="name[]" placeholder="Cost Item"></td>
        <td class="p-1">
            <div class="row g-1">
                <div class="col-md-10">
                    <input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]">
                </div>
                <div class="col-md-2">
                    <span class="del" style="cursor: pointer;">
                        <i class="bi bi-trash text-danger icon-xs"></i>
                    </span>
                </div>
            </div>
        </td>
        <input type="hidden" name="proposal_item_id[]">
        <input type="hidden" name="type[]" value="cost_item">
    </tr>
    {{-- end js row template --}}
    <tr class="bg-light bg-gradient">
        <td class="p-1"><b>Subtotal</b></td>
        <td class="grp-{{ $grp }} p-1 subtotal"><b>0.00</b></td>
        <input type="hidden" name="budget[]">
        <input type="hidden" name="name[]" value="Subtotal">
        <input type="hidden" name="proposal_item_id[]">
        <input type="hidden" name="type[]" value="cost_item">
    </tr>
    <tr>
        <td colspan="2" style="height: 30px" class="text-center">
            <span class="badge bg-success text-white add-row" role="button">
                <i class="bi bi-plus-lg"></i> Row
            </span>
        </td>
    </tr>
    <!-- End Personnel Costs -->

    <!-- Overhead Costs -->
    <tr class="bg-info bg-gradient">
        @php
            $grp++;
        @endphp
        <td class="p-1" colspan="2"><b>Overhead Costs</b></td>
        <input type="hidden" name="name[]" value="Overhead Costs">
        <input type="hidden" name="budget[]">
        <input type="hidden" name="proposal_item_id[]">
        <input type="hidden" name="type[]" value="overhead_cost">
    </tr>
    <tr>
        <td class="p-1"><input type="text" class="form-control p-1 cost-item" name="name[]" value="" placeholder="Cost Item"></td>
        <td class="p-1">
            <div class="row g-1">
                <div class="col-md-10">
                    <input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]">
                </div>
                <div class="col-md-2">
                    <span class="del" style="cursor: pointer;">
                        <i class="bi bi-trash text-danger icon-xs"></i>
                    </span>
                </div>
            </div>
        </td>
        <input type="hidden" name="proposal_item_id[]" value="">
        <input type="hidden" name="type[]" value="cost_item">
    </tr>
    {{-- js row template --}}
    <tr class="d-none tmp-row">
        <td class="p-1"><input type="text" class="form-control p-1 cost-item" name="name[]" value="" placeholder="Cost Item"></td>
        <td class="p-1">
            <div class="row g-1">
                <div class="col-md-10">
                    <input type="text" class="grp-{{ $grp }} form-control p-1 budget" name="budget[]">
                </div>
                <div class="col-md-2">
                    <span class="del" style="cursor: pointer;">
                        <i class="bi bi-trash text-danger icon-xs"></i>
                    </span>
                </div>
            </div>
        </td>
        <input type="hidden" name="proposal_item_id[]" value="">
        <input type="hidden" name="type[]" value="cost_item">
    </tr>
    {{-- end js row template --}}
    <tr class="bg-light bg-gradient">
        <td class="p-1"><b>Subtotal</b></td>
        <td class="grp-{{ $grp }} p-1 subtotal"><b>0.00</b></td>
        <input type="hidden" name="budget[]" value="">
        <input type="hidden" name="name[]" value="Subtotal">
        <input type="hidden" name="proposal_item_id[]" value="">
        <input type="hidden" name="type[]" value="cost_item">
    </tr>
    <tr>
        <td colspan="2" style="height: 30px" class="text-center">
            <span class="badge bg-success text-white add-row" role="button">
                <i class="bi bi-plus-lg"></i> Row
            </span>
        </td>
    </tr>
    <!-- End Overhead Costs -->
@endif
<!-- End Create template -->
