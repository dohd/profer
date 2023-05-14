@extends('layouts.core')

@section('title', 'User Profile Management')
    
@section('content')
    @include('user_profiles.header')
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
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($user_profiles as $i => $user_profile)
                            <tr>
                                <th scope="row">{{ $i+1 }}</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('img/profile-img.jpeg') }}" alt="Profile" class="rounded-circle" width="40" height="40"/>
                                        <span class="d-none d-md-block ps-2">
                                            <a href="{{ route('user_profiles.show', $user_profile) }}">{{ $user_profile->name }}</a>
                                        </span> 
                                    </div>
                                </td>
                                <td>{{ $user_profile->phone }}</td>
                                <td>{{ $user_profile->email }}</td>
                                <td>{!! $user_profile->action_buttons !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
