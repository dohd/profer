@extends('layouts.core')

@section('title', 'View | Action Plan Management')
    
@section('content')
    @include('action_plans.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Action Plan
                @can('approve-action-plan')
                    <div class="float-end">
                        <span class="badge bg-secondary text-white" role="button" data-bs-toggle="modal" data-bs-target="#status_modal">
                            <i class="bi bi-pencil-fill"></i> Status
                        </span>
                    </div>
                @endcan
            </h5>
            <div class="card-content p-2">
                <!-- Action Plan Nav Link -->
                <ul class="nav nav-tabs" id="summaryTabList" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="summary" data-bs-toggle="tab" data-bs-target="#summaryTab" type="button" role="tab" aria-controls="summaryTab" aria-selected="false">
                            Summary
                        </button>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="agendaList" data-bs-toggle="tab" data-bs-target="#agendaListTab" type="button" role="tab" aria-controls="agendaListTab" aria-selected="false">
                            Agenda List ({{ $action_plan->agenda->count() }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="psList" data-bs-toggle="tab" data-bs-target="#psListTab" type="button" role="tab" aria-controls="psListTab" aria-selected="false">
                            Participant List ({{ $action_plan->participant_lists->count() }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="narrative" data-bs-toggle="tab" data-bs-target="#narrativeTab" type="button" role="tab" aria-controls="narrativeTab" aria-selected="false">
                            Activity Narrative ({{ $action_plan->narratives->count() }})
                        </button>
                    </li> --}}
                </ul>
                <div class="tab-content pt-2" id="summaryTabContent">
                    <!-- summary -->
                    @include('action_plans.tabs.action_plan_summary_tab')
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
    // on change status
    $('#status').change(function() {
        const row = $('#note').parents('.row');
        if ($(this).val() == 'review') row.removeClass('d-none');
        else row.addClass('d-none');
    }).change();    

    // on click summary tab
    $('#summaryTabList .nav-link:first').click(function() {
        if (localStorage.tabIndex_1) {
            $('.nav-item button[data-bs-target="'+ localStorage.tabIndex_1 +'"]').click();
        } else {
            $('#activityTabList .nav-link:first').click();
            localStorage.tabIndex_1 = localStorage.tabIndex;
        }
        localStorage.tabIndex = '#summaryTab';
    });
    $('#activityTabList .nav-link').on('click', function() {
        localStorage.tabIndex_1 = $(this).attr('data-bs-target');
        localStorage.tabIndex = '#summaryTab';
    });
    // summary tab state on initial render
    if (localStorage.tabIndex == '#summaryTab') {
        if (localStorage.tabIndex_1)
            $('.nav-item button[data-bs-target="'+ localStorage.tabIndex_1 +'"]').click();
        else $('#activityTabList .nav-link:first').click();
        localStorage.tabIndex = '#summaryTab';
    }
</script>
@include('action_plans.modal_js')
@stop