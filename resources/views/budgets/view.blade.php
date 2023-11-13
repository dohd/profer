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
                <div class="row mb-2">
                    <div class="col-12">
                        @if (in_array($budget->status, ['approved', 'pending']))
                            <b>Approval Status: </b>
                            <span class="badge bg-{{ $budget->status == 'approved'? 'success' : 'secondary' }}">{{ $budget->status }}</span>
                        @endif
                        <p class="text-center">
                            @if ($budget->status_note && $budget->status == 'rejected')
                                <b>Approval Status: </b>
                                <span class="badge bg-danger text-white">Rejected</span>
                                <br>
                                {{ $budget->status_note }}
                            @endif
                        </p>
                    </div>
                </div>

                <div class="card-content">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="budget-summary-tab" data-bs-toggle="tab" data-bs-target="#budget-summary" type="button" role="tab" aria-controls="summary" aria-selected="true">
                                Budget Tracker
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="actual-expense-tab" data-bs-toggle="tab" data-bs-target="#actual-expense" type="button" role="tab" aria-controls="log-frame" aria-selected="false">
                                Actual Expense
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabContent">
                        <!-- budget summary -->
                        @include('budgets.tabs.budget_summary_tab')
                        <!-- actual expense  -->
                        @include('budgets.tabs.actual_expense_tab')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('budgets.partial.status_modal')
@stop

@section('script')
<script>
    // On status change
    $('#status').change(function() {
        const row =$('#note').parents('.row');
        if ($(this).val() == 'review') row.removeClass('d-none');
        else row.addClass('d-none');
    }).trigger('change');

    // Expense month
    $('#month').datepicker({
        autoHide: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        format: 'MM-yyyy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
</script>
@include('budgets.modal_js')
@endsection
