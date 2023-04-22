<script>
    // select2 config
    $('select').each(function() { $(this).css('width', '100%') });
    ['activity', 'region'].forEach(v => {
        $('#'+v).select2({allowClear: true, dropdownParent: $('#activity_modal')});
    });

    /**
    * Activity Modal
    **/
    // reset activity modal
    $('#activity_modal').on('hide.bs.modal', function() {
    $('#activity_modal_label').html('Add Activity');
    $('#activity_form').attr('action', @json(route('action_plans.store_activity')));
    $('#activity_form').trigger('reset');
    $('#item_id').val('');
    $('select option').each(function() { $(this).prop('selected', false).change(); });
    });
    // edit activity modal
    $('#activity_tbl').on('click', '.edit', function() {
    const url = $(this).attr('data-url');
    const plan_activity_id = $(this).attr('data-id');
    $.post(url, {plan_activity_id}, data => {
        if (!data.id) return;
        $('#activity_modal_label').html('Edit Activity');
        $('#activity_form').attr('action', @json(route('action_plans.update_activity')));
        $('#item_id').val(data.id)
        $('#start_date').val(data.start_date);
        $('#end_date').val(data.end_date);
        $('#assigned_to').val(data.assigned_to);
        $('#resources').val(data.resources);
        $('#activity').val(data.activity_id).change();
        $('#region option').each(function() {
            const opt = $(this);
            data.regions.forEach(v => {
                if (v.id == opt.attr('value')) opt.prop('selected', true).change();
            })
        });
    });
    });
    // show activity modal
    $('#activity_tbl').on('click', '.view', function() {
    const url = $(this).attr('data-url');
    const plan_activity_id = $(this).attr('data-id');
    $.post(url, {plan_activity_id}, data => {
        if (!data.id) return;
        const values = new Array(5).fill(null);
        if (data.activity) values[0] = data.activity.name;
        values[1] = data.start_date.split('-').reverse().join('-') + ' || ' +
            data.end_date.split('-').reverse().join('-');
        values[2] = data.regions.map(v => v.name).join(', ');
        values[3] = data.resources;
        values[4] = data.assigned_to;
        
        $('table.activity_view tr').each(function(i) {
            values.forEach((v,j) => {
                if (i == j) {
                    if (!v) v = '';
                    $(this).find('td').html(v);
                }
            });
        });
    });
    });


    /** 
    * Cohort Modal
    */
    $('#cohort_activity').select2({allowClear: true, dropdownParent: $('#cohort_modal')});
    // add cohort row
    let rowCount = 1;
    let initRow = $('#cohorts_tbl tbody tr:first').html();
    $('.addrow').click(function() {
    rowCount++;
    $('#cohorts_tbl tbody').append(`<tr>${initRow}</tr>`);
    const row = $('#cohorts_tbl tbody tr:last');
    row.find('.num').text(rowCount);
    // add select2 to added row
    row.find('select.custom').each(function() {
        $(this).select2({allowClear: true, dropdownParent: $('#cohort_modal')});
    });
    });
    // add select2 to default row
    $('#cohorts_tbl tbody tr:first').find('select.custom').select2({
    allowClear: true, dropdownParent: $('#cohort_modal')
    });

    // remove row
    $('#cohorts_tbl').on('click', '.del', function() {
    const row = $(this).parents('tr');
    if (!row.siblings().length) return;
    row.remove();
    rowCount--;
    });

    // edit cohorts modal
    $('#cohort_list_tbl').on('click', '.edit', function() {
    const url = $(this).attr('data-url');
    const cohort_id = $(this).attr('data-id');
    $.post(url, {cohort_id}, data => {
        $('.addrow').addClass('d-none');
        if (!data.id) return;
        $('#cohort_modal_label').html('Edit Cohort');
        $('#cohort_form').attr('action', @json(route('action_plans.update_cohort')));
        $('#cohort_item_id').val(data.id);
        if (data.plan_activity) $('#cohort_activity').val(data.plan_activity.activity_id).change();
        const row = $('#cohorts_tbl tbody tr:first');
        row.find('.cohort_id').val(data.cohort_id).change();
        row.find('.target_no').val(data.target_no);
    });
    });

    // reset cohort modal
    $('#cohort_modal').on('hide.bs.modal', function() {
    $('.addrow').removeClass('d-none');
    $('#cohort_modal_label').html('Add Cohort');
    $('#cohort_form').attr('action', @json(route('action_plans.store_cohort')));
    $('#cohort_item_id').val('');
    $('#cohort_activity').val('').change();
    const row = $('#cohorts_tbl tbody tr:first');
    row.find('.cohort_id').val('').change();
    row.find('.target_no').val('');
    });
</script>
