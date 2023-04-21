@extends('layouts.core')

@section('title', 'Disability Management')
    
@section('content')
    @include('disabilities.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                          <tr>
                            <th scope="col">#No</th>
                            <th scope="col">Disability</th>
                            <th scope="col">Code</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($disabilities as $i => $disability)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td><a href="{{ route('disabilities.show', $disability) }}">{{ $disability->name }}</a></td>
                                    <td>{{ $disability->code }}</td>
                                    <td>{!! $disability->action_buttons !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
