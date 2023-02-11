@extends('layouts.core')

@section('title', 'Cohort Management')
    
@section('content')
    @include('cohorts.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#No</th>
                        <th scope="col">Cohort</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($cohorts as $i => $cohort)
                            <tr>
                                <th scope="row">{{ $i+1 }}</th>
                                <td>{{ $cohort->name }}</td>
                                <td>{!! $cohort->action_buttons !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@stop
