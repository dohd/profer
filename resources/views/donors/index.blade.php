@extends('layouts.core')

@section('title', 'Donor Management')
    
@section('content')
    @include('donors.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Person</th>
                        <th scope="col">Alt. Phone</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($donors as $i => $donor)
                            <tr>
                                <th scope="row">{{ $i+1 }}</th>
                                <td>{{ $donor->name }}</td>
                                <td>{{ $donor->phone }}</td>
                                <td>{{ $donor->email }}</td>
                                <td>{{ $donor->contact_person }}</td>
                                <td>{{ $donor->alternative_phone }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item pt-1 pb-1 view" href="{{ route('donors.show', $donor) }}"><i class="bi bi-eye-fill"></i>View</a></li>
                                            <li><a class="dropdown-item pt-1 pb-1 edit" href="{{ route('donors.edit', $donor) }}"><i class="bi bi-pencil-square"></i>Edit</a></li>
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
