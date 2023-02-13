@extends('layouts.core')

@section('title', 'Participant List Management')
    
@section('content')
    @include('participant_lists.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Age Group</th>
                        <th scope="col">Organisation</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ([] as $i => $participant)
                            <tr>
                                <th scope="row">{{ $i+1 }}</th>
                                <td>{{ $participant->name }}</td>
                                <td>{{ ucfirst($participant->gender) }}</td>
                                <td>{{ '' }}</td>
                                <td>{{ $participant->organisation }}</td>
                                <td>{{ $participant->designation }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item pt-1 pb-1 view" href="{{ route('participant_lists.show', $participant) }}"><i class="bi bi-eye-fill"></i>View</a></li>
                                            <li><a class="dropdown-item pt-1 pb-1 edit" href="{{ route('participant_lists.edit', $participant) }}"><i class="bi bi-pencil-square"></i>Edit</a></li>
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
