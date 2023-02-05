@extends('layouts.core')

@section('title', 'View | Narrative Management')
    
@section('content')
    @include('narratives.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Narrative Details</h5>
            <div class="card-content p-2">
                <table class="table table-bordered">
                    @php
                        $details = [
                            '#No.' => $narrative->tid,
                            'Project Title' => $narrative->proposal? $narrative->proposal->title : '',
                            'Activity' => $narrative->proposal_item? $narrative->proposal_item->name : '',
                            'Note' => $narrative->note,
                        ];
                    @endphp
                    @foreach ($details as $key => $val)
                        <tr>
                            <th width="30%">{{ $key }}</th>
                            <td>{{ $val}}</td>
                        </tr>
                    @endforeach
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
@stop
