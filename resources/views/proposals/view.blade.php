@extends('layouts.core')

@section('title', 'View | Proposal Management')
    
@section('content')
    @include('proposals.header')
    <div class="card">
        <div class="card-body">
            <div class="card-title h5">Proposal Details
                <span class="badge bg-secondary text-white float-end" role="button" data-bs-toggle="modal" data-bs-target="#status_modal">
                    <i class="bi bi-pencil-fill"></i> Status
                </span>
            </div>
            <div class="card-content">
                
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="true">
                            Summary
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="log-frame-tab" data-bs-toggle="tab" data-bs-target="#log-frame" type="button" role="tab" aria-controls="log-frame" aria-selected="false">
                            Log Frame ({{ $proposal->log_frame? 1 : 0 }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="action-plan-tab" data-bs-toggle="tab" data-bs-target="#action-plan" type="button" role="tab" aria-controls="action-plan" aria-selected="false">
                            Action Plan ({{ $proposal->action_plans->count() }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="participant-list-tab" data-bs-toggle="tab" data-bs-target="#participant-list" type="button" role="tab" aria-controls="participant-list" aria-selected="false">
                            Participant List ({{ $proposal->participant_lists->count() }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="narrative-tab" data-bs-toggle="tab" data-bs-target="#narrative" type="button" role="tab" aria-controls="narrative" aria-selected="false">
                            Activity Narrative ({{ $proposal->narratives->count() }})
                        </button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="myTabContent">
                    <!-- proposal summary  -->
                    @include('proposals.tabs.proposal_summary_tab')
                    <!-- log frame  -->
                    @include('proposals.tabs.log_frame_tab')
                    <!-- action plans  -->
                    @include('proposals.tabs.action_plan_tab')
                    <!-- participant list  -->
                    @include('proposals.tabs.participant_list_tab')
                    <!-- narrative  -->
                    @include('proposals.tabs.narrative_tab')
                </div>
            </div>
        </div>
    </div>
    @include('proposals.partial.status_modal')
@stop

@section('script')
<script>
    $('#status').change(function() {
        if ($(this).val() == 'rejected') {
            $('#note').parents('.row').removeClass('d-none');
        } else {
            $('#note').parents('.row').addClass('d-none');
        }
    }).trigger('change');
</script>
@endsection
