<!-- Modal -->
<div class="modal fade" id="activity_modal" tabindex="-1" aria-labelledby="activity_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status_modal_label">Additional Activity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::model($action_plan, ['route' => array('action_plans.update', $action_plan), 'method' => 'PATCH']) }}
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="activity">Activity</label>
                            <select name="activity_id[]" class="form-control select2" id="activity" data-placeholder="Choose Activity">
                                <option value=""></option>
                                @foreach ($proposal_items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="start_date">Start Date*</label>
                            {{ Form::date('start_date', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="col-4">
                            <label for="end_date">End Date*</label>
                            {{ Form::date('end_date', null, ['class' => 'form-control', 'required']) }}
                        </div>

                        <div class="col-4">
                            <label for="assigned_to">Assigned To</label>
                            {{ Form::text('assigned_to[]', null, ['class' => 'form-control']) }}
                        </div>
                        
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="cohort">Cohort</label>
                            <select name="cohort_id" class="form-control select2" data-placeholder="Choose Cohort">
                                <option value=""></option>
                                @foreach ([] as $cohort)
                                    <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="region">Region</label>
                            <select name="region_id" class="form-control select2" data-placeholder="Choose Region" multiple>
                                <option value=""></option>
                                @foreach ([] as $region)
                                    <option value="{{ $region->id }}-{{ $item->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="resources">Resources</label>
                            {{ Form::textarea('resources', null, ['class' => 'form-control', 'rows' => '2']) }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" disabled>Update</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
