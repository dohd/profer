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

</script>