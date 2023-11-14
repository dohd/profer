<div class="tab-pane fade show" id="budget-summary" role="tabpanel" aria-labelledby="budget-summary-tab">
    <div class="row g-1 mb-3 mt-2 ">
        <div class="col-md-3 col-12">
            <input type="text" id="query-month" class="form-control datepicker" placeholder="Select Expense Month" readonly>
        </div>
        <div class="col-md-2 col-2 pt-1">
            <button type="button" id="query-btn" class="btn btn-primary btn-sm ms-1"><i class="bi bi-search"></i> Search</button>
            <button type="button" id="reload-btn" class="btn btn-success btn-sm">
                <i class="bi bi-arrow-clockwise"></i>
            </button>
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
            <tbody></tbody>
            <tfoot>
                <tr><td colspan="2"></td></tr>
                <tr class="bg-light bg-gradient">
                    <td class="p-1"><b>Grand Total</b></td>
                    <td class="p-1 budget-grandtotal fw-bold">0.0</td>
                    <td class="p-1 cost-grandtotal fw-bold">0.0</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>