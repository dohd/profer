@extends('layouts.core')

@section('title', 'View | Agenda Management')
    
@section('content')
    @include('agenda.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Agenda Details</h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            'Agenda No.' => tidCode('agenda', $agenda->tid),
                            'Title' => $agenda->title,
                            'Date' => dateFormat($agenda->date),
                            'Project Title' => @$agenda->proposal->title,
                            'Activity' => @$agenda->proposal_item->name,
                            'Action Plan No.' => $agenda->action_plan? tidCode('action_plan', $agenda->action_plan->tid) : '',
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>
                                @if($key == 'Project Title' && $val)
                                    <a href="{{ route('proposals.show', $agenda->proposal) }}">{{ $val }}</a>
                                @elseif ($key == 'Action Plan No.' && $val)
                                    <a href="{{ route('action_plans.show', $agenda->action_plan) }}">{{ $val }}</a>
                                @else
                                {{ $val}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped" id="agendaItemsTbl">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="20%">Period (Start-End)</th>
                                <th scope="col" width="50%">Topic</th>
                                <th scope="col">Assigned To</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agenda->items as $i => $item)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td><b>{{ $item->time_from }}</b> to <b>{{ $item->time_to }}</b></td>
                                    <td>{{ $item->topic }}</td>
                                    <td>{{ $item->assigned_to }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
