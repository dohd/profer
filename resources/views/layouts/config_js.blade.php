<script>
    /**
     * Jquery ajax setup
     **/
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': "{{ csrf_token() }}",
        }
    });

    /**
     * Global delete via form handler
     **/
    $(document).on('click', '.destroy', function() {
        if ($(this).children('form').length && confirm('Are you sure?')) {
            $(this).children('form').submit();
        }
    });

    /**
     * Initiate select2
     **/
    $('.select2').each(function() {
        $(this).select2({
            allowClear: true,
        });
    });

    /**
     * Persist Bootstrap tab on page refresh
    **/
    $('.nav-tabs .nav-link').on('show.bs.tab', function() {
        localStorage['activeTab'] = $(this).attr('data-bs-target');
    });
    const activeTab = localStorage['activeTab'];
    if (activeTab) $('.nav-item button[data-bs-target="'+ activeTab +'"]').click(); 
    else $('.nav-tabs .nav-link:first').click();
</script>