@extends('layouts.core')

@section('title', 'View | Project Budget')
    
@section('content')
    @include('budgets.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title pb-1">
                Project Budget Details
                <span class="badge bg-secondary text-white float-end" role="button" data-bs-toggle="modal" data-bs-target="#status_modal">
                    <i class="bi bi-pencil-fill"></i> Status
                </span>
            </h5>
            <div class="card-content p-2">
                <div class="row mb-3">
                    <div class="col-md-12 col-12">
                        @if (in_array($budget->status, ['approved', 'pending']))
                            <span class="badge bg-{{ $budget->status == 'approved'? 'success' : 'secondary' }}">{{ $budget->status }}</span>
                        @endif
                        <p class="text-center">
                            @if ($budget->status_note && $budget->status == 'rejected')
                                <span class="badge bg-danger text-white">Rejected</span>
                                <br>
                                {{ $budget->status_note }}
                            @endif
                        </p>
                        <h5>
                            Budget For : <b>({{ tidCode('proposal', @$budget->proposal->tid) }}) {{ @$budget->proposal->title }}</b> <br>
                            Project Partner : <b>{{ @$budget->proposal->donor->name }}</b>
                        </h5>
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
    $('#query-month').datepicker({
        autoHide: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        format: 'MM-yyyy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });

    // Search month on budget tracker
    $('#query-btn').click(function() {
        $('#budgetItemsTbl tbody').html('');
        const query_month = $('#query-month').val();
        $.post("{{ route('budgets.budget_tracker', $budget) }}", {query_month})
        .done((data) => {
            $('#budgetItemsTbl tbody').html(data);
            const budgetGrandtotal = accounting.unformat($('#budget-grandtotal').val());
            const costGrandtotal = accounting.unformat($('#cost-grandtotal').val());
            $('.budget-grandtotal').text(accounting.formatNumber(budgetGrandtotal,2));
            $('.cost-grandtotal').text(accounting.formatNumber(costGrandtotal,2));
        })
        .catch((res) => res);
    }).trigger('click');
    $('#reload-btn').click(function() {
        $('#query-month').val('');
        $('#query-btn').click();
    });
</script>
@include('budgets.modal_js')
@endsection
