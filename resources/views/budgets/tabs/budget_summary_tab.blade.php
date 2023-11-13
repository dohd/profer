<div class="tab-pane fade show" id="budget-summary" role="tabpanel" aria-labelledby="budget-summary-tab">
    <div class="row mb-3 mt-2">
        <div class="col-md-3 col-12">
            <input type="text" id="month" class="form-control datepicker" placeholder="Select Expense Month" readonly>
        </div>
        <div class="col-md-2 col-12">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-cstm" id="budgetItemsTbl">
            <thead>
                <tr class="table-primary">
                    <th>Description</th>
                    <th>Budget</th>
                    <th>Total Expense</th>
                    <th>Burn Rate</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grandtotal = 0;
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
                            <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                            <td class="fw-bold">80%</td>
                        </tr>
                    @elseif ($item->type == 'subtotal')                                    
                        <tr class="bg-light bg-gradient">
                            <td class="p-1"><b>Subtotal</b></td>
                            <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                            <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                            <td></td>
                        </tr>  
                        @php
                            $grandtotal += $item->budget;
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
                                <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                <td></td>
                            </tr> 
                            @php
                                $grandtotal += $item->budget;
                            @endphp  
                        @else
                            <tr>
                                <td class="p-1">{{ $item->name }}</td>
                                <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                <td class="fw-bold">80%</td>
                            </tr>     
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
                @endphp
                @foreach ($budget->items as $item)
                    @if ($item->type == 'cost_item' && $c == 1)
                        @if ($item->name == 'Subtotal')
                            <tr class="bg-light bg-gradient">
                                <td class="p-1"><b>Subtotal</b></td>
                                <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                <td></td>
                            </tr> 
                            @php
                                $grandtotal += $item->budget;
                            @endphp 
                        @else
                            <tr>
                                <td class="p-1">{{ $item->name }}</td>
                                <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                <td class="fw-bold">80%</td>
                            </tr>     
                        @endif
                    @endif
                    @php
                        if ($item->type == 'overhead_cost') $c++;
                    @endphp
                @endforeach
                <!-- end overhead cost -->
            </tbody>
            <tfoot>
                <tr><td colspan="2"></td></tr>
                <tr class="bg-light bg-gradient">
                    <td class="p-1"><b>Grand Total</b></td>
                    <td class="p-1 grandtotal fw-bold">{{ numberFormat($grandtotal) }}</td>
                    <td class="p-1 grandtotal fw-bold">{{ numberFormat($grandtotal) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>