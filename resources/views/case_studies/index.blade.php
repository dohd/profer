@extends('layouts.core')

@section('title', 'Case Study Management')
    
@section('content')
    @include('case_studies.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#No</th>
                                <th scope="col">#Code</th>
                                <th scope="col">Programme</th>
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($case_studies as $i => $item)
                                <tr>
                                    <th scope="row" style="height: {{ !$i? '80px': 'inherit' }}">{{ $i+1 }}</th>
                                    <td><a href="{{ route('case_studies.show', $item) }}">{{ tidCode('case_study', $item->tid) }}</a></td>
                                    <td>{{ @$item->programme->name }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ dateFormat($item->date) }}</td>
                                    <td>{!! $item->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
