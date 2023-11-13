<div class="row mb-1">
    <div class="col-md-10 col-12">
        <label for="title">Project Name<span class="text-danger">*</span></label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $proposal)
                <option 
                    value="{{ $proposal->id }}" 
                    project_no="{{ $proposal->tid }}"
                    donor="{{ @$proposal->donor->name }}"
                    {{ @$budget->proposal_id == $proposal->id? 'selected' : '' }}
                >
                    {{ $proposal->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2 col-12">
        <label for="project_no">Project Number</label>
        {{ Form::text('project_no', null, ['class' => 'form-control', 'id' => 'project_no', 'disabled' => 'disabled']) }}
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 col-12">
        <label for="project_partner">Project Partner</label>
        {{ Form::text('donor', null, ['class' => 'form-control', 'id' => 'donor', 'placeholder' => 'Project Partner', 'disabled' => 'disabled']) }}
    </div>
</div>
<br>
<div class="table-responsive mb-2">
    <table class="table table-cstm" id="budgetItemsTbl">
        <thead>
            <tr class="table-primary">
                <th width="70%">Description</th>
                <th width="18%">Budget</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr class="bg-light bg-gradient">
                <td class="p-1"><b>Grand Total</b></td>
                <td class="p-1 grandtotal fw-bold"><b>0.00</b></td>
            </tr>
        </tfoot>
    </table>
</div>

@section('script')
<script>
    const budget = @json(@$budget);

    // on proposal change
    $('#proposal').change(function() {
        $('#project_no').val($(this).find(':selected').attr('project_no'));
        $('#donor').val($(this).find(':selected').attr('donor'));
        // fetch activities
        const is_edit = Boolean(budget);
        const proposal_id = $(this).val();
        $('#budgetItemsTbl tbody').html('');
        $.post("{{ route('budgets.proposal_items') }}", {proposal_id, is_edit})
        .done((res) => {
            $('#budgetItemsTbl tbody').html(res);
        })
        .catch((res) => res);
    });

    // on adding row
    let itemRow = '';
    $('table').on('click', '.add-row', function() {
        itemRow = $(this).parents('tr').prev().prev().clone();
        itemRow.removeClass('d-none tmp-row');
        const lastRow = $(this).parents('tr').prev().prev();
        lastRow.before(`<tr>${itemRow.html()}<tr>`);
    });

    // on deleting row
    $('table').on('click', '.del', function() {
        const row = $(this).parents('tr');
        const prev_row = row.prev();
        if (prev_row && prev_row.find('.budget').length) row.remove();
        prev_row.find('.budget:first').keyup();
    });

    // compute totals
    $('table').on('keyup focusout', '.budget', function(e) {
        if (e.type == 'blur' || e.type == 'focusout') {
            this.value = accounting.formatNumber(accounting.unformat(this.value),2);
            return;
        }
        let subtotal = 0;
        const group = $(this).attr('class').split(' ')[0];
        $('table .' + group).each(function() {
            if ($(this).hasClass('budget')) {
                subtotal += accounting.unformat($(this).val());
            }
        });
        $('table .' + group).last().text(accounting.formatNumber(subtotal,2));
        
        let grandtotal = 0;
        $('table .subtotal').each(function() {
            grandtotal += accounting.unformat($(this).text());
            const row = $(this).parents('tr');
            row.find('input[name="budget[]"]').val(accounting.unformat($(this).text()));
        });
        $('table .grandtotal').text(accounting.formatNumber(grandtotal,2));
    });

    // edit mode
    if (budget) {
        $('#proposal').change();
        setTimeout(() => {
            const input = $('table .budget:first');
            if (input.length) input.keyup();
        }, 1000);
    }
    
</script>
@stop
