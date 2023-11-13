<script>
    // select2 config
    $('select').each(function() { $(this).css('width', '100%') });
    $('#item_category').select2({allowClear: true, dropdownParent: $('#expense_modal')});
    $('#cost_item').select2({
        allowClear: true, 
        dropdownParent: $('#expense_modal'),
        ajax: {
            url: "{{ route('budgets.cost_items') }}",
            method: 'POST',
            dataType: 'json',
            delay: 250,
            cache: true,
            data: ({term}) => ({
                category_id: $('#item_category').val(), 
                budget_id: @json($budget->id),
            }),
            processResults: function (data) {
                return { results: data.map(v => ({id: v.id, text: v.name})) };
            },
        },
    });
    // $(() => $('#expense_modal').modal('show'));
    
    // on objective change
    $('#item_category').change(function() {
        $('#cost_item').val('').change();
    });

    // Reset expense modal
    $('#expense_modal').on('hide.bs.modal', function() {
        $('#expense_modal_label').html('Add Expense');
        $('#expense_form').attr('action', @json(route('budgets.store_expenses')));
        $('#expense_form').trigger('reset');
        $('select option').each(function() { $(this).prop('selected', false).change(); });
    });
    // Edit expense modal
    $('#expenseTbl').on('click', '.edit', function() {
        const dataUrl = $(this).attr('data-url');
        const postUrl = $(this).attr('post-url');
        const expense_id = $(this).attr('data-id');
        $.post(dataUrl, {expense_id}, (data) => {
            if (!data.id) return;
            $('#expense_modal_label').html('Edit Activity');
            $('#expense_form').attr('action', postUrl);
            $('#item_category').val(data.item_category_id).change();
            if (data.cost_item) $('#cost_item').append(`<option value=${data.cost_item_id} selected>${data.cost_item.name}</option>`);
            $('#activity_date').val(data.date);
            $('#amount').val(accounting.formatNumber(accounting.unformat(data.amount),2));
        });
    });
</script>
