@extends('layouts.core')

@section('title', 'Narrative Management')
    
@section('content')
    @include('narratives.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#No</th>
                        <th scope="col">Project Title</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Note</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($narratives as $i => $narrative)
                            <tr>
                                <th scope="row">{{ $i+1 }}</th>
                                <td>{{ $narrative->proposal? $narrative->proposal->title : '' }}</td>
                                <td>{{ $narrative->proposal_item? $narrative->proposal_item->name : '' }}</td>
                                <td><span class="badge bg-{{ $narrative->status == 'approved'? 'success' : 'secondary' }}">{{ $narrative->status }}</span></td>
                                <td>{{ $narrative->note }}</td>
                                <td>{!! $narrative->action_buttons !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@stop
