<div class="row mb-3">
    <div class="col-10">
        <label for="title">Title*</label>
        {{ Form::text('title', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-2">
        <label for="date">Date*</label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required']) }}
    </div>
</div>

<div class="responsive">
    <table class="table table-striped" id="agendaItemsTbl">
        <thead>
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col" width="20%">Period (Start-End)</th>
                <th scope="col" width="50%">Topic</th>
                <th scope="col">Assigned To</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>
                    <div class="row g-0">
                        <div class="col-6"><input type="time" name="time_from[]" class="form-control time-to"></div>
                        <div class="col-6"><input type="time" name="time_to[]" class="form-control time-from"></div>
                    </div>
                </td>
                <td><input type="text" name="topic[]" class="form-control topic" required></td>
                <td><input type="text" name="assigned_to[]" class="form-control assigned-to" required></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item pt-1 pb-1 add" href="javascript:"><i class="bi bi-plus"></i>Add</a></li>
                          <li><a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs"></i>Delete</a></li>
                        </ul>
                    </div>
                </td>
                <input type="hidden" name="row_index[]" class="row-index">
                <input type="hidden" name="item_id[]" class="item_id">
            </tr>
        </tbody>
    </table>
</div>

@section('script')
<script>

</script>
@stop
