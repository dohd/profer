<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': "{{ csrf_token() }}",
        }
    });
</script>