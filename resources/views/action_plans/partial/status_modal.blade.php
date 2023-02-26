<!-- Modal -->
<div class="modal fade" id="status_modal" tabindex="-1" aria-labelledby="status_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status_modal_label">Action Plan Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::model($action_plan, ['route' => array('action_plans.update', $action_plan), 'method' => 'PATCH']) }}
                <div class="modal-body">
                    <div class="row">
                        <label for="status" class="col-2 col-form-label">Status</label>
                        <div class="col-6">
                            <select name="status" id="status" class="form-select">
                                @foreach (['pending', 'approved', 'review'] as $item)
                                    <option value="{{ $item }}" {{ $action_plan->status == $item? 'selected' : '' }}>{{ ucfirst($item) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
