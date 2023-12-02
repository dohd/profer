@extends('layouts.core')

@section('title', 'Prefix Management')

@section('content')
    @include('prefixes.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th>#No.</th>
                                <th>Label</th>
                                <th>Code</th>
                                @can('edit-code-prefix')
                                    <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prefixes as $i => $prefix)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td>{{ $prefix->label }}</td>
                                    <td>{{ $prefix->code }}</td>
                                    @can('edit-code-prefix')
                                        <td>
                                            <a href="{{ route('prefixes.edit', $prefix) }}"><i class="bi bi-pencil-square"></i> Edit</a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
