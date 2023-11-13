<!-- Modal -->
<div class="modal fade" id="expense_modal" tabindex="-1" aria-labelledby="expense_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expense_modal_label">Add Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['route' => 'budgets.store_expenses', 'method' => 'POST', 'id' => 'expense_form']) }}
                {{ Form::hidden('budget_id', @$budget->id) }}
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="item_category">Cost Item Category<span class="text-danger">*</span></label>
                            <select name="item_category_id" class="form-control" id="item_category" data-placeholder="Choose Cost Item Category" required>
                                <option value=""></option>
                                @foreach ($item_categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="cost_item">Cost Item<span class="text-danger">*</span></label>
                            <select name="cost_item_id" class="form-control" id="cost_item" data-placeholder="Choose Cost Item" required>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-12">
                            <label for="activity_date">Activity Date<span class="text-danger">*</span></label>
                            {{ Form::date('date', null, ['class' => 'form-control', 'id' => 'activity_date', 'required' => 'required']) }}
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="amount">Total Amount<span class="text-danger">*</span></label>
                            {{ Form::text('amount', null, ['class' => 'form-control', 'id' => 'amount', 'required' => 'required']) }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
