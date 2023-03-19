<!-- Modal -->
<div class="modal fade" id="activity_modal" tabindex="-1" aria-labelledby="activity_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activity_modal_label">Add Activity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['route' => 'action_plans.store_activity', 'method' => 'POST', 'id' => 'activity_form']) }}
            <input type="hidden" name="action_plan_id" value="{{ $action_plan->id }}">
                <input type="hidden" name="item_id" id="item_id">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="activity">Activity</label>
                            <select name="activity_id" class="form-control" id="activity" data-placeholder="Choose Activity" required>
                                <option value=""></option>
                                @foreach ($activities as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="start_date">Start Date*</label>
                            {{ Form::date('start_date', null, ['class' => 'form-control', 'id' => 'start_date', 'required']) }}
                        </div>
                        <div class="col-4">
                            <label for="end_date">End Date*</label>
                            {{ Form::date('end_date', null, ['class' => 'form-control', 'id' => 'end_date', 'required']) }}
                        </div>

                        <div class="col-4">
                            <label for="assigned_to">Assigned To</label>
                            {{ Form::text('assigned_to', null, ['class' => 'form-control', 'id' => 'assigned_to',]) }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="region">Region</label>
                            <select name="region_id[]" class="form-control" id="region" data-placeholder="Choose Region" multiple>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="resources">Resources</label>
                            {{ Form::textarea('resources', null, ['class' => 'form-control', 'id' => 'resources', 'rows' => '2']) }}
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
