@extends('layouts.core')

@section('title', 'View | Narrative Management')
    
@section('content')
    @include('narratives.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Narrative Details
                <span class="badge bg-secondary text-white float-end" role="button" data-bs-toggle="modal" data-bs-target="#status_modal">
                    <i class="bi bi-pencil-fill"></i> Status
                </span>
            </h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $action_plan_no = '';
                        if ($narrative->action_plan) {
                            $d = explode('-', $narrative->action_plan->date);
                            $action_plan_no = tidCode('action_plan', $narrative->action_plan->tid) . "/{$d[1]}";
                        }

                        $details = [
                            'Project Title' => @$narrative->proposal->title,
                            'Action Plan No' => $action_plan_no,
                            'Activity' => @$narrative->proposal_item->name,
                            'Date' => dateFormat($narrative->date, 'd-M-Y'),
                            'Note' => $narrative->note,
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                    <tr>
                        <th width="30%">{{ $key }}</th>
                        <td>
                            @if ($key == 'Project Title')
                                {{ $val }} || 
                                <span class="badge bg-{{ $narrative->status == 'approved'? 'success' : 'secondary' }}">
                                    {{ $narrative->status }}
                                </span>
                            @else
                                {{ $val }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @if ($narrative->status_note)
                        <tr>
                            <th width="30%">Review Remark</th>
                            <td>{{ $narrative->status_note }}</td>
                        </tr>
                    @endif
                </table>

                <!-- narrative items -->
                <table class="table table-striped" id="narratives_tbl">
                    <thead>
                        <tr class="">
                            <th scope="col">#</th>
                            <th scope="col" width="30%">Narrative Indicator</th>
                            <th scope="col">Response</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($narrative->items as $i => $item)
                            <tr>
                                <th scope="row" class="pt-2">{{ $i+1 }}</th>
                                <td class="pt-2">{{ $item->narrative_pointer? $item->narrative_pointer->value : '' }}</td>
                                <td class="pt-2">{{ $item->response }}</td>
                            </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('narratives.partial.narrative_status')
@stop

@section('script')
<script>
    $('#status').change(function() {
        if ($(this).val() == 'review') {
            $('#note').parents('.row').removeClass('d-none');
        } else {
            $('#note').parents('.row').addClass('d-none');
        }
    }).trigger('change');
</script>
@endsection
