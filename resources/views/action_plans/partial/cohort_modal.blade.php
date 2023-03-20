<!-- Modal -->
<div class="modal fade" id="cohort_modal" tabindex="-1" aria-labelledby="cohort_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cohort_modal_label">Add Target Cohort</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['route' => 'action_plans.store_cohort', 'method' => 'POST', 'id' => 'cohort_form']) }}
                <input type="hidden" name="item_id" id="cohort_item_id">
                <input type="hidden" name="action_plan_id" value="{{ $action_plan->id }}">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="activity">Activity</label>
                            <select name="activity_id" class="form-control" id="cohort_activity" data-placeholder="Choose Activity" required>
                                <option value=""></option>
                                @foreach ($cohort_activities as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <table class="table table-striped" id="cohorts_tbl">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th width="50%">Cohort</th>
                                <th scope="col">Targeted No.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row template -->
                            <tr>
                                <th scope="row" class="p-3 num">1</th>
                                <td>
                                    <select name="cohort_id[]" class="form-select custom cohort_id" data-placeholder="Choose Cohort" required>
                                        <option value=""></option>
                                        @foreach ($cohorts as $key => $value)
                                            <option value="{{ $key }}">{{ ucfirst($value) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="target_no[]" class="form-control target_no" required></td>
                                <td>
                                    <div class="d-inline"></div>
                                    <a class="dropdown-item pt-1 pb-1 del" href="javascript:">
                                        <i class="bi bi-trash text-danger icon-xs ml-1"></i>
                                    </a> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5>
                        <span class="badge bg-primary addrow" role="button">
                            <i class="bi bi-plus-lg"></i> row
                        </span>
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
