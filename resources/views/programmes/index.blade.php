@extends('layouts.core')

@section('title', 'Programme Management')
    
@section('content')
    @include('programmes.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#No</th>
                        <th scope="col">Programme</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($programmes as $i => $programme)
                            <tr>
                                <th scope="row">{{ $i+1 }}</th>
                                <td>{{ $programme->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item pt-1 pb-1 view" href="{{ route('programmes.show', $programme) }}"><i class="bi bi-eye-fill"></i>View</a></li>
                                            <li><a class="dropdown-item pt-1 pb-1 edit" href="{{ route('programmes.edit', $programme) }}"><i class="bi bi-pencil-square"></i>Edit</a></li>
                                            <li><a class="dropdown-item pt-1 pb-1 destroy" href="javascript:" onclick="confirm('Are You sure?')"><i class="bi bi-trash text-danger icon-xs"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@stop
