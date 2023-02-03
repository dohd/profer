@extends('layouts.core')

@section('title', 'Region Management')
    
@section('content')
    @include('regions.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#No</th>
                        <th scope="col">Region</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($regions as $i => $region)
                            <tr>
                                <th scope="row">{{ $i+1 }}</th>
                                <td>{{ $region->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item pt-1 pb-1 view" href="{{ route('regions.show', $region) }}"><i class="bi bi-eye-fill"></i>View</a></li>
                                            <li><a class="dropdown-item pt-1 pb-1 edit" href="{{ route('regions.edit', $region) }}"><i class="bi bi-pencil-square"></i>Edit</a></li>
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
