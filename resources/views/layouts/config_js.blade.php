<script>
    // ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': "{{ csrf_token() }}",
        }
    });

    // global table-row form delete handler
    $(document).on('click', '.destroy', function() {
        if ($(this).children('form').length && confirm('Are you sure?')) {
            $(this).children('form').submit();
        }
    });
</script>