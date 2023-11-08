@extends('layouts.core')

@section('title', 'View | Project Budget')
    
@section('content')
    @include('budgets.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Project Budget Details
                <span class="badge bg-secondary text-white float-end" role="button" data-bs-toggle="modal" data-bs-target="#status_modal">
                    <i class="bi bi-pencil-fill"></i> Status
                </span>
            </h5>
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-cstm" id="budgetItemsTbl">
                        <thead>
                            <tr class="table-primary">
                                <th width="70%">Description</th>
                                <th width="12%">Budget</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $grandtotal = 0;
                            @endphp
                            @foreach ($budget->items as $item)
                                @if ($item->type == 'objective')
                                    <tr class="bg-info bg-gradient">
                                        <td class="p-1" colspan="2"><b>{{ $item->name }}</b></td>
                                    </tr>
                                @elseif ($item->type == 'activity')
                                    <tr>
                                        <td class="p-1">{{ $item->name }}</td>
                                        <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                    </tr>
                                @elseif ($item->type == 'subtotal')                                    
                                    <tr class="bg-light bg-gradient">
                                        <td class="p-1"><b>Subtotal</b></td>
                                        <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                    </tr>  
                                    @php
                                        $grandtotal += $item->budget;
                                    @endphp     
                                @endif
                            @endforeach
                            <tr class="bg-info bg-gradient">
                                <td class="p-1" colspan="2"><b>Personnel Costs</b></td>
                            </tr>
                            @foreach ($budget->items as $item)
                                @if ($item->type == 'personnel_cost')
                                    @if ($item->name == 'Subtotal')
                                        <tr class="bg-light bg-gradient">
                                            <td class="p-1"><b>Subtotal</b></td>
                                            <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                        </tr> 
                                        @php
                                            $grandtotal += $item->budget;
                                        @endphp  
                                    @else
                                        <tr>
                                            <td class="p-1">{{ $item->name }}</td>
                                            <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                        </tr>     
                                    @endif
                                @endif
                            @endforeach
                            <tr class="bg-info bg-gradient">
                                <td class="p-1" colspan="2"><b>Overhead Costs</b></td>
                            </tr>
                            @foreach ($budget->items as $item)
                                @if ($item->type == 'overhead_cost')
                                    @if ($item->name == 'Subtotal')
                                        <tr class="bg-light bg-gradient">
                                            <td class="p-1"><b>Subtotal</b></td>
                                            <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                        </tr> 
                                        @php
                                            $grandtotal += $item->budget;
                                        @endphp 
                                    @else
                                        <tr>
                                            <td class="p-1">{{ $item->name }}</td>
                                            <td class="fw-bold">{{ numberFormat($item->budget) }}</td>
                                        </tr>     
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr><td colspan="2"></td></tr>
                            <tr class="bg-light bg-gradient">
                                <td class="p-1"><b>Grand Total</b></td>
                                <td class="p-1 grandtotal fw-bold">{{ numberFormat($grandtotal) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('budgets.partial.status_modal')
@stop

@section('script')
<script>
    $('#status').change(function() {
        if ($(this).val() == 'review') {
            $('#note').parents('.row').removeClass('d-none');
        } else {
            $('#note').parents('.row').addClass('d-none');
        }
    }).trigger('change');
</script>
@endsection
