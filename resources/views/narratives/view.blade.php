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
                        $details = [
                            'Narrative No.' => tidCode('narrative', $narrative->tid),
                            'Project Title' => @$narrative->proposal->title,
                            'Action Plan No' => $narrative->action_plan? tidCode('action_plan', $narrative->action_plan->tid) : '',
                            'Activity' => @$narrative->proposal_item->name,
                            'Date' => dateFormat($narrative->date, 'd-M-Y'),
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                    <tr>
                        <th width="30%">{{ $key }}</th>
                        <td>
                            @if ($key == 'Narrative No.')
                                {{ $val }} || 
                                <span class="badge bg-{{ $narrative->status == 'approved'? 'success' : 'secondary' }}">
                                    {{ $narrative->status }}
                                </span>
                            @elseif ($key == 'Project Title' && $val)
                                <a href="{{ route('proposals.show', $narrative->proposal) }}">{{ $val }}</a>
                            @elseif ($key == 'Action Plan No' && $val)
                                <a href="{{ route('action_plans.show', $narrative->action_plan) }}">{{ $val }}</a>
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
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" width="30%">Narrative Indicator</th>
                            <th scope="col">Response</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($j=0)
                        @foreach ($narrative->items as $item)
                            @isset($item->narrative_pointer->value)
                                <tr>
                                    <th scope="row" class="pt-2">{{ $j+1 }}</th>
                                    <td class="pt-2">{{ $item->narrative_pointer->value }}</td>
                                    <td class="pt-2">{{ $item->response }}</td>
                                </tr>   
                                @php($j++)
                            @endisset
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
