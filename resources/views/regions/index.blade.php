@extends('layouts.core')

@section('title', 'Program Management')
    
@section('content')
    @include('regions.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                          <tr>
                            <th scope="col">#No.</th>
                            <th scope="col">Program</th>
                            <th scope="col">Program Type</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($regions as $i => $region)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td>{{ $region->name }}</td>
                                    <td>{{ $region->program_type }}</td>
                                    <td>{!! $region->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
