@extends('layouts.core')

@section('title', 'View | Age Group Management')
    
@section('content')
    @include('age_groups.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Age Group Details</h5>
            <div class="card-content p-2">
                <h5>{{ $age_group->bracket }}</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#No.</th>
                            <th scope="col">Proposal</th>
                            <th scope="col">Activity</th>
                            <th scope="col">Ps.</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($proposal_items as $i => $item)
                                <tr>
                                    <th>{{ $i+1 }}</th>
                                    <td>
                                        @if (@$item->proposal)
                                            <a href="{{ route('proposals.show', $item->proposal) }}">{{ $item->proposal->title }}</a>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->participants->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
