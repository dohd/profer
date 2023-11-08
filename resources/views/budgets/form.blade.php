<div class="row mb-3">
    <div class="col-md-10 col-12">
        <label for="title">Project Name<span class="text-danger">*</span></label>
        <select name="proposal_id" id="proposal" class="form-control select2" data-placeholder="Choose Project" required>
            <option value=""></option>
            @foreach ($proposals as $proposal)
                <option 
                    value="{{ $proposal->id }}" 
                    project_no="{{ $proposal->tid }}"
                    {{ @$budget->proposal_id == $proposal->id? 'selected' : '' }}
                >
                    {{ $proposal->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2 col-12">
        <label for="project_no">Project Number<span class="text-danger">*</span></label>
        {{ Form::text('project_no', null, ['class' => 'form-control', 'id' => 'project_no', 'required' => 'required']) }}
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6 col-12">
        <label for="project_partner">Project Patner</label>
        {{ Form::text('project_patner', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-3 col-12">
        <label for="agreement_period">Project Agreement Period<span class="text-danger">*</span></label>
        {{ Form::text('project_agreement_period', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-3 col-12">
        <label for="project_period">Project Period<span class="text-danger">*</span></label>
        {{ Form::text('project_period', null, ['class' => 'form-control']) }}
    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table table-cstm" id="budgetItemsTbl">
        <thead>
            <tr class="table-primary">
                <th width="70%">Description</th>
                <th width="12%">Budget</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr><td colspan="2"></td></tr>
            <tr class="bg-light bg-gradient">
                <td class="p-1"><b>Grand Total</b></td>
                <td class="p-1 grandtotal fw-bold"><b>0.00</b></td>
            </tr>
        </tfoot>
    </table>
</div>

@section('script')
<script>
    // on proposal change
    $('#proposal').change(function() {
        $('#project_no').val($(this).find(':selected').attr('project_no'));
        $('#budgetItemsTbl tbody').html('');
        $.post("{{ route('budgets.proposal_items') }}", {proposal_id: $(this).val()})
        .done((res) => {
            $('#budgetItemsTbl tbody').html(res);
        })
        .catch((res) => res)
    });

    // compute totals
    $('table').on('keyup blur', '.budget', function() {
        if (event.type == 'blur') {
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
    
</script>
@stop
