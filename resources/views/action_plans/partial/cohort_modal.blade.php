<!-- Modal -->
<div class="modal fade" id="cohort_modal" tabindex="-1" aria-labelledby="cohort_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cohort_modal_label">Add Target Cohort</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::model($action_plan, ['route' => array('action_plans.update', $action_plan), 'method' => 'PATCH']) }}
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="activity">Activity</label>
                            <select name="activity_id[]" class="form-control select2" id="activity" data-placeholder="Choose Activity">
                                <option value=""></option>
                                @foreach ([] as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <table class="table table-striped" id="participants_tbl">
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
                                    <select name="cohort[]" class="form-select gender">
                                        @foreach ([] as $item)
                                            <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="organisation[]" class="form-control org"></td>
                                <td>
                                    <div class="d-inline"></div>
                                    <a class="dropdown-item pt-1 pb-1 remove" href="javascript:">
                                        <i class="bi bi-trash text-danger icon-xs ml-1"></i>
                                    </a> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5>
                        <span class="badge bg-primary addrow" role="button"><i class="bi bi-plus-lg"></i> row</span>
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
