@extends('layouts.core')

@section('title', 'Project Budget Management')
    
@section('content')
    @include('budgets.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                        <tr>
                            <th scope="col">#No.</th>
                            <th scope="col">#Project No.</th>
                            <th scope="col">Project</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ([] as $i => $programme)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td><a href="{{ route('programmes.show', $programme) }}">{{ $programme->name }}</a></td>
                                    <td>{!! $programme->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
