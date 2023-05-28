@extends('layouts.core')

@section('title', 'User Profile Management')
    
@section('content')
    @include('user_profiles.header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-borderless datatable">
                        <thead>
                          <tr>
                            <th scope="col">#No</th>
                            <th scope="col" width="20%">Name</th>
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
                                        <div class="row g-0">
                                            <div class="col-md-3 col-12">
                                                <img src="{{ asset('img/profile-img.jpeg') }}" alt="Profile" class="rounded-circle" width="40" height="40"/>
                                            </div>
                                            <div class="col-md-9 col-12">
                                                <a href="{{ route('user_profiles.show', $user_profile) }}">{{ $user_profile->name }}</a>
                                            </div>
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
    </div>
@stop
