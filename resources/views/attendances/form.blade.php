<div class="row mb-3">
    <div class="col-md-8 col-12">
        <label for="title">Family Name</label>
        {{ Form::text('family_name', null, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
    <div class="col-md-4 col-12">
        <label for="date">Date<span class="text-danger">*</span></label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-8 col-12">
        <label for="doc_file">Member List</label>
        {{ Form::file('doc_file', ['class' => 'form-control', 'id' => 'doc_file', 'accept' => '.csv, .pdf, .xls, .xlsx, .doc, .docx' ]) }}
    </div>
    <div class="col-md-4 col-12">
        <label for="prepared_by">Compiled By</label>
        {{ Form::text('prepared_by', null, ['class' => 'form-control']) }}
    </div>
</div>

{{ Form::hidden('male_total', null, ['id' => 'male-total']) }}
{{ Form::hidden('female_total', null, ['id' => 'female-total']) }}
{{ Form::hidden('grand_total', null, ['id' => 'grand-total']) }}

<!-- Statistics section -->
@include('attendances.partial.stats_section')
<!-- End Statistics section -->

@section('script')
<script>
    // init form repeater
    $('form').repeater({
        isFirstItemUndeletable: true,
    });

    $('#action_plan').select2({
        allowClear: true, 
        ajax: {
            url: "{{ route('action_plans.select_items') }}",
            method: 'POST',
            dataType: 'json',
            delay: 250,
            cache: true,
            data: ({term}) => ({
                proposal_id: $('#proposal').val(),
                is_participant_list: 1,
            }),
            processResults: function (data) {
                return { results: data.map(v => ({id: v.id, text: v.code})) };
            },
        },
    });
    $('#activity').select2({
        allowClear: true, 
        ajax: {
            url: "{{ route('action_plans.proposal_items') }}",
            method: 'POST',
            dataType: 'json',
            delay: 250,
            cache: true,
            data: ({term}) => ({
                plan_id: $('#action_plan').val(),
                is_participant_list: 1,
            }),
            processResults: function (data) {
                return { results: data.map(v => ({id: v.id, text: v.name})) };
            },
        },
    });

    // on activity change
    let activityData = {};
    $('#activity').change(function() {
        $('select').each(function() {
            let id = $(this).attr('id');
            if (id.includes('region') || id.includes('cohort')) {
                $(this).find('option:not(:first)').remove();
            }
        });
        const params = {
            activity_id: $(this).val(),
            is_participant_list: 1,
        };
        // fetch regions & cohorts
        $.post("{{ route('action_plans.select_activity_items') }}", params, data => {
            if (!data.regions || !data.cohorts) {
                activityData = {};
            } else {
                activityData = data;
                $('select').each(function() {
                    let id = $(this).attr('id');
                    let el = $(this);
                    if (id.includes('region')) {
                        data.regions.forEach(v => el.append(`<option value="${v.id}">${v.name}</option>`));
                    }
                    if (id.includes('cohort')) {
                        data.cohorts.forEach(v => el.append(`<option value="${v.id}">${v.name}</option>`));
                    }
                });
            }
        });
    });

    // config select2 on default stat-group
    ['region', 'cohort', 'age-group', 'disability'].forEach(function(v) {
        $('#' + v).css('width', '100%').select2({allowClear: true});
    });

    // on add row config select2
    $('.add-row').click(function() {
        $('.stat-group').each(function(i) {
            if (i == 0) return;
            $(this).find('select').each(function() {
                let id = $(this).attr('id');
                $(this).attr('id', id + i);
                $(this).css('width', '100%').select2({allowClear: true});
                let el = $(this);
                if (id.includes('region')) {
                    let regions = activityData.regions || [];
                    regions.forEach(v => el.append(`<option value="${v.id}">${v.name}</option>`));
                }
                if (id.includes('cohort')) {
                    let cohorts = activityData.cohorts || [];
                    cohorts.forEach(v => el.append(`<option value="${v.id}">${v.name}</option>`));
                }
            });
        });
    });

    $('form').on('keyup focusout', '.male, .female', function(e) {
        const row = $(this).parents('div.row:first');
        const male = accounting.unformat(row.find('.male').val());
        const female = accounting.unformat(row.find('.female').val());
        row.find('.total').val(male+female);

        let maleTotal = 0;
        let femaleTotal = 0;
        $('form').find('.male').each(function() {
            maleTotal += accounting.unformat($(this).val());
        });
        $('form').find('.female').each(function() {
            femaleTotal += accounting.unformat($(this).val());
        });
        $('#male-total').val(maleTotal);
        $('#female-total').val(femaleTotal);
        $('#grand-total').val(maleTotal+femaleTotal);
    });
</script>
@stop