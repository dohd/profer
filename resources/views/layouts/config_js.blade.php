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
        localStorage['tabIndex'] = $(this).attr('data-bs-target');
    });
    const tabIndex = localStorage['tabIndex'];
    const activeTab = $('.nav-item button[data-bs-target="'+ tabIndex +'"]');
    if (tabIndex && activeTab.length) activeTab.click(); 
    else $('.nav-tabs .nav-link:first').click();
</script>