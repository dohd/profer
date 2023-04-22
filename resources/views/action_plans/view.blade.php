@extends('layouts.core')

@section('title', 'View | Action Plan Management')
    
@section('content')
    @include('action_plans.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Action Plan
                <div class="float-end">
                    <span class="badge bg-secondary text-white" role="button" data-bs-toggle="modal" data-bs-target="#status_modal">
                        <i class="bi bi-pencil-fill"></i> Status
                    </span>
                </div>
            </h5>
            <div class="card-content p-2">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="true">
                            Summary
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="agenda-list-tab" data-bs-toggle="tab" data-bs-target="#agenda" type="button" role="tab" aria-controls="agenda_list" aria-selected="false">
                            Agenda List (0)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="participant-list-tab" data-bs-toggle="tab" data-bs-target="#participant" type="button" role="tab" aria-controls="participant-list" aria-selected="false">
                            Participant List ({{ $action_plan->participant_lists->count() }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="narrative-tab" data-bs-toggle="tab" data-bs-target="#narrative" type="button" role="tab" aria-controls="narrative" aria-selected="false">
                            Activity Narrative ({{ $action_plan->narratives->count() }})
                        </button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="myTabContent2">
                    <!-- summary -->
                    @include('action_plans.tabs.summary_tab')
                    <!-- activity  -->
                    @include('action_plans.tabs.agenda_list_tab')
                    <!-- activity  -->
                    @include('action_plans.tabs.participant_list_tab')
                    <!-- cohort  -->
                    @include('action_plans.tabs.narrative_tab')
                </div>
            </div>
        </div>
    </div>
    <!-- End Default Tabs -->
@stop

@section('script')
<script>
    // on status change
    $('#status').change(function() {
        const row = $('#note').parents('.row');
        if ($(this).val() == 'review') row.removeClass('d-none');
        else row.addClass('d-none');
    }).change();
</script>
@include('action_plans.modal_js')
@stop