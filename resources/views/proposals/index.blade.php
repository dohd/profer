@extends('layouts.core')

@section('title', 'Proposal Management')
    
@section('content')
{{-- <div id="main" class="main"> --}}
    @include('proposals.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#No</th>
                        <th scope="col">Title</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Status</th>
                        <th scope="col">Donor</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposals as $proposal)
                            <tr>
                                <th scope="row"><a href="#">{{ $proposal->tid }}</a></th>
                                <td>{{ $proposal->title }}</td>
                                <td><a href="#" class="text-primary">{{ $proposal->start_date }}</a></td>
                                <td>{{ number_format($proposal->budget, 2) }}</td>
                                <td><span class="badge bg-warning">{{ $proposal->status }}</span></td>
                                <td>{{ $proposal->donor }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item pt-1 pb-1 view" href="{{ route('proposals.show', $proposal) }}"><i class="bi bi-eye-fill"></i>View</a></li>
                                            <li><a class="dropdown-item pt-1 pb-1 edit" href="{{ route('proposals.edit', $proposal) }}"><i class="bi bi-pencil-square"></i>Edit</a></li>
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
{{-- </div> --}}
@stop
