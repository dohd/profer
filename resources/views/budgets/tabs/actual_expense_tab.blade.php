<div class="tab-pane fade show" id="actual-expense" role="tabpanel" aria-labelledby="actual-expense-tab">
    <div class="row mb-2">
        <div class="col-12">
            <div class="float-end">
                <span class="badge bg-primary text-white" role="button" id="activity_md" data-bs-toggle="modal" data-bs-target="#expense_modal">
                    <i class="bi bi-plus-lg"></i> Expense
                </span>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped datatable" id="expenseTbl">
            <thead>
                <tr>
                    <th scope="col" width="8%">#</th>
                    <th scope="col">Cost Category</th>
                    <th scope="col">Item Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($budget->expenses as $i => $item)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ @$item->cost_item_category->name }}</td>
                        <td>{{ @$item->cost_item->name }}</td>
                        <td>{{ dateFormat($item->date) }}</td>
                        <td>{{ numberFormat($item->amount) }}</td>
                        <td>
                            <div class="dropdown"> 
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                                    Action 
                                </button> 
                                <ul class="dropdown-menu"> 
                                    <li>
                                        <a class="dropdown-item pt-1 pb-1 edit" href="#expense_modal" data-bs-toggle="modal" data-id="{{ $item->id }}" data-url="{{ route('budgets.edit_expenses', $item) }}" post-url="{{ route('budgets.update_expenses', $item) }}">
                                            <i class="bi bi-pencil-square"></i>Edit
                                        </a>
                                    </li> 
                                    <li>
                                        <a class="dropdown-item pt-1 pb-1 destroy" href="javascript:"> 
                                            <i class="bi bi-trash text-danger icon-xs"></i>Delete 
                                            {{ Form::open(['route' => ['budgets.destroy_expenses', $item], 'method' => 'POST']) }}
                                            {{ Form::close() }}
                                        </a>
                                    </li> 
                                </ul> 
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('budgets.partial.expense_modal')
</div>