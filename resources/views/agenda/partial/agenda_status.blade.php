<!-- Modal -->
<div class="modal fade" id="status_modal" tabindex="-1" aria-labelledby="status_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status_modal_label">Agenda Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::model($agenda, ['route' => array('agenda.update', $agenda), 'method' => 'PATCH']) }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="status" class="col-form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                @foreach (['pending', 'approved', 'review'] as $item)
                                    <option value="{{ $item }}" {{ $agenda->status == $item? 'selected' : '' }}>{{ ucfirst($item) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="status" class="col-12 col-form-label">Remark</label>
                            {{ Form::textarea('status_note', null, ['class' => 'form-control', 'id' => 'note', 'rows' => '3']) }}
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
